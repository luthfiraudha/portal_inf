<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_sop extends CI_Model {

    private $table = 'sop_app';
    private $key = 'sop_id';
    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }
  

    // function tesdb()
    // {
    //     $result = $this->db2->get('dataapp');
    //     return $result->result();
    // }


    function get_all() {
        // $this->db->select('sop_app.*, user.*');
        // $this->db->join('user','sop_app.user_id = user.user_id');
        $this->db->where("sop_app.hapus", 0);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->where("hapus", 0);
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    function add($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
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

    function delete($id = 0) {
        // $this->db->where("hapus", 0);
        // $this->db->where($this->key, $id);
        // $this->db->update($this->table, array("hapus" => 1));
        // $err = $this->db->error();
        // if ($err['code'] !== 0) {
        //     return FALSE; // Or do whatever you gotta do here to raise an error
        // } else
        //     return $this->db->affected_rows();

        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function dismiss($id = 0) {
        $this->db->where("hapus", 0);
        $this->db->where($this->key, $id);
        $this->db->update($this->table, array("status" => 'kadaluarsa'));
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

   
   

}
