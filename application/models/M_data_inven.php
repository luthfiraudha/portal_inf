<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_inven extends CI_Model {

    private $table = 'datainven';
    private $key = 'id_inven';
    private $unique = 'spk_inven';
    private $table2 = 'datatransaksi';
    private $key2 = 'id_transaksi';

    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }

    function get_all() {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(inven_enddate,CURDATE()) as tempo FROM inven");
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

    function get_list_server() {

        $this->db2->select('Label');
        $this->db2->order_by('Label', 'asc');
        $result = $this->db2->get('dcim.fac_device');
        return $result->result();
    }

    function get_trans($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where("id_inven", $id);
        $result = $this->db2->get($this->table2);
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
        //$this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->delete($this->table);
       // $this->db2->update($this->table, array("hapus" => 1));
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

    
    function get_projek($term){
        $this->db2->where("hapus", 0);
        $this->db2->like('nama_inven',$term);
        $this->db2->group_by('nama_inven');
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_inven($term){
        $this->db2->where("hapus", 0);
        $this->db2->like('nama_inven',$term);
        $this->db2->group_by('nama_inven');
        $result = $this->db2->get($this->table);
        return $result->result();
    }


    //NOTE//
    //query update inven event
    //UPDATE `inven` SET `status`="kadaluarsa" WHERE (DATEDIFF(inven_enddate,CURDATE()) <0);



   

}
