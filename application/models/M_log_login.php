<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_log_login extends CI_Model {

    private $table = 'log_login';
    private $key = 'Log_id';

    function get_all() {
        
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        
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
        
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function delete($id = 0) {
        
        $this->db->where($this->key, $id);
        $this->db->update($this->table, array("hapus" => 1));
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function cek_unique_update($unique = '', $id = 0) {
        
        $this->db->where($this->unique, $unique);
        $this->db->where_not_in($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    //batas query pengunjung
}
