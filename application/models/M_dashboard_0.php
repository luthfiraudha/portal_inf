<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    private $table = 'free_text';
    private $key = 'text_id';
  



    function get_all() {
        $this->db->limit(12);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    

    function update($id = 0, $data = array()) {
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
        if ($this->db->error()['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

	function add_note($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function delete_note($id = 0) {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
        if ($this->db->error()['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function get_note_shift($shift = '', $date=''){
    	$this->db->where('shift', $shift);
        $this->db->like('date', $date);
    	$this->db->limit(8);
    	$this->db->order_by('text_id','DESC');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function data($number,$offset){
        return $query = $this->db->get($this->table,$number,$offset)->result();       
    }
 
    function jumlah_data(){
        return $this->db->get($this->table)->num_rows();
    }

    function countTicketSuccess(){
        $sql ="SELECT count(id) as Jumlah_problem,
                            `tgl_input` as Tanggal
                        from
                             data_record
                        WHERE
                            `tgl_input` > NOW() - INTERVAL 7 DAY
                        AND
                            `status` = 'selesai'
                      ";

        $result = $this->db->query($sql);

        return $result->result();

    }

    function countTicketNotsuccess(){
        $sql ="SELECT count(id) as Jumlah_problem,
                            `tgl_input` as Tanggal
                        from
                             data_record
                        WHERE
                            `tgl_input` > NOW() - INTERVAL 7 DAY
                        AND
                            `status` = 'belum selesai'
                        
                       
                        ";

        $result = $this->db->query($sql);

        return $result->result();

    }

     function countProblembyKategori(){
        $sql ="SELECT count(data_record.kategori_id) as jumlah_problem, data_kategori.kategori_nama as nama from data_record INNER JOIN data_kategori ON data_record.kategori_id = data_kategori.kategori_id group by data_record.kategori_id
                        ";

        $result = $this->db->query($sql);

        return $result->result();

    }

   

    

    

}
