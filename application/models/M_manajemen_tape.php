<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_manajemen_tape extends CI_Model {

	var $table = '';
	var $column_order = array(); //set column field database for datatable orderable
	var $column_search = array(); //set column field database for datatable searchable 
	var $order = array(); // default order 


	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_data_tape','fdb');
	}

	

	//------------------- DATA RECORD TICKET----------------------------------
  	//Eksekusi query
	


	//------------------- DATA TAPE PF----------------------------------

	private function _get_datatables_query_tape_PF($set_tape)
	{
		
		$conditions = array();

		if($this->input->post('start_date')=="")
		{
			$start_date="";
		}
		else
		{
			$start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
		}
		$status = $this->input->post('status');
		$state = $this->input->post('state');
		$library = $this->input->post('library');
		//print_r($set_tape);

		if($start_date!="")
		{
			$conditions[] = $this->db->where('data_tape.start_date', $start_date);
		}
		if($state !="")
		{
			$conditions[] = $this->db->where('data_tape.state', $state );
		}
		if($status!="")
		{
			$conditions[] = $this->db->where('data_tape.status', $status);
		}
		$k=0;
		if($set_tape!="")
		{

			$i = 0;
			$kondisi_="";
			$kondisi = array();
			if(is_array($set_tape)){
				foreach ($set_tape as $row) {
					# code...
					$k++;
					$kondisi[] = $row->set_tape;

				}

				for($i=0;$i<$k;$i++)
				{
					if($i==0)
					{
						$kondisi[$i] = " data_tape.set_tape ='$kondisi[$i]'";
					}
					else
					{
						$kondisi[$i] = " OR data_tape.set_tape ='$kondisi[$i]'";
					}
					
				}

				$kondisi_ = "(" . implode($kondisi) . ")";
				$conditions[] = $this->db->where($kondisi_);
			}
			else
			{
				$conditions[] = $this->db->where('data_tape.set_tape', $set_tape);
			}

		}

		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db->from("data_tape");

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

	

	function get_datatables_tape_PF($set_tape, $table='', $column_order=array(), $column_search=array(), $order=array())
	{

		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');
		$this->_get_datatables_query_tape_PF($set_tape);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_tape_PF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');

		$this->_get_datatables_query_tape_PF($set_tape="");
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_tape_PF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	//------------------- DATA TAPE OF----------------------------------

	private function _get_datatables_query_tape_OF()
	{
		
		$conditions = array();

		if($this->input->post('tanggal')=="")
		{
			$tanggal="";
		}
		else
		{
			$tanggal = date("Y-m-d", strtotime($this->input->post("tanggal")));
		}
		$hostname = $this->input->post('hostname');
		$ip = $this->input->post('ip');
		$jenis = $this->input->post('jenis');
		
		if($tanggal!="")
		{
			$conditions[] = $this->db->where('content_tape_of.tanggal', $tanggal);
		}
		if($hostname !="")
		{
			$conditions[] = $this->db->where('content_tape_of.hostname', $hostname );
		}
		if($ip!="")
		{
			$conditions[] = $this->db->where('content_tape_of.ip', $ip);
		}
		if($jenis != "")
		{
			$conditions[] = $this->db->where('content_tape_of.jenis', $jenis);
		}

		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db->from("data_tape_of");

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

	

	function get_datatables_tape_OF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;


		$this->db->select('data_tape_of.*, content_tape_of.*, tape_record_of.*');
        $this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'right outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
		$this->_get_datatables_query_tape_OF();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_tape_OF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape_of.*, content_tape_of.*, tape_record_of.*');
        $this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'right outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
		$this->_get_datatables_query_tape_OF();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_tape_OF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape_of.*, content_tape_of.*, tape_record_of.*');
        $this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'right outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	//------------------- DATA TAPE ZF----------------------------------

	private function _get_datatables_query_tape_ZF($set_tape)
	{
		
		$conditions = array();

		if($this->input->post('start_date')=="")
		{
			$start_date="";
		}
		else
		{
			$start_date = date("Y-m-d", strtotime($this->input->post("start_date")));
		}
		$status = $this->input->post('status');
		$state = $this->input->post('state');
		
		$library = $this->input->post('library');
		

		if($start_date!="")
		{
			$conditions[] = $this->db->where('data_tape.start_date', $start_date);
		}
		if($state !="")
		{
			$conditions[] = $this->db->where('data_tape.state', $state );
		}
		if($status!="")
		{
			$conditions[] = $this->db->where('data_tape.status', $status);
		}
		$k=0;
		if($set_tape!="")
		{

			$i = 0;
			$kondisi_="";
			$kondisi = array();
			if(is_array($set_tape)){
				foreach ($set_tape as $row) {
					# code...
					$k++;
					$kondisi[] = $row->set_tape;

				}

				for($i=0;$i<$k;$i++)
				{
					if($i==0)
					{
						$kondisi[$i] = " data_tape.set_tape ='$kondisi[$i]'";
					}
					else
					{
						$kondisi[$i] = " OR data_tape.set_tape ='$kondisi[$i]'";
					}
					
				}

				$kondisi_ = "(" . implode($kondisi) . ")";
				$conditions[] = $this->db->where($kondisi_);
			}
			else
			{
				$conditions[] = $this->db->where('data_tape.set_tape', $set_tape);
			}

		}

		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db->from("data_tape");

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

	

	function get_datatables_tape_ZF($set_tape, $table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');
		$this->_get_datatables_query_tape_ZF($set_tape);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_tape_ZF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');

		$this->_get_datatables_query_tape_ZF($set_tape="");
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_tape_ZF($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape.id_tape, data_tape.vol_id, data_tape.start_date, data_tape.lokasi, tape_record.rak_after, tape_record.koordinat_after, data_tape.set_tape, data_tape.state, data_tape.status, data_tape.jenis');
        $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        //$this->db->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}






//------------------- DATA TAPE OF----------------------------------

	private function _get_datatables_query_tape_OF_available($vol_id)
	{
		
		$conditions = array();

		$hostname = $this->input->post('hostname');
		$ip = $this->input->post('ip');
		$size = $this->input->post('size');
		
		if($hostname !="")
		{
			$conditions[] = $this->db->where('content_tape_of.hostname', $hostname );
		}
		if($ip!="")
		{
			$conditions[] = $this->db->where('content_tape_of.ip', $ip);
		}
		if($size != "")
		{
			$conditions[] = $this->db->where('(data_tape_of.size_total-data_tape_of.size_usage)>=', $size*1024);
		}


		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db->from("data_tape_of");

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

	

	function get_datatables_tape_OF_available($vol_id, $table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;

		$this->db->select('data_tape_of.*, tape_record_of.*, count(content_tape_of.tape) as jumlah');
		$this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'left outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
        $this->db->group_by('content_tape_of.tape');
		$this->_get_datatables_query_tape_OF_available($vol_id);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_tape_OF_available($vol_id, $table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape_of.*, tape_record_of.*,count(content_tape_of.tape) as jumlah');
		$this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'left outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
        $this->db->group_by('content_tape_of.tape');
		$this->_get_datatables_query_tape_OF_available($vol_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_tape_OF_available($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('data_tape_of.*, tape_record_of.*,count(content_tape_of.tape) as jumlah');
		$this->db->join('content_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'left outer');
        $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
        $this->db->group_by('content_tape_of.tape');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	//------------------- DATA TAPE PF----------------------------------

	private function _get_datatables_query_request_tape()
	{
		$conditions = array();
		$status = $this->input->post('status');
		$no_surat = $this->input->post('no_surat');
		$vol_id = $this->input->post('vol_id');
		

		if($vol_id!="")
		{
			$conditions[] = $this->db->where('request_tape.vol_id', $vol_id);
		}
		if($no_surat !="")
		{
			$conditions[] = $this->db->where('request_tape.no_surat', $no_surat );
		}
		if($status!="")
		{
			$conditions[] = $this->db->where('request_tape.status', $status);
		}

		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db->from("request_tape");

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

	

	function get_datatables_request_tape($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		
		$this->db->select('request_tape.*');
		$this->_get_datatables_query_request_tape();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered_request_tape($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('request_tape.*');

		$this->_get_datatables_query_request_tape();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_request_tape($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db->select('request_tape.*');
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


}