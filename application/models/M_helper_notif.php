<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_helper_notif extends CI_Model {

	function get_notif_vendor($lama=''){
		$sql="SELECT COUNT(*) as total FROM vendor WHERE vendor_enddate < (DATE_ADD(CURDATE(), INTERVAL ".$lama." MONTH)) AND hapus = 0 AND (status = 'baru' OR status = 'diperpanjang')";
		$query = $this->db->query($sql);
		
        return $query->row();
	}

	function get_notif_user(){
		$sql="SELECT COUNT(*) as total FROM user WHERE user_aktif = 0 ";
		$query = $this->db->query($sql);
		
        return $query->row();
	}



	function get_notif_issue(){
		$sql="SELECT COUNT(*) as total FROM data_record WHERE status = 'belum dikerjakan' OR status = 'belum dikoreksi' AND hapus=0 ";
		$query = $this->db->query($sql);
		
        return $query->row();
	}


    
	
	

}

?>