<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_helper_auth extends CI_Model {
	
	function get_hak_akses($id_user)
	{
		$this->db->where('u.user_id',$id_user);
		$this->db->join('hak_akses h','u.user_akses=h.id_hak_akses');
		
		$result = $this->db->get('user u');
		$result = $result->row();
		return $result->fitur_hak_akses;
	}

}
