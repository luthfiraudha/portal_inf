<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_job extends CI_Model {

    private $table = 'data_job';
    private $key = 'job_id';


    function get_all() {
        
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    function add($dt) {
        $data = array('job_nama' => $dt);
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


     function suges_job($term){
        
        $this->db->like('job_nama',$term);
        $this->db->group_by('job_nama');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function cek_job($job_nama = ''){
        $this->db->select('job_nama, job_id');
        $this->db->where('job_nama',$job_nama);
      
        $result = $this->db->get($this->table);
        return $result->result();
    }

  

   

}
