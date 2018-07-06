<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_dok extends CI_Model {

    /*private $table = 'datacode';*/
    private $table = 'data_dok';
    private $table2 = 'datafitur';
    private $table3 = 'dataaplikasi';
    private $key = 'id_doc';
    private $key2 = 'id_fitur';
    private $key3 = 'id_app';
    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }
    /*private $unique = 'pjk_nmr';*/

    function get_all() {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(projek_enddate,CURDATE()) as tempo FROM projek");
        $this->db2->where("hapus", 0);
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->row();
    }

    function get_id_app($id) {
        $this->db2->select('*');
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key2, $id);

        $result = $this->db2->get($this->table2);
        return $result->row();
    }

    function get_nama_app($id) {
        $this->db2->select('nama_app');
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key3, $id);

        $result = $this->db2->get($this->table3);
        return $result->row();
    }

    function get_row_by_fitur($id_fitur) {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(aplikasi_enddate,CURDATE()) as tempo FROM aplikasi");
        $this->db2->where("hapus", 0);
        $this->db2->where("id_fitur", $id_fitur);
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function add($data = array()) {
        $result = $this->db2->insert($this->table, $data);
        if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
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

    function delete2($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key2, $id);
        $this->db2->update($this->table, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function cek_unique_update($unique = '', $id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->unique, $unique);
        $this->db2->where_not_in($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->result();
    }



    

    //NOTE//
    //query update projek event
    //UPDATE `projek` SET `status`="kadaluarsa" WHERE (DATEDIFF(projek_enddate,CURDATE()) <0);



   

}
