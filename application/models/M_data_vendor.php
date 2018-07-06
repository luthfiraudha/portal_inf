<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_vendor extends CI_Model {

    private $table = 'vendor';
    private $key = 'vendor_id';
    private $unique = 'spk_nmr';

    function get_all() {
        // $result = $this->db->query("SELECT *,  DATEDIFF(vendor_enddate,CURDATE()) as tempo FROM vendor");
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
        $this->db->update($this->table, array("status" => 'selesai'));
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function cek_unique_update($unique = '', $id = 0) {
        $this->db->where("hapus", 0);
        $this->db->where($this->unique, $unique);
        $this->db->where_not_in($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function getInterval($lama='') {

        $query = $this->db->query("SELECT *,  DATEDIFF(vendor_enddate,CURDATE()) as tempo FROM vendor WHERE vendor_enddate < (DATE_ADD(CURDATE(), INTERVAL ".$lama." MONTH)) AND hapus = 0 AND (status = 'baru' OR status = 'perpanjang' ) ");
        ;
        return $query->result();
    }


    function get_setting(){
        $this->db->where('sv_id', '1');
        $result = $this->db->get('vendor_setting');
        return $result->row();
    }

    function set_setting($data = array()){
        $this->db->where('sv_id', '1');
        $this->db->update('vendor_setting', $data);
       $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function get_projek($term){
        $this->db->where("hapus", 0);
        $this->db->like('nama_projek',$term);
        $this->db->group_by('nama_projek');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_vendor($term){
        $this->db->where("hapus", 0);
        $this->db->like('vendor_nama',$term);
        $this->db->group_by('Vendor_nama');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function extend($id = 0) {
        $data['status'] = 'kadaluarsa';
        $this->db->where("hapus", 0);
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }


    //NOTE//
    //query update vendor event
    //UPDATE `vendor` SET `status`="kadaluarsa" WHERE (DATEDIFF(vendor_enddate,CURDATE()) <0);



   

}
