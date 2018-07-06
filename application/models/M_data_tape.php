<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_tape extends CI_Model {


    function add($data = array(), $data_record = array()) {
        $result = $this->db->insert("data_tape", $data);
        $result = $this->db->insert("tape_record", $data_record); 
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;        
    }

    function get_row($id = 0) {
        $this->db->where('id_tape', $id);
        $result = $this->db->get('data_tape');
        return $result->row();
    }

    public function request($id = 0, $tape_request = array(), $data_record = array())
    {
        $this->db->where('id_tape', $id);
        $this->db->update('tape_record', $data_record);
        $this->db->insert('request_tape', $tape_request);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }


    function view_id($id = 0)
    {
        $result = $this->db->select('data_tape.*, tape_record.*');
        $result = $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        $result = $this->db->where('data_tape.id_tape', $id);
        $result = $this->db->get('data_tape');
        return $result->row();
    }

    function update($id = 0, $data = array(), $data_record = array()) {
        $this->db->where('id_tape', $id);
        $this->db->update('data_tape', $data);
        $this->db->where('id_tape', $id);
        $this->db->update('tape_record', $data_record);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function delete($id_tape = 0) {
        $this->db->where('id_tape', $id_tape);
        $this->db->delete('data_tape');
        $this->db->where('id_tape', $id_tape);
        $this->db->delete('tape_record');
        $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function get_all()
    {
        $result = $this->db->select('data_tape.*, tape_record.*, DATEDIFF(data_tape.end_date,CURDATE()) as tempo');
        $result = $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        $result = $this->db->order_by('data_tape.end_date', 'acs');
	$result = $this->db->where('data_tape.status != "EOM"');
	$result = $this->db->where('data_tape.status != "EOY"');
	$result = $this->db->where('data_tape.status != "New Tape"');

        $result = $this->db->limit('10');
        $result = $this->db->get('data_tape');
        return $result->result();
    }

    function get_setTape($library)
    {
        //$library = $library;
        $this->db->where('library', $library);
        $result = $this->db->get('tape_content');
        return $result->result();
    }

    function search($tanggal, $library, $state, $status, $lokasi)
    {
        $data = $this->get_set($library, $state, $status);
        $result = $this->db->select('data_tape.*, tape_record.*');
        $result = $this->db->join('tape_record','data_tape.id_tape = tape_record.id_tape');
        $result = $this->db->where('data_tape.start_date', $tanggal);
        $result = $this->db->where('data_tape.set_tape', $data->set_tape);
        $result = $this->db->where('data_tape.status', $status);
        $result = $this->db->where('data_tape.lokasi', $lokasi);
        return $result->row();
    }

    function suges_library($term){
        $this->db->like('library',$term);
        $this->db->group_by('library');
        $result = $this->db->get('tape_content');
        return $result->result();
    }
}