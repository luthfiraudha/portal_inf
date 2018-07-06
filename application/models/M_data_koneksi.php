<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_koneksi extends CI_Model {

	private $table_apps = "dataaplikasi";
	private $table_fitur = "datafitur";
	private $table = "data_koneksi";
	private $key = "id_koneksi";
	private $key_apps = "id_app";
	private $db2;

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('mdsc', TRUE);
	}

	public function cek_apps($nama_app = "")
	{
		$this->db2->where('nama_app', $nama_app);
		$res = $this->db2->from('dataaplikasi');
		return $res->count_all_results();
	}

	function add($data = array()) {
        $result = $this->db2->insert($this->table, $data);
        if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
        else
            return FALSE;
    }

    function get_nama($id) {
        $this->db2->select('nama_app');
        $this->db2->where("hapus", 0);
        $this->db2->where($this->key_apps, $id);

        $result = $this->db2->get($this->table_apps);
        return $result->row();
    }

    function get_ip($nama) {
        $this->db2->select('*');
        $this->db2->where("hapus", 0);
        $this->db2->where('nama_fitur', $nama);

        $result = $this->db2->get('datafitur');
        return $result->row();
    }

    function get_nama_app() {
        $this->db2->select(array('nama_app','id_app'));
        $this->db2->where("hapus", 0);
        $this->db2->where("status", "dikonfirmasi");
        $this->db2->order_by("nama_app","asc");

        $result = $this->db2->get($this->table_apps);
        return $result->result();
    }

    function get_row_by_app($id){
    	$this->db2->select(array('nama_fitur'));
        $this->db2->where("hapus", 0);
        $this->db2->where("id_app", $id);
        $this->db2->where_not_in("tipe_fitur", "web");
        $this->db2->where("status", "dikonfirmasi");
        $this->db2->order_by("nama_fitur","asc");

        $result = $this->db2->get($this->table_fitur);
        return $result->result();
    }

    function detailya($id){
    	$this->db2->select(array('*'));
        $this->db2->where("id_koneksi", $id);

        $result = $this->db2->get($this->table);
        return $result->row();
    }

	public function get_apps($nama_app = "")
	{
		$sql = "select * from dataaplikasi where nama_app='$nama_app'";
		$result = $this->db2->query($sql);
		return $result->row();
	}

	public function insert_apps($data_apps = array())
	{
		$result = $this->db2->insert($this->table_apps, $data_apps);
        if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
        else
            return FALSE;
	}

	public function insert_fitur($data_fitur = array())
	{
		$result = $this->db2->insert($this->table_fitur, $data_fitur);
        if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
        else
            return FALSE;
	}

	public function insert_koneksi($data_koneksi = "")
	{
		$sql = "insert into data_koneksi (id_app, id_fitur, konekTo_app, konekTo_fitur, konekTo_tipe_fitur, konekTo_ip_fitur, tgl_input) values".$data_koneksi;
		$result = $this->db2->query(substr($sql,0,-1));
		if ($this->db2->affected_rows() > 0)
            return $this->db2->insert_id();
        else
            return FALSE;
	}

	public function get_koneksi($id_app ="", $id_fitur="")
	{
		$sql = "SELECT * FROM data_koneksi where id_app='$id_app' and id_fitur='$id_fitur'";
		$result = $this->db2->query($sql);
		return $result->result();
	}

	public function get_fitur($id_app ="", $id_fitur="")
	{
		$this->db2->join('dataaplikasi', 'dataaplikasi.id_app = datafitur.id_app');
		$this->db2->where('datafitur.id_app', $id_app);
		$this->db2->where('datafitur.id_fitur', $id_fitur);
		$res = $this->db2->get('datafitur');
		return $res->row();
	}

	public function delete_apps($id_apps=0, $id_fitur=0) {
        $this->db2->where('id_app', $id_apps);
        $this->db2->where('id_fitur', $id_fitur);
        $this->db2->delete('datafitur');
        $this->db2->where('id_app', $id_apps);
        $this->db2->where('id_fitur', $id_fitur);
        $this->db2->delete('data_koneksi');
        $err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

    public function delete_conn($id_koneksi = 0)
    {
    	$this->db2->where('id_koneksi', $id_koneksi);
    	$this->db2->delete('data_koneksi');
    	$err = $this->db2->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
    }

	public function get_koneksi_by_id($id_koneksi = 0)
	{
		$this->db2->where('id_koneksi', $id_koneksi);
		$res = $this->db2->get('data_koneksi');
		return $res->row();
	}

	function get_list_koneksi($id = 0) {
        $this->db2->where($this->key, $id);
        $result = $this->db2->get($this->table);
        return $result->row();
    }

	public function update_koneksi($id_koneksi = 0, $data_koneksi = array())
	{
		$this->db2->where('id_koneksi', $id_koneksi);
		$res = $this->db2->update('data_koneksi', $data_koneksi);
		$err = $this->db2->error();
        if ($err['code'] != 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db2->affected_rows();
	}

	//------------------- DATA TAPE PF----------------------------------

	private function _get_datatables_query_data_koneksi()
	{
		
		$conditions = array();

		$aplikasi = strtoupper($this->input->post('namaapp'));
        	$fitur = strtoupper($this->input->post('namafitur'));
        	$ip = strtoupper($this->input->post('ip'));

		if($aplikasi!="")
		{
			$conditions[] = $this->db2->like('x.nama_app', $aplikasi);
		}
		if($fitur !="")
		{
			$conditions[] = $this->db2->like('x.nama_fitur', $fitur );
		}
		if($ip!="")
		{
			$conditions[] = $this->db2->like('x.ip_fitur', $ip);
		}
		$conditions[] = $this->db2->where("x.status", "dikonfirmasi");
		$j = count($conditions);
		if($j>0)
		{
			for($i=0;$i<$j;$i++)
			{
				$conditions[$i];
			}
		}

		$this->db2->from("(SELECT a.id_app id_app, b.id_fitur id_fitur, b.tipe_fitur tipe_fitur, a.nama_app nama_app, b.status status, b.nama_fitur nama_fitur, b.ip_fitur ip_fitur FROM dataaplikasi a right join datafitur b on a.id_app=b.id_app) x");

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

	

	function get_datatables_data_koneksi($table='', $column_order=array(), $column_search=array(), $order=array())
	{

		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		
		$this->db2->select('x.id_app, x.id_fitur, x.nama_app, x.nama_fitur, x.tipe_fitur, x.ip_fitur, count(z.id_koneksi) total_koneksi');
        	$this->db2->join('data_koneksi z','z.id_app=x.id_app and z.id_fitur=x.id_fitur', 'left');
        //$this->db2->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');
		
		$this->_get_datatables_query_data_koneksi();
		if($_POST['length'] != -1)
		$this->db2->limit($_POST['length'], $_POST['start']);
		$this->db2->group_by('x.id_fitur');
		$query = $this->db2->get();
		return $query->result();
	}

	function count_filtered_data_koneksi($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->select('x.id_app, x.id_fitur, x.nama_app, x.nama_fitur, x.tipe_fitur, x.ip_fitur, count(z.id_koneksi) total_koneksi');
        $this->db2->join('data_koneksi z','z.id_app=x.id_app and z.id_fitur=x.id_fitur', 'left');
        //$this->db2->join('tape_content', 'data_tape.set_tape = tape_content.set_tape');

		$this->_get_datatables_query_data_koneksi();
		$this->db2->group_by('x.id_fitur');
		$query = $this->db2->get();
		return $query->num_rows();
	}

	public function count_all_data_koneksi($table='', $column_order=array(), $column_search=array(), $order=array())
	{
		$this->table = $table;
		$this->column_order = $column_order;
		$this->column_search = $column_search;
		$this->order = $order;
		$this->db2->select('x.id_app, x.id_fitur, x.nama_app, x.nama_fitur, x.tipe_fitur, x.ip_fitur, count(z.id_koneksi) total_koneksi');
        $this->db2->join('data_koneksi z','z.id_app=x.id_app and z.id_fitur=x.id_fitur', 'left');
        $this->db2->group_by('x.id_fitur');
		$this->db2->from($this->table);
		return $this->db2->count_all_results();
	}



}
