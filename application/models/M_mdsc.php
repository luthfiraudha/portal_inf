<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_mdsc extends CI_Model {


    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }
  

    function aplikasi_getall(){
        $result = $this->db2->get('dataaplikasi');
        return $result->result();
    }

    
    function fitur_getall(){
    	//$this->db2->where('id_app',$id_app);
        $result = $this->db2->get('datafitur');
        return $result->result();
    }

    function cek_app($nama_app = ""){
        $this->db2->where('nama_app',$nama_app);
        $result = $this->db2->get('dataaplikasi');
        return $result->result();
    }

    function cek_fitur($nama_fitur = ""){
        $this->db2->where('nama_fitur',$nama_fitur);
        $result = $this->db2->get('datafitur');
        return $result->result();
    }

    function get_fitur($nama_app = "",$nama_fitur =""){
        $this->db2->select('datafitur.*,dataaplikasi.nama_app');
        $this->db2->join('dataaplikasi','dataaplikasi.id_app = datafitur.id_app');
        $this->db2->where('dataaplikasi.nama_app',$nama_app);
        $this->db2->like('datafitur.nama_fitur',$nama_fitur);
        $result = $this->db2->get('datafitur');
        return $result->result();
    }

    function get_app($nama_app){
        $this->db2->like('dataaplikasi.nama_app',$nama_app);
        $result = $this->db2->get('dataaplikasi');
        return $result->result();
    }

}