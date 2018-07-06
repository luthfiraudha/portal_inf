<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pengajuan extends CI_Model {

    private $table = 'dataaplikasi';
    private $table2 = 'datafitur';
    private $table3 = 'data_dok';
    private $key = 'id_app';
    private $key2 = 'id_fitur';
    private $key3 = 'id_doc';
    private $unique = 'nama_app';

    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }

    function get_all() {
        $this->db2->select('dataaplikasi.nama_app,dataaplikasi.des_app,dataaplikasi.hapus, datafitur.id_fitur,datafitur.id_app, datafitur.nama_fitur, datafitur.tipe_fitur, datafitur.ip_fitur, datafitur.platform, datafitur.pengembang, datafitur.programmer, datafitur.hapus,data_dok.*');
        $this->db2->join('datafitur','data_dok.id_fitur = datafitur.id_fitur');
        $this->db2->join('dataaplikasi','datafitur.id_app = dataaplikasi.id_app');
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
        $result = $this->db2->get($this->table3);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db2->select('dataaplikasi.nama_app,dataaplikasi.des_app,dataaplikasi.hapus, datafitur.id_fitur,datafitur.id_app, datafitur.nama_fitur,datafitur.tipe_fitur, datafitur.ip_fitur, datafitur.platform, datafitur.pengembang, datafitur.programmer, datafitur.hapus,data_dok.*');
        $this->db2->join('datafitur','data_dok.id_fitur = datafitur.id_fitur');
        $this->db2->join('dataaplikasi','datafitur.id_app = dataaplikasi.id_app');
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
        $this->db2->where($this->key3, $id);
        $result = $this->db2->get($this->table3);
        return $result->row();
    }

    function cek_unique_update($unique = '', $id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->unique, $unique);
        $this->db2->where_not_in($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_max_versi_b($id) {
        $query = $this->db2->query('SELECT a.versi_a, a.versi_b, a.versi_c from data_dok a join (
                                    select b.id_fitur from ( 
                                        select * from datafitur where id_app in ( 
                                            SELECT id_app from dataaplikasi where id_app = "$id" ) and hapus = 0)b)c 
                                    on a.id_fitur = c.id_fitur where a.hapus = 0 and a.status = "dikonfirmasi"  ORDER BY a.versi_a desc, a.versi_b desc limit 1');
        foreach ($query->result_array() as $row) {
            $res=array(
                'versi_a' => $row['versi_a'],
                'versi_b' => $row['versi_b'],
                'versi_c' => $row['versi_c'],
            );
        }
        
        return json_encode($res);
    }

    function get_max_versi_x($id) {
        $query = $this->db2->query('SELECT a.versi_a, a.versi_b, a.versi_c from data_dok a join (
                                    select b.id_fitur from ( 
                                        select * from datafitur where id_app in ( 
                                            SELECT id_app from dataaplikasi where id_app = ".$id." ) and hapus = 0)b)c 
                                    on a.id_fitur = c.id_fitur where a.hapus = 0 and a.status = "dikonfirmasi"  ORDER BY a.versi_a desc, a.versi_b desc limit 1');
        foreach ($query->result_array() as $row) {
            $res=array(
                'versi_a' => $row['versi_a'],
                'versi_b' => $row['versi_b'],
                'versi_c' => $row['versi_c'],
            );
        }
        
        return json_encode($res);
    }

    function get_nama() {
        $query = $this->db2->query('SELECT * FROM dataaplikasi where hapus="0" ');
        return $query->result();
    }

    function add($data = array()) {
        $result = $this->db2->insert($this->table, $data);
        if ($this->db2->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function update($id = 0, $data = array()) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->update($this->table, $data);
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    
    function delete($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->update($this->table, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }


    

    function get_bank_konfirmasi($id = 0, $id2 = 0){
        $this->db2->select('data_dok.*, dataaplikasi.id_app, dataaplikasi.nama_app, dataaplikasi.des_app, datafitur.id_fitur, datafitur.nama_fitur, datafitur.tipe_fitur, datafitur.ip_fitur,  datafitur.platform, datafitur.pengembang, datafitur.programmer');
        $this->db2->join('dataaplikasi','data_dok.id_doc = dataaplikasi.id_app');
        $this->db2->join('datafitur','data_dok.id_doc = data_kategori.kategori_id');
        $this->db2->where("data_dok.hapus", 0);
        $this->db2->where("data_dok.status", "belum dikonfirmasi");
        $this->db2->where('data_dok.id_doc', $id);
        $this->db2->where('datafitur.id_fitur', $id2);
        $result = $this->db2->get($this->table);
        return $result->row();
    }

    

}
