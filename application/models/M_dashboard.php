<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    private $table = 'data_record';
    private $key = 'id';
   
  

    function data_record($number,$offset,$type=''){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_record.pinned", 1);
        if($type !="") {
           $this->db->where("data_record.type", $type);
        }
        $result = $this->db->get($this->table,$number,$offset);
        return $result->result();
    }

      function update($id = 0, $data = array()) {
        $this->db->where("hapus", 0);
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }
 
    function jumlah_data_record($type=''){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_record.pinned", 1);
        if($type !="") {
           $this->db->where("data_record.type", $type);
        }
         $this->db->order_by("data_record.tgl_input","DESC");
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }

    function data_daily(){
        $this->db->select('data_daily.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_daily.user_id = user.user_id');
        $this->db->join('data_kategori','data_daily.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_daily.type", "Daily Activity");
        $this->db->order_by("data_daily.tanggal","DESC");

        
        $result = $this->db->get('data_daily',4);
        return $result->result();
    }

  

     function countProblembyKategori(){
        $sql ="SELECT count(data_record.kategori_id) as jumlah_problem, data_kategori.kategori_nama as nama from data_record INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id group by data_record.kategori_id
                        ";

        $result = $this->db->query($sql);

        return $result->result();

    }

    function search_global($cari=''){
        $sql1 = "SELECT sop_app.sop_id as id, null as kategori_id,sop_app.sop_tgl as tgl_input,null as shift, sop_app.sop_pdf as isi, null as status, sop_app.sop_pic as user_nama, sop_app.sop_name as kategori_nama, null as isi2, null as id2, null as correct,  null as tgl_sol, null as shift2,null as user_id, null as nama2 FROM sop_app WHERE sop_app.hapus=0 ";
 
        $sql2 = " UNION ";
             
        $sql3="SELECT data_record.id, data_record.kategori_id, data_record.tgl_input,data_record.shift, data_record.isi, data_record.status, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.id as id2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2
                                FROM data_record
                                INNER JOIN user ON data_record.user_id = user.user_id
                                INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id
                                INNER JOIN data_tindakan ON data_record.id = data_tindakan.record_id
                                INNER JOIN user as u ON data_tindakan.user_id = u.user_id  WHERE ( data_record.hapus=0 AND data_tindakan.correct = 'tepat' )";


        $conditions1 = array();
        $conditions2 = array();
        if($cari !="") {
          $conditions1[] = "sop_app.sop_name like '%$cari%'";
        }

        if($cari !="") {
          $conditions2[] = "data_kategori.kategori_nama LIKE '%$cari%'";
        }
        if($cari !="") {
          $conditions2[] =  "data_record.isi LIKE '%$cari%'";
        }
        if($cari !="") {
          $conditions2[] =  "data_tindakan.isi LIKE '%$cari%'";
        }
        if($cari !="") {
          $conditions2[] =  "data_record.id LIKE '%$cari%'";
        }

        $sql = $sql1;
        if (count($conditions1) > 0) {
          $sql .= " AND "." ( " .implode(' AND ', $conditions1). " ) ";
        } 

        $sql .= $sql2;
        $sql .=$sql3;
        if (count($conditions2) > 0) {
          $sql .= " AND "." ( " .implode(' OR ', $conditions2). " ) ";
        }

       
        
        $result = $this->db->query($sql);

        return $result->result();
                                
    }

    function countrespontime(){
        $sql ="SELECT AVG(DATEDIFF(data_tindakan.tgl_sol,data_record.tgl_input))*24 as AverageTime FROM data_record INNER JOIN user ON data_record.user_id = user.user_id INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id INNER JOIN data_tindakan ON data_record.id = data_tindakan.record_id INNER JOIN user as u ON data_tindakan.user_id = u.user_id WHERE ( data_record.hapus=0 AND data_tindakan.correct = 'tepat') AND (data_record.type = 'Problem' OR data_record.type = 'Request')
           ";

           $result = $this->db->query($sql);

           return $result->result();
    }

     function counttotalvendor(){
        $sql ="SELECT COUNT(vendor.vendor_id) as totalvendor FROM vendor WHERE vendor.hapus = '0' AND (vendor.status ='baru' or vendor.status = 'diperpanjang')
           ";

           $result = $this->db->query($sql);

           return $result->result();
    }



     function counttotaluser(){
        $sql ="SELECT COUNT(user.user_id) as totaluser FROM user WHERE user.user_aktif = '1'
           ";

           $result = $this->db->query($sql);

           return $result->result();
    }


     function counttotalsop(){
        $sql ="SELECT COUNT(sop_app.sop_id) as totalsop FROM sop_app WHERE sop_app.hapus = '0'";

           $result = $this->db->query($sql);

           return $result->result();
    }

    function counttotalprob(){
        // $sql ="SELECT COUNT(data_record.id) as totalprob FROM data_record WHERE data_record.hapus = '0' AND data_record.status='selesai' AND (data_record.type='Problem' OR data_record.type='Request') AND
        //   YEAR(data_record.tgl_input) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
        //   AND MONTH(data_record.tgl_input) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
      $sql ="SELECT COUNT(data_record.id) as totalprob FROM data_record WHERE data_record.hapus = '0' AND data_record.status='selesai' AND (data_record.type='Problem' OR data_record.type='Request') AND
         DATE(data_record.tgl_input) = CURRENT_DATE";

           $result = $this->db->query($sql);

           return $result->result();
    }

     function counttotaldai(){
        // $sql ="SELECT COUNT(data_record.id) as totaldai FROM data_record WHERE data_record.hapus = '0' AND data_record.status='selesai' AND (data_record.type='Daily Activity') AND
        //   YEAR(data_record.tgl_input) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
        //   AND MONTH(data_record.tgl_input) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)";
       $sql ="SELECT COUNT(data_daily.id) as totaldai FROM data_daily WHERE  data_daily.status='selesai' AND (data_daily.type='Daily Activity') AND
         DATE(data_daily.tanggal) = CURRENT_DATE";
          

           $result = $this->db->query($sql);

           return $result->result();
    }

    function countlogin(){
       $sql ="SELECT COUNT(log_id) as total from log_login WHERE log_tanggal >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 HOUR)
           ";

           $result = $this->db->query($sql);

           return $result->result();
    }



 function count_kpi(){
       $sql ="SELECT KPI as nilaikpi from KPI";

           $result = $this->db->query($sql);

           return $result->result();
    }


    function count_totalanggaran(){
      $sql = "
SELECT ((((SELECT sum(nilai_anggaran) as total_dana FROM anggaran 
) - (SELECT sum(nilai) as total_pakai from pakai_anggaran))/(SELECT sum(nilai_anggaran) as total_dana FROM anggaran 
) 
)*100) as total_sisa

";
$result = $this->db->query($sql);

           return $result->result();
    }


   

    

    

}
