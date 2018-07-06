<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kategori_issue extends CI_Model {

    private $table = 'data_kategori';
    private $key = 'kategori_id';


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

    function add($dt) {
        $data = array('kategori_nama' => $dt);

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
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    // function cek_unique_update($unique = '', $id = 0) {
    //     $this->db->where("hapus", 0);
    //     $this->db->where($this->unique, $unique);
    //     $this->db->where_not_in($this->key, $id);
    //     $result = $this->db->get($this->table);
    //     return $result->result();
    // }

    function get_kategori($id=0){
        $this->db->select('data_kategori.*, data_record.id, data_tindakan.id, data_tindakan.record_id, data_record.kategori_id');
        $this->db->join('data_record',' data_kategori.kategori_id = data_record.kategori_id');
        $this->db->join('data_tindakan',' data_record.id = data_tindakan.record_id');
        $this->db->where("data_kategori.hapus", 0);
        $this->db->where('data_kategori.kategori_id', $id);
        $result = $this->db->get($this->table);
        return $result->result();
    }

     function suges_kategori($term){
        $this->db->where("hapus", 0);
        $this->db->like('kategori_nama',$term);
        $this->db->group_by('kategori_nama');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function cek_kategori($kategori_nama = ''){
        $this->db->select('kategori_nama, kategori_id');
        $this->db->where('kategori_nama',$kategori_nama);
        $this->db->where('hapus',0);
        $result = $this->db->get($this->table);
        return $result->result();
    }

  

   

}
