<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_ck_sud extends CI_Model {

    var $table_ajax = '';
    var $column_order = array(); //set column field database for datatable orderable
    var $column_search = array(); //set column field database for datatable searchable 
    var $order = array(); // default order 

    private $table = 'pakai_anggaran';
    private $key = 'id';
   
    private $db2;

    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('ck_sud', TRUE);   
    }

    function get_zs_day(){
        $this->db2->select('*');
        $this->db2->where('type', 'DAILY');
        $result = $this->db2->get('ck_zs_param');
        return $result->result();
    }

    function get_zs_week(){

    }


    function add_zs_data($data=array()){
        $result = $this->db->insert('ck_zs_data', $data);
        if ($this->db->affected_rows() > 0)
            $this->db->insert_id();
        else
            return FALSE;
    }

    function get_all() {
        $this->db->select('*');
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->select('*');
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    function add($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        //$this->db->insert_id();
        else
            return FALSE;
    }

    function update($id = 0, $data = array()) {
        $this->db->where($this->key, $id);
        $this->db->update($this->table, $data);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function delete($id = 0) {
        $this->db->where($this->key, $id);
        $this->db->delete($this->table);
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }


    /////////////////////////////////////////////////// datatables /////////////////////////////////////////////////////

    //Eksekusi query
    private function _get_datatables_query()
    {
        
               


        $this->db->from($this->table_ajax);

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
    function get_datatables($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table_ajax = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->db->select('*');
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    //menghitung jumlah data yang ditampilkan sesuai filter
    function count_filtered($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table_ajax = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->db->select('*');
      
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    //menghitung jumlah keseluruhan data
    public function count_all($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table_ajax = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->db->select('*');
        $this->db->from($this->table_ajax);
        return $this->db->count_all_results();
    }

}
