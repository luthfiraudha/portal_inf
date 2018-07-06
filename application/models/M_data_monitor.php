<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_monitor extends CI_Model {

    private $table = 'monitoring';
    private $key = 'monitor_id';



    function get_all() {
        $this->db->where("hapus", 0);
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
        //  $err = $this->db->error();
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

    function data($number,$offset){
        $this->db->select('*');
        $this->db->where("hapus", 0);
        $result = $this->db->get($this->table,$number,$offset);
        return $result->result();  
    }
 
    function jumlah_data(){
        $this->db->select('*');
        $this->db->where("hapus", 0);
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }

    function data_cari($number,$offset,$cari=''){
        $this->db->select('*');
        $this->db->where("hapus", 0);
        if($cari!=''){
         $this->db->where("monitor_nama", $cari);
        }
        $result = $this->db->get($this->table,$number,$offset);
        return $result->result();  
    }

    function jumlah_data_cari($cari=''){
        $this->db->select('*');
        $this->db->where("hapus", 0);
        if($cari!=''){
         $this->db->where("monitor_nama", $cari);
        }
        $result = $this->db->get($this->table);
        return $result->num_rows();
    }


   
   

}
