<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_user extends CI_Model {

    private $table = 'user';
    private $key = 'user_id';
    private $unique = 'user_pn';

    function get_all() {
      $this->db->select('user.*, jabatan.nama as jab');
       $this->db->join('jabatan','user.user_type = jabatan.id');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->select('user.*, jabatan.nama as jab');
        $this->db->join('jabatan','user.user_type = jabatan.id');
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
        $this->db->delete($this->table);
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

    function get_not_active() {
        $this->db->where('user_aktif', 0);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function accept($id = 0) {
        $this->db->where($this->key, $id);
        $this->db->update($this->table, array("user_aktif" => '1'));
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function getUsertype(){
        $this->db->select('user_type');
        $this->db->group_by('user_type');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function addjabatan($dt){
        $data = array('nama' => $dt);
        $result = $this->db->insert('jabatan', $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function getjabatan(){
        $result = $this->db->get('jabatan');
        return $result->result();
    }

    

}
