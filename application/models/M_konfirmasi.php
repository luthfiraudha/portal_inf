<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_konfirmasi extends CI_Model {

    private $table = 'dataaplikasi';
    private $table2 = 'datafitur';
    private $table3 = 'data_dok';
    private $key = 'id_app';
    private $key2 = 'id_fitur';
    private $key3 = 'id_doc';
    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }

    function get_all() {
        $this->db2->select('dataaplikasi.nama_app,dataaplikasi.des_app,dataaplikasi.jenis_app,dataaplikasi.hapus, datafitur.id_fitur,datafitur.id_app, datafitur.nama_fitur,datafitur.tipe_fitur, datafitur.ip_fitur, datafitur.platform, datafitur.des_fitur, datafitur.pengembang, datafitur.programmer, datafitur.hapus,data_dok.*');
        $this->db2->join('datafitur','data_dok.id_fitur = datafitur.id_fitur');
        $this->db2->join('dataaplikasi','datafitur.id_app = dataaplikasi.id_app');
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
        $result = $this->db2->get($this->table3);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db2->select('dataaplikasi.nama_app,dataaplikasi.des_app,dataaplikasi.jenis_app,dataaplikasi.hapus, datafitur.id_fitur,datafitur.id_app, datafitur.nama_fitur,datafitur.tipe_fitur, datafitur.ip_fitur, datafitur.platform, datafitur.des_fitur, datafitur.pengembang, datafitur.programmer, datafitur.hapus,data_dok.*');
        $this->db2->join('datafitur','data_dok.id_fitur = datafitur.id_fitur');
        $this->db2->join('dataaplikasi','datafitur.id_app = dataaplikasi.id_app');
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
        $this->db2->where($this->key3, $id);
        $result = $this->db2->get($this->table3);
        return $result->row();
    }

    function add($data = array()) {
        $result = $this->db2->insert($this->table, $data);
        if ($this->db2->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function get_id_app($id) {
        $this->db2->select('id_app');
        $this->db2->where("hapus", 0);
        $this->db2->where('id_fitur', $id);

        $result = $this->db2->get($this->table2);
        return $result->row();
    }

    function get_status_app($id) {
        $this->db2->select('status');
        $this->db2->where("hapus", 0);
        $this->db2->where('id_app', $id);

        $result = $this->db2->get($this->table);
        return $result->row();
    }

    function get_status_fitur($id) {
        $this->db2->select('status');
        $this->db2->where("hapus", 0);
        $this->db2->where('id_fitur', $id);

        $result = $this->db2->get($this->table2);
        return $result->row();
    }


    function updatea($id = 0, $data = array()) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->update($this->table, array('status' => $data));
         $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function updateb($id = 0, $data = array()) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key2, $id);
        $this->db2->update($this->table2, array('status' => $data));
         $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function updatec($id = 0, $data = array()) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key3, $id);
        $this->db2->update($this->table3, array('status' => $data));
         $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function reject_app($id){
        $this->db2->where('id_app',$id);
        $this->db2->delete('dataaplikasi');
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function reject_fitur($id){
        $this->db2->where('id_fitur',$id);
        $this->db2->delete('datafitur');
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function reject_doc($id){
        $this->db2->where('id_doc',$id);
        $this->db2->delete('data_dok');
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function delete($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key3, $id);
        $this->db2->update($this->table3, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }


    function get_bank_konfirmasi($id = 0, $id2 = 0){
        $this->db2->select('data_dok.*, dataaplikasi.id_app, dataaplikasi.nama_app, dataaplikasi.des_app,dataaplikasi.jenis_app, datafitur.id_fitur, datafitur.nama_fitur, datafitur.tipe_fitur, datafitur.ip_fitur, datafitur.platform, datafitur.pengembang, datafitur.programmer');
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
