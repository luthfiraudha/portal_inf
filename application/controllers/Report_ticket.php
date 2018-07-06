<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_ticket extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report', 'fdb');
        $this->load->model('m_report_ticket', 'r_tik');
        $this->load->model('m_kategori_issue', 'kategori_d');
      
        $this->cname = 'report_ticket';
        $this->menu = 'Report Ticket';
        $this->fitur = '';

        if (!cek_auth()) {
            flash_err('Authorization needed.');
            redirect(base_url('auth'));
        }
        $this->active_user_id = get_session('user_id');
        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }



    /////////////////////////// REPORT TICKET  ///////////////////////////////////////////
    public function index(){
        if($this->input->post('tanggal') ==""){
            $tanggal =date('Y-m-d', strtotime('-30 days', strtotime(date("Y-m-d"))));
        }else{
             $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
        }
        if($this->input->post('tanggal2') ==""){
            $tanggal2 =date("Y-m-d");
        }else{
             $tanggal2 = date("Y-m-d", strtotime($this->input->post('tanggal2')));
        }


        $limit = 20;

        $data['ticket_total'] = $this->r_tik->hitungtotaltiket($tanggal,$tanggal2, $limit);

        $data_tape = array();
        $object = array();
        foreach ($data['ticket_total'] as $row) {
            $object['name'] = $row->kategori_nama;
            $object['data'] = array(intval($row->total));
            array_push($data_tape, $object);
        }
        $data['data_tape'] = $data_tape; 

        $data['title'] = 'Report Ticket';
        $this->fitur = 'List';
        $data['active'] = 'report_ticket';
        $data['content'] = 'report_ticket';
        $data['plugins'] = array('datatables','daterangepicker','kategori_suggest','ticket_source','highcharts','hc_report_ticket_bar');
       
       
        $this->load->view('template', $data);
    }

    public function search(){
        if($this->input->post('tanggal') ==""){
            $tanggal =date('Y-m-d', strtotime('-15 days', strtotime(date("Y-m-d"))));
        }else{
             $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
        }
        if($this->input->post('tanggal2') ==""){
            $tanggal2 =date("Y-m-d");
        }else{
             $tanggal2 = date("Y-m-d", strtotime($this->input->post('tanggal2')));
        }
        $limit =$this->input->post('total');

        $data['ticket_total'] = $this->r_tik->hitungtotaltiket($tanggal,$tanggal2, $limit);


        $data_tape = array();
        $object = array();
        foreach ($data['ticket_total'] as $row) {
            $object['name'] = $row->kategori_nama;
            $object['data'] = array(intval($row->total));
            array_push($data_tape, $object);
        }
        $data['data_tape'] = $data_tape; 

        $data['title'] = 'Report Ticket';
        $this->fitur = 'List';
        $data['active'] = 'report_ticket';
        $data['content'] = 'report_ticket';
        $data['plugins'] = array('datatables','daterangepicker','kategori_suggest','ticket_source','highcharts','hc_report_ticket_bar');
       
       
        $this->load->view('template', $data);

    }





}
