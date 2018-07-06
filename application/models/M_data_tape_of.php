<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_data_tape_of extends CI_Model {


    function add($data = array(), $data_record = array()) {
        $result = $this->db->insert("data_tape_of", $data);
        $result = $this->db->insert("tape_record_of", $data_record); 
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
        $this->db->where('id_record', $id);
        $this->db->update('tape_record_of', $data_record);
        $this->db->insert('request_tape', $tape_request);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return FALSE; // Or do whatever you gotta do here to raise an error
        } else
            return $this->db->affected_rows();
    }

    function view_id($id = 0)
    {
        $result = $this->db->select('data_tape_of.vol_id, data_tape_of.lokasi, data_tape_of.size_usage, data_tape_of.size_total,
                 tape_record_of.*, content_tape_of.*');
        // $result = $this->db->join('data_tape_of','data_tape_of.id_tape = tape_record.id_record');
        // $result = $this->db->join('con_tape_of','content_tape_of.tape = data_tape_of.id_tape', 'right outer');
        

        $result = $this->db->join('data_tape_of', 'content_tape_of.tape = data_tape_of.id_tape', 'right outer');
        $result = $this->db->join('tape_record_of','data_tape_of.id_tape = tape_record_of.id_record');
        $result = $this->db->where('content_tape_of.id_content', $id);

        $result = $this->db->get('content_tape_of');
        return $result->row();
    }

    function update($id = 0, $id_tape = 0, $data = array(), $data_record = array(), $data_tape_of = array()) {
        $result1 = $this->db->where('id_content', $id);
        $result1 = $this->db->update('content_tape_of', $data);
        $result2 = $this->db->where('id_tape', $id_tape);
        $result2 = $this->db->update('data_tape_of', $data_tape_of);
        $result3 = $this->db->where('id_record', $id_tape);
        $result3 = $this->db->update('tape_record_of', $data_record);
         $err = $this->db->error();
        if ($err['code'] !== 0) {
            return $err; // Or do whatever you gotta do here to raise an error
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

    function suges_hostname($term){
        $this->db->like('mdsc.dataaplikasi.nama_app',$term);
        $this->db->group_by('mdsc.dataaplikasi.nama_app');
        $result = $this->db->get('mdsc.dataaplikasi');
        return $result->result();
    }

    function suges_ip($hostname, $ip){
        $this->db->like('mdsc.dataaplikasi.nama_app',$hostname);
        $this->db->like('mdsc.datafitur.ip_fitur',$ip);
        $this->db->join('mdsc.datafitur', 'mdsc.dataaplikasi.id_app = mdsc.datafitur.id_app');
        $this->db->group_by('mdsc.datafitur.ip_fitur');
        $result = $this->db->get('mdsc.dataaplikasi');
        return $result->result();
    }
}