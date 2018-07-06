<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_report extends CI_Model {

    private $table = 'data_record';
    private $key = 'id';
   
  

    function totalTicketPeform($month = '', $year = ''){
        $sql ="SELECT count(data_record.id) as jumlah_problem,
                            data_record.status as status
                        from
                             data_record
           WHERE
                            DATE_FORMAT(tgl_input,'%m') = '$month'
            AND
                            DATE_FORMAT(tgl_input,'%Y') = '$year'
                        GROUP BY
                            data_record.status

                      ";

        $result = $this->db->query($sql);

        return $result->result();

    }


     function countProblembyKategori($month='',$year='',$kategori= ''){
        $sql1 ="SELECT count(data_record.kategori_id) as jumlah_problem, data_kategori.kategori_nama as nama from data_record 
            INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 

            WHERE
                            DATE_FORMAT(tgl_input,'%m') = '$month'
            AND
                            DATE_FORMAT(tgl_input,'%Y') = '$year'
            AND 
                            data_record.hapus='0'
                        ";

        $sql2 ="group by data_record.kategori_id";

        $conditions = array();
        if($kategori !="") {
          $conditions[] = "data_kategori.kategori_nama = '$kategori'";
        }

        $sql= $sql1;
        if (count($conditions) > 0) {
          $sql .= " AND "." ( " .implode(' AND ', $conditions). " ) ";
        } 

        $sql .= $sql2;

        $result = $this->db->query($sql);

        return $result->result();

    }

    function getKategoriTicket(){
        $sql = "SELECT data_record.kategori_id, data_kategori.kategori_nama as nama FROM data_record 
         INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 
        WHERE data_record.hapus = '0' GROUP BY data_record.kategori_id";

        $result = $this->db->query($sql);

        return $result->result();
    }

    function countProblembyKategoriLine($month='',$year='',$kategori = ''){
        $sql ="
        SELECT (SELECT count(data_record.kategori_id) as jumlah_problem from data_record 
            INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 

            WHERE
                data_record.hapus='0'
            AND
            data_record.tgl_input BETWEEN '$year-$month-01' AND '$year-$month-07'
            AND data_record.kategori_id = '$kategori') as week1,
            (SELECT count(data_record.kategori_id) as jumlah_problem from data_record 
            INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 

            WHERE
                data_record.hapus='0'
            AND
            data_record.tgl_input BETWEEN '$year-$month-07' AND '$year-$month-14'
            AND data_record.kategori_id = '$kategori') as week2,
            (SELECT count(data_record.kategori_id) as jumlah_problem from data_record 
            INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 

            WHERE
                data_record.hapus='0'
            AND
            data_record.tgl_input BETWEEN '$year-$month-14' AND '$year-$month-22'
            AND data_record.kategori_id = '$kategori') as week3,
            (SELECT count(data_record.kategori_id) as jumlah_problem from data_record 
            INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id 

            WHERE
                data_record.hapus='0'
            AND
            data_record.tgl_input BETWEEN '$year-$month-22' AND '$year-$month-31'
            AND data_record.kategori_id = '$kategori') as week4
             LIMIT 1

                      
                      ";

        $result = $this->db->query($sql);

        return $result->result();
    }


     function countSuccessMonth($month='',$year=''){
        $sql ="
        SELECT (SELECT COUNT(data_record.id) as total FROM data_record WHERE  data_record.hapus='0' AND data_record.status = 'selesai' AND data_record.tgl_input BETWEEN '$year-$month-01' AND '$year-$month-07') as week1,
        (SELECT COUNT(data_record.id) as total FROM data_record WHERE data_record.hapus='0' AND  data_record.status = 'selesai' AND data_record.tgl_input BETWEEN '$year-$month-07' AND '$year-$month-15') as week2,
         (SELECT COUNT(data_record.id) as total FROM data_record WHERE data_record.hapus='0' AND  data_record.status = 'selesai' AND data_record.tgl_input BETWEEN '$year-$month-15' AND '$year-$month-22') as week3,
          (SELECT COUNT(data_record.id) as total FROM data_record WHERE  data_record.hapus='0' AND data_record.status = 'selesai' AND data_record.tgl_input BETWEEN '$year-$month-22' AND '$year-$month-31') as week4 LIMIT 1

                      
                      ";

        $result = $this->db->query($sql);

        return $result->result();

    }

    function countnotSuccessMonth($month='',$year=''){
        $sql ="

      SELECT (SELECT COUNT(data_record.id) as total FROM data_record WHERE  data_record.hapus='0' AND data_record.status = 'belum selesai' AND data_record.tgl_input BETWEEN '$year-$month-01' AND '$year-$month-07') as week1,
        (SELECT COUNT(data_record.id) as total FROM data_record WHERE data_record.hapus='0' AND  data_record.status = 'belum selesai' AND data_record.tgl_input BETWEEN '$year-$month-07' AND '$year-$month-15') as week2,
         (SELECT COUNT(data_record.id) as total FROM data_record WHERE data_record.hapus='0' AND  data_record.status = 'belum selesai' AND data_record.tgl_input BETWEEN '$year-$month-15' AND '$year-$month-22') as week3,
          (SELECT COUNT(data_record.id) as total FROM data_record WHERE  data_record.hapus='0' AND data_record.status = 'belum selesai' AND data_record.tgl_input BETWEEN '$year-$month-22' AND '$year-$month-31') as week4 LIMIT 1
       
                         
                      ";

        $result = $this->db->query($sql);

        return $result->result();

    }


      function getIntervalVendor() {

        $query = $this->db->query("SELECT *,  DATEDIFF(vendor_enddate,CURDATE()) as tempo FROM vendor 
WHERE  hapus = 0 AND (status = 'baru' OR status = 'perpanjang' )
GROUP BY vendor.vendor_nama ");
        ;
        return $query->result();
    }

    function getUserperform($month='',$year = ''){
        $query = $this->db->query("SELECT  data_tindakan.user_id as user_tindakan, u.user_nama as nama2, count(data_tindakan.user_id) as total
                    FROM data_record
                    
                    INNER JOIN data_tindakan ON data_record.id = data_tindakan.record_id
                    INNER JOIN user as u ON data_tindakan.user_id = u.user_id
                       
                        WHERE
                            DATE_FORMAT(data_tindakan.tgl_sol,'%m') = '$month'
                        AND
                            DATE_FORMAT(data_tindakan.tgl_sol,'%Y') = '$year'
                        AND
                            data_tindakan.correct = 'tepat'
                        AND
                            data_tindakan.hapus = '0'
                        AND
                            data_record.hapus = '0'
                        GROUP BY
                            data_tindakan.user_id");
         return $query->result();
    }


    function getUserkategori(){
        $sql = "SELECT data_tindakan.user_id ,u.user_nama as nama
                  FROM
                    data_record
                  INNER JOIN data_tindakan ON data_record.id = data_tindakan.record_id
                  INNER JOIN user AS u ON data_tindakan.user_id = u.user_id
                  WHERE
                    data_tindakan.correct = 'tepat' AND data_tindakan.hapus = '0' AND data_record.hapus = '0'
                   

                   GROUP BY data_tindakan.user_id";

        $result = $this->db->query($sql);

        return $result->result();
    }

    function getUserperformLine($month='',$year = '',$user = ''){
        $query = $this->db->query("
            SELECT
                  (
                  SELECT COUNT(data_tindakan.user_id) AS total
                  FROM
                    data_record
                  INNER JOIN
                    data_tindakan ON data_record.id = data_tindakan.record_id
                  INNER JOIN user AS u ON data_tindakan.user_id = u.user_id
                  WHERE
                    data_tindakan.correct = 'tepat' AND data_tindakan.hapus = '0' AND data_record.hapus = '0' AND data_tindakan.user_id = '$user' AND data_tindakan.tgl_sol BETWEEN '$year-$month-01' AND '$year-$month-07'
                ) AS week1,
                (
                SELECT COUNT(data_tindakan.user_id) AS total
                FROM
                  data_record
                INNER JOIN
                  data_tindakan ON data_record.id = data_tindakan.record_id
                INNER JOIN user AS u ON data_tindakan.user_id = u.user_id
                WHERE
                  data_tindakan.correct = 'tepat' AND data_tindakan.hapus = '0' AND data_record.hapus = '0'  AND data_tindakan.user_id = '$user' AND data_tindakan.tgl_sol BETWEEN '$year-$month-07' AND '$year-$month-15'
                ) AS week2,
                (
                SELECT COUNT(data_tindakan.user_id) AS total
                FROM
                  data_record
                INNER JOIN
                  data_tindakan ON data_record.id = data_tindakan.record_id
                INNER JOIN user AS u ON data_tindakan.user_id = u.user_id
                WHERE
                  data_tindakan.correct = 'tepat' AND data_tindakan.hapus = '0' AND data_record.hapus = '0'  AND data_tindakan.user_id = '$user' AND data_tindakan.tgl_sol BETWEEN '$year-$month-15' AND '$year-$month-22'
                ) AS week3,
                (
                SELECT COUNT(data_tindakan.user_id) AS total
                FROM
                  data_record
                INNER JOIN
                  data_tindakan ON data_record.id = data_tindakan.record_id
                INNER JOIN user AS u ON data_tindakan.user_id = u.user_id
                WHERE
                  data_tindakan.correct = 'tepat' AND data_tindakan.hapus = '0' AND data_record.hapus = '0'  AND data_tindakan.user_id = '$user' AND data_tindakan.tgl_sol BETWEEN '$year-$month-22' AND '$year-$month-31'
                ) AS week4
                LIMIT 1
            ");
         return $query->result();
    }



 
   



    
    

}
