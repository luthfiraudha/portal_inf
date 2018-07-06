<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datatables extends CI_Model {

	var $table = '';
	var $column_order = array(); //set column field database for datatable orderable
	var $column_search = array(); //set column field database for datatable searchable 
	var $order = array(); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	

	//------------------- DATA RECORD TICKET----------------------------------
  	//Eksekusi query
	private function _get_datatables_query()
	{
		
				$conditions = array();
				if($this->input->post('tglIssue') ==""){
	                $tanggal ="";
	            }else{
	                 $tanggal = date("Y-m-d", strtotime($this->input->post('tglIssue')));
	            }
	            if($this->input->post('tglIssue2') ==""){
	                $tanggal2 =$tanggal;
	            }else{
	                 $tanggal2 = date("Y-m-d", strtotime($this->input->post('tglIssue2')));
	            }
	            $kategori = $this->input->post('kategori');
	            $shift = $this->input->post('shift');
	            $status = $this->input->post('status');
	            $jenistik = $this->input->post('jenistik');
	            $namaapp = $this->input->post('namaapp');
	            $namafitur = $this->input->post('namafitur');
	            

			    if($tanggal !="") {
		          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) >=', $tanggal);
		        }
		        if($tanggal2 !="") {
		          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) <=', $tanggal2);
		        }
		        if($shift !="") {
		          $conditions[] = $this->db->where('data_record.shift', $shift);
		        }
		        if($kategori !="") {
		          $conditions[] = $this->db->where('kategori_nama', $kategori);
		        }
		        if($jenistik !="") {
		          $conditions[] = $this->db->where('data_record.type', $jenistik);
		        }
		        if($status !="") {
		          $conditions[] = $this->db->where('data_record.status', $status);
		        }

		        if($namaapp !="") {
		          $conditions[] = $this->db->where('data_record.nama_app', $namaapp);
		        }
		        if($namafitur !="") {
		          $conditions[] = $this->db->where('data_record.nama_fitur', $namafitur);
		        }

		         $j = count($conditions);
		        if ( $j> 0) {
		          for($i=0;$i<$j;$i++){
		          	$conditions[$i];
		          }
		        }




		// $this->db->where("data_record.type", "Problem");
  //       $this->db->or_where("data_record.type", "Request");
		 //$this->db->where_not_in("data_record.type", "Daily Activity");
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	//mengambil data 
	function get_datatables_ticket($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        // $this->db->where("data_record.type", "Problem");
        // $this->db->or_where("data_record.type", "Request");
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	//menghitung jumlah data yang ditampilkan sesuai filter
	function count_filtered_ticket($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        // $this->db->where("data_record.type", "Problem");
        // $this->db->or_where("data_record.type", "Request");
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	//menghitung jumlah keseluruhan data
	public function count_all_ticket($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        // $this->db->where("data_record.type", "Problem");
        // $this->db->or_where("data_record.type", "Request");
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}



	//------------------- DATA PROBLEM / REQ TICKET----------------------------------
		private function _get_datatables_query_prob()
			{
				//var_dump($this->input->post('shift'));die;
			    // if($this->input->post('shift'))
		     //    {
		     //    	 if($this->input->post('shift') ==""){
			                
			    //         }else{
			    //              $shift = $this->input->post('shift');
			    //              $this->db->where('data_record.shift', $shift);
			    //         }
		            
		     //    }
		     //    if($this->input->post('single_cal1'))
		     //    {
		        	
		     //    	 if($this->input->post('single_cal1') ==""){
			                
			    //         }else{
			    //              $tanggal = date("Y-m-d", strtotime($this->input->post('single_cal1')));
			    //              $this->db->like('data_record.tgl_input', $tanggal);
			    //         }
		            
		     //    }

		     //    if($this->input->post('kategori'))
		     //    {
		     //    	if($this->input->post('kategori') ==""){
			                
			    //         }else{
			    //              $kategori = $this->input->post('kategori');
			    //              $this->db->like('data_record.kategori_id', $kategori);
			    //         }
		            
		     //    }


				$conditions_tik = array();
			    if($this->input->post('tglIssue') ==""){
	                $tanggal ="";
	            }else{
	                 $tanggal = date("Y-m-d", strtotime($this->input->post('tglIssue')));
	            }
	            if($this->input->post('tglIssue2') ==""){
	                $tanggal2 =$tanggal;
	            }else{
	                 $tanggal2 = date("Y-m-d", strtotime($this->input->post('tglIssue2')));
	            }
	            $kategori = $this->input->post('kategori');
	            $shift = $this->input->post('shift');
	            $status = $this->input->post('status');
	            $jenistik = $this->input->post('jenistik');
			    if($tanggal !="") {
		          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) >=', $tanggal);
		        }
		        if($tanggal2 !="") {
		          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) <=', $tanggal2);
		        }
		        if($shift !="") {
		          $conditions[] = $this->db->where('data_record.shift', $shift);
		        }
		        if($kategori !="") {
		          $conditions[] = $this->db->where('kategori_nama', $kategori);
		        }
		        if($jenistik !="") {
		          $conditions[] = $this->db->where('data_record.type', $jenistik);
		        }
		        if($status !="") {
		          $conditions[] = $this->db->where('data_record.status', $status);
		        }

		         $a = count($conditions_tik);
		        if ( $a> 0) {
		          for($b=0;$b<$a;$b++){
		          	$conditions_tik[$b];
		          }
		        }


				$this->db->from($this->table);

				$i = 0;
			
				foreach ($this->column_search as $item) // loop column 
				{
					if($_POST['search']['value']) // if datatable send POST for search
					{
						
						if($i===0) // first loop
						{
							$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
							$this->db->like($item, $_POST['search']['value']);
						}
						else
						{
							$this->db->or_like($item, $_POST['search']['value']);
						}

						if(count($this->column_search) - 1 == $i) //last loop
							$this->db->group_end(); //close bracket
					}
					$i++;
				}
				
				if(isset($_POST['order'])) // here order processing
				{
					$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order))
				{
					$order = $this->order;
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

	function get_datatables_prob($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.tgl_input,data_record.type, data_record.isi as isi, data_record.id as id, data_record.user_id ,data_record.shift as shift, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2, data_tindakan.id as id2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_tindakan.correct", "tepat");
		$this->_get_datatables_query_prob();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		//var_dump($query->result());die;
		return $query->result();
	}

	function count_filtered_prob($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.tgl_input,data_record.type, data_record.isi as isi, data_record.id as id, data_record.user_id ,data_record.shift as shift, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2, data_tindakan.id as id2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_tindakan.correct", "tepat");
		$this->_get_datatables_query_prob();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_prob($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.tgl_input,data_record.type, data_record.isi as isi, data_record.id as id, data_record.user_id ,data_record.shift as shift, user.user_nama, data_kategori.kategori_nama, data_tindakan.isi as isi2, data_tindakan.correct, data_tindakan.tgl_sol, data_tindakan.shift as shift2, data_tindakan.user_id, u.user_nama as nama2, data_tindakan.id as id2');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->join('data_tindakan','data_record.id = data_tindakan.record_id');
        $this->db->join('user as u','data_tindakan.user_id = u.user_id');
        $this->db->where("data_record.hapus", 0);
        $this->db->where("data_tindakan.correct", "tepat");
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}



	//------------------- DATA RECORD DAILY----------------------------------

	private function _get_datatables_query_dai()
	{
		


		        $conditions = array();
				if($this->input->post('tglIssue') ==""){
	                $tanggal ="";
	            }else{
	                 $tanggal = date("Y-m-d", strtotime($this->input->post('tglIssue')));
	            }
	            $kategori = $this->input->post('kategori');
	            $shift = $this->input->post('shift');
	           
			   if($tanggal !="") {
		          $conditions[] =  $this->db->where('DATE(data_record.tgl_input)', $tanggal);
		        }
		        if($shift !="") {
		          $conditions[] = $this->db->where('data_record.shift', $shift);
		        }
		        if($kategori !="") {
		          $conditions[] = $this->db->where('kategori_nama', $kategori);
		        }

		      

		         $j = count($conditions);
		        if ( $j> 0) {
		          for($i=0;$i<$j;$i++){
		          	$conditions[$i];
		          }
		        }


		$this->db->where("data_record.type", "Daily Activity");
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_dai($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		 $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        
		$this->_get_datatables_query_dai();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_dai($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		 $this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        //$this->db->where("data_record.type", "Daily Activity");
		$this->_get_datatables_query_dai();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_dai($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	//------------------- DATA SOP----------------------------------

	private function _get_datatables_query_sop()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_sop($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("sop_app.hapus", 0);
		$this->_get_datatables_query_sop();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_sop($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("sop_app.hapus", 0);
		$this->_get_datatables_query_sop();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_sop($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("sop_app.hapus", 0);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	//------------------- DATA VENDOR----------------------------------

	private function _get_datatables_query_vend()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_vend($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("hapus", 0);
		$this->_get_datatables_query_vend();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_vend($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("hapus", 0);
		$this->_get_datatables_query_vend();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_vend($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->where("hapus", 0);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}





	//------------------- Reminder issue---------------------------------

	private function _get_datatables_query_reminis()
	{
		
		$conditions = array();

	       if($this->input->post('tglIssue') ==""){
	            $tanggal ="";
	        }else{
	             $tanggal = date("Y-m-d", strtotime($this->input->post('tglIssue')));
	        }
	        if($this->input->post('tglIssue2') ==""){
	            $tanggal2 =$tanggal;
	        }else{
	             $tanggal2 = date("Y-m-d", strtotime($this->input->post('tglIssue2')));
	        }
            $status = $this->input->post('status');
            
		  
		    if($tanggal !="") {
	          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) >=', $tanggal);
	        }
	        if($tanggal2 !="") {
	          $conditions[] =  $this->db->where('DATE(data_record.tgl_input) <=', $tanggal2);
	        }
	        if($status !="") {
	          $conditions[] = $this->db->where('status', $status);
	        }

	      
		    
	         $j = count($conditions);
	        if ( $j> 0) {
	          for($i=0;$i<$j;$i++){
	          	$conditions[$i];
	          }
	        }


		$this->db->where_not_in("data_record.status", "selesai");
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables_reminis($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        // $this->db->where_not_in("data_record.status", "selesai");
		$this->_get_datatables_query_reminis();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}


	function count_filtered_reminis($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
       // $this->db->where_not_in("data_record.status", "selesai");
		$this->_get_datatables_query_reminis();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_reminis($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_record.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_record.user_id = user.user_id');
        $this->db->join('data_kategori','data_record.kategori_id = data_kategori.kategori_id');
        $this->db->where("data_record.hapus", 0);
        // $this->db->where_not_in("data_record.status", "selesai");
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


}
