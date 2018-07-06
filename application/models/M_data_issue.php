<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_issue extends CI_Model {

    private $table = 'data_record';
    private $table2 = 'data_tindakan';
    private $key = 'id';
    private $key2 = 'id';


    function get_all() {
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    function add($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return TRUE;
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


    function get_answer($id = 0){
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("hapus", 0);
        if($id!=0)$this->db->where('record_id',$id);
        $result = $this->db->get($this->table2);
        return $result->result();
    }

    function add_answer($data = array()){
        $result = $this->db->insert($this->table2, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function update_answer($id=0,$data){
        $this->db->where("hapus", 0);
        $this->db->where($this->key2, $id);
        $this->db->update($this->table2, $data);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function get_answer_row($id = 0) {
        $this->db->select('data_tindakan.*, user.user_nama, data_record.id as id2');
        $this->db->join('data_record','data_tindakan.record_id = data_record.id');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("data_tindakan.hapus", 0);
        $this->db->where('data_tindakan.id', $id);
        $result = $this->db->get($this->table2);
        return $result->row();
    }


    function delete_answer($id = 0) {
        $this->db->where($this->key2, $id);
        $this->db->delete($this->table2);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }


    function get_reminder(){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where_not_in("data_record.status", "selesai");
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_reminder_answer($id){
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("hapus", 0);
        $this->db->where("data_tindakan.correct", 'belum dikoreksi');
        if($id!=0)$this->db->where("data_tindakan.record_id",$id);
        $result = $this->db->get($this->table2);
        return $result->result();
    }

    function get_bank_issue_row($id = 0, $id2 = 0){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_tindakan.correct", "tepat");
        $this->db->where('data_record.id', $id);
        $this->db->where('data_tindakan.id', $id2);
        $result = $this->db->get($this->table);
        return $result->row();
    }

     function get_bank_issue(){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2, data_tindakan.id as id2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_tindakan.correct", "tepat");
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function search($tanggal='', $shift='',$kategori=''){

        $query = "  SELECT data_record.*, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.id as id2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2
                    FROM data_record
                    INNER JOIN user ON data_record.user_id = user.user_id
                    INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id
                    INNER JOIN data_tindakan ON data_record.id = data_tindakan.record_id
                    INNER JOIN user as u ON data_tindakan.user_id = u.user_id
                    ";
        $conditions = array();
        $sql2=" WHERE data_record.hapus=0 AND data_tindakan.correct = 'tepat' ";
        $sql = $query;
        $sql .= $sql2;

        if($tanggal !="") {
          $conditions[] = "data_record.tgl_input LIKE '%$tanggal%'";
        }
        if($shift !="") {
          $conditions[] = "data_record.shift='$shift'";
        }
        if($kategori !="") {
          $conditions[] = "data_record.kategori_id='$kategori'";
        }
       

        
        if (count($conditions) > 0) {
          $sql .= " AND "." ( " .implode(' AND ', $conditions). " ) ";
        }
        
        $result = $this->db->query($sql);

        return $result->result();

    }

     function data($number,$offset){
        return $query = $this->db->get($this->table,$number,$offset)->result();       
    }
 
    function jumlah_data(){
        return $this->db->get($this->table)->num_rows();
    }


    function jumlah_data_answer($id=0){
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("hapus", 0);
        if($id!=0)$this->db->where('record_id',$id);
        $result = $this->db->get($this->table2);
        return $result->num_rows();

    }


    function data_answer($id=0, $number,$offset){
        
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("hapus", 0);
        if($id!=0)$this->db->where('record_id',$id);
        $result =  $this->db->get($this->table2,$number,$offset);
        return $result->result();
    }

    function jumlah_data_answer_right($id=0){
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("correct", "tepat");
        $this->db->where("hapus", 0);
        if($id!=0)$this->db->where('record_id',$id);
        $result = $this->db->get($this->table2);
        return $result->num_rows();

    }


    function data_answer_right($id=0, $number,$offset){
        
        $this->db->select('data_tindakan.*, user.user_nama');
        $this->db->join('user','data_tindakan.user_id = user.user_id');
        $this->db->where("correct", "tepat");
        $this->db->where("hapus", 0);
        if($id!=0)$this->db->where('record_id',$id);
        $result =  $this->db->get($this->table2,$number,$offset);
        return $result->result();
    }

    function get_daily() {
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_record.type", "Daily Activity");
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function selectmaxid($type = ""){
        $query = "SELECT MAX(data_record.id) AS max_id from data_record where data_record.hapus = '0'";
        $result = $this->db->query($query);

        return $result->row();

    }

    function get_kategori_issue($id_kategori_issue = 0){
        $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where('data_record.kategori_id', $id_kategori_issue);
        $result = $this->db->get($this->table);
        return $result->result();
    }




    /////////////////////////////// API PORTAL /////////////////////////////////////////////

    function getstatus_row($id_problem = 0) {
        $this->db->select('data_record.*');
        $this->db->where("data_record.hapus", 0);
        $this->db->where('id_eskalasi', $id_problem);
        $result = $this->db->get($this->table);
        return $result->row();
    }


}
