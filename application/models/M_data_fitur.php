<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_fitur extends CI_Model {

    /*private $table = 'datacode';*/
    private $table = 'datafitur';
    private $table2 = 'data_dok';
    private $table3 = 'dataaplikasi';
    private $key = 'id_fitur';
    private $key2 = 'id_app';
    private $nama_fitur = 'nama_fitur';

    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }

    /*private $unique = 'pjk_nmr';*/

    function get_all() {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(aplikasi_enddate,CURDATE()) as tempo FROM aplikasi");
        $this->db2->where("hapus", 0);
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_namafit($id) {
        $this->db2->select('*');
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);

        $result = $this->db2->get($this->table);
        return $result->row();
    }

    function get_ip($nama) {
        $this->db2->select('*');
        $this->db2->where("hapus", 0);
        $this->db2->where('nama_fitur', $nama);

        $result = $this->db2->get('datafitur');
        return $result->row();
    }

    function get_nama_fitur() {
        /*$this->db2->select('nama_fitur');
        $this->db2->where("hapus", 0);
        $this->db2->where("tipe_fitur", "Scheduler");*/

        $sql = "SELECT nama_fitur FROM datafitur WHERE tipe_fitur != 'Web' and hapus= 0 ";
        $result = $this->db2->query($sql);

        //$result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_row_by_app($id_app) {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(aplikasi_enddate,CURDATE()) as tempo FROM aplikasi");
        $this->db2->where("hapus", 0);
        $this->db2->where("id_app", $id_app);
        $this->db2->where("status", "dikonfirmasi");
        $this->db2->where_not_in("tipe_fitur", "web");
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_row_by_apps($id_app) {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(aplikasi_enddate,CURDATE()) as tempo FROM aplikasi");
        $this->db2->where("hapus", 0);
        $this->db2->where("id_app", $id_app);
        $this->db2->where("status", "dikonfirmasi");
        $result = $this->db2->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->row();
    }
    function get_dok($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where("status", "dikonfirmasi");
        $this->db2->where("id_fitur", $id);
        $result = $this->db2->get($this->table2);
        return $result->result();
    }

    function get_namaapp($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where("id_app", $id);
        $result = $this->db2->get($this->table3);
        return $result->result();
    }

     function get_fit($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where("id_app", $id);
        $result = $this->db2->get($this->table2);
        return $result->result();
    }


    function add($data = array()) {
        $result = $this->db2->insert($this->table, $data);
        if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
        else
            return FALSE;
    }

    function update($id = 0, $data = array()) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->update($this->table, $data);
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function delete($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key, $id);
        $this->db2->update($this->table, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function delete2($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key2, $id);
        $this->db2->update($this->table, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    function deletex($id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key2, $id);
        $this->db2->update($this->table, array("hapus" => 1));
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    

    function cek_unique_update($unique = '', $id = 0) {
        $this->db2->where("hapus", 0);
        $this->db2->where($this->unique, $unique);
        $this->db2->where_not_in($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->result();
    }




    //NOTE//
    //query update aplikasi event
    //UPDATE `aplikasi` SET `status`="kadaluarsa" WHERE (DATEDIFF(aplikasi_enddate,CURDATE()) <0);



   

}
