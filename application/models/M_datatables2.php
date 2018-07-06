<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_datatables2 extends CI_Model {

	var $table = '';
	var $column_order = array(); //set column field database for datatable orderable
	var $column_search = array(); //set column field database for datatable searchable 
	var $order = array(); // default order 

	private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('mdsc', TRUE);   
    }



//------------------- DATA Aplikasi----------------------------------

	private function _get_datatables2_query_app()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2_app($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->where("status", "dikonfirmasi");
		$this->_get_datatables2_query_app();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_app($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->where("status", "dikonfirmasi");
		$this->_get_datatables2_query_app();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_app($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->where("status", "dikonfirmasi");
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}

	
	
//------------------- DATA INVENTORI----------------------------------

	private function _get_datatables2_query_inven()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2_inven($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_inven();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_inven($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_inven();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_inven($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}

//------------------- DATA TRANSAKSI----------------------------------

	private function _get_datatables2_query_trans()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2_trans($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_trans();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_trans($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_trans();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_trans($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}

	//------------------- DATA Aplikasi----------------------------------

	private function _get_datatables2_query_dok()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2_dok($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_dok();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_dok($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_dok();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_dok($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}

	//------------------- DATA RECORD KONFIRMASI----------------------------------
  	//Eksekusi query
	private function _get_datatables2_query_konfirm()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	//mengambil data 
	function get_datatables2_konfirm($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->select('dataaplikasi.nama_app, dataaplikasi.des_app, dataaplikasi.hapus,datafitur.nama_fitur, datafitur.tipe_fitur,, datafitur.programmer, datafitur.hapus, data_dok.id_doc, data_dok.no_surat, data_dok.status, data_dok.versi_a, data_dok.versi_b, data_dok.versi_c,data_dok.tgl_input, data_dok.hapus');
        $this->db2->join('datafitur','dataaplikasi.id_app = datafitur.id_app');
        $this->db2->join('data_dok','datafitur.id_fitur = data_dok.id_fitur');
        $this->db2->where("data_dok.status", "belum dikonfirmasi");
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
		$this->_get_datatables2_query_konfirm();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	//menghitung jumlah data yang ditampilkan sesuai filter
	function count_filtered_konfirm($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->select('dataaplikasi.nama_app, dataaplikasi.des_app, dataaplikasi.hapus, datafitur.nama_fitur, datafitur.tipe_fitur, datafitur.programmer, datafitur.hapus, data_dok.id_doc,data_dok.no_surat, data_dok.status, data_dok.versi_a, data_dok.versi_b, data_dok.versi_c,data_dok.tgl_input, data_dok.hapus');
        $this->db2->join('datafitur','dataaplikasi.id_app = datafitur.id_app');
        $this->db2->join('data_dok','datafitur.id_fitur = data_dok.id_fitur');
        $this->db2->where("data_dok.status", "belum dikonfirmasi");
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
		$this->_get_datatables2_query_konfirm();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	//menghitung jumlah keseluruhan data
	public function count_all_konfirm($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->select('dataaplikasi.nama_app,  dataaplikasi.des_app, dataaplikasi.hapus,datafitur.nama_fitur, datafitur.tipe_fitur, datafitur.programmer, datafitur.hapus, data_dok.id_doc,data_dok.no_surat, data_dok.status, data_dok.versi_a, data_dok.versi_b, data_dok.versi_c,data_dok.tgl_input, data_dok.hapus');
        $this->db2->join('datafitur','dataaplikasi.id_app = datafitur.id_app');
        $this->db2->join('data_dok','datafitur.id_fitur = data_dok.id_fitur');
        $this->db2->where("data_dok.status", "belum dikonfirmasi");
        $this->db2->where("dataaplikasi.hapus", 0);
        $this->db2->where("datafitur.hapus", 0);
        $this->db2->where("data_dok.hapus", 0);
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}


/*//------------------- DATA PROJEK----------------------------------

	private function _get_datatables2_query_proj()
	{
		
		$this->db2->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db2->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db2->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db2->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db2->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db2->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db2->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables2_proj($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_proj();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_proj($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->_get_datatables2_query_proj();
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_proj($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->where("hapus", 0);
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}*/

}
