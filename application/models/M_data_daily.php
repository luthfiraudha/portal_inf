<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_daily extends CI_Model {

    
    private $table = 'data_daily';
    private $key = 'id';
   

    function get_all() {
        $this->db->select('data_daily.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_daily.user_id = user.user_id');
        $this->db->join('data_kategori','data_daily.kategori_id = data_kategori.kategori_id');
       // $this->db->where("data_daily.hapus", 0);
        $result = $this->db->get($this->table);
        return $result->result();
    }

    function get_row($id = 0) {
        $this->db->select('data_daily.*, user.user_nama, data_kategori.kategori_nama');
        $this->db->join('user','data_daily.user_id = user.user_id');
        $this->db->join('data_kategori','data_daily.kategori_id = data_kategori.kategori_id');
       // $this->db->where("data_daily.hapus", 0);
        $this->db->where($this->key, $id);
        $result = $this->db->get($this->table);
        return $result->row();
    }

    function add($data = array()) {
        $result = $this->db->insert($this->table, $data);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function update($id = 0, $data = array()) {
        //$this->db->where("hapus", 0);
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

   

    function selectmaxid($type = ""){
        $query = "SELECT MAX(data_daily.id) AS max_id from data_daily";
        $result = $this->db->query($query);

        return $result->row();

    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   

    //------------------- DATA RECORD DAILY----------------------------------

    private function _get_datatables_query_daily()
    {
        

                $conditions = array();
                if($this->input->post('tglIssue') ==""){
                    $tanggal ="";
                }else{
                     $tanggal = date("Y-m-d", strtotime($this->input->post('tglIssue')));
                }
                $kategori = $this->input->post('kategori');
                $shift = $this->input->post('shift');
                $job = $this->input->post('job');
               
               if($tanggal !="") {
                  $conditions[] =  $this->db->where('DATE(tanggal)', $tanggal);
                }
                if($shift !="") {
                  $conditions[] = $this->db->where('shift', $shift);
                }
                if($kategori !="") {
                  $conditions[] = $this->db->where('kategori_nama', $kategori);
                }

                if($job !="") {
                  $conditions[] = $this->db->where('job_nama', $job);
                }                      

                 $j = count($conditions);
                if ( $j> 0) {
                  for($i=0;$i<$j;$i++){
                    $conditions[$i];
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

    function get_datatables_daily($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
     
        
        $this->_get_datatables_query_daily();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_daily($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
       
        $this->_get_datatables_query_daily();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_daily($table='', $column_order=array(), $column_search=array(), $order=array())
    {
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
     
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }



}
