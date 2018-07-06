<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_register extends CI_Model {

    private $table = 'user';
    private $key = 'user_id';
    private $unique = 'user_pn';

    function register($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function cek_unique_update($unique = '', $id = 0) {
        $this->db->where($this->unique, $unique);
        $this->db->where_not_in($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->result();
    }

     function get_all() {
        $this->db->select('user.*, jabatan.nama as jab');
        $this->db->join('jabatan','user.user_type = jabatan.id');
        $result = $this->db->get($this->table);
        return $result->result();
    }

     function getjabatan(){
        $result = $this->db->get('jabatan');
        return $result->result();
    }
}
