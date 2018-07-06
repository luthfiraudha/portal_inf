<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_auth extends CI_Model {

    private $table = 'user';
    private $key = 'user_id';
    private $unique = 'user_pn';

     public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }


    function cek_user($username, $pwd) {


        $where = "(u.user_pn = '$username' OR u.user_email = '$username') AND u.password = '$pwd' AND u.user_aktif ='1'";
        $this->db->where($where);
        //$this->db->where('u.user_pswd', $pwd);
        $this->db->select('*');
        $result = $this->db->get('user u');
        $result = $result->row();
        return $result;
    }

    function get_pass($pn) {
        $this->db->where('u.user_pn', $pn);
        $result = $this->db->get('user u');
        $result = $result->row();
        return $result;
    }

    function update_password($id = 0, $data = array()) {
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function register($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return $this->db->insert_id();
        else
            return FALSE;
    }

    function get_all_app() {
        // $result = $this->db2->query("SELECT *,  DATEDIFF(aplikasi_enddate,CURDATE()) as tempo FROM aplikasi");
        $this->db2->select('nama_app');
        $this->db2->where("hapus", 0);
        $result = $this->db2->get('dataaplikasi');
        return $result->result();
    }
	
	function cek_user2($username) {


        $where = "(u.user_pn = '$username' OR u.user_email = '$username') AND u.user_aktif ='1'";
        $this->db->where($where);
        //$this->db->where('u.user_pswd', $pwd);
        $this->db->select('*');
        $result = $this->db->get('user u');
        $result = $result->row();
        return $result;
    }

   

   

}
