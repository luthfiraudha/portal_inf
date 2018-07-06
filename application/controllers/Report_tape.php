<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_tape extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report_tape', 'fdb');
        $this->load->model('m_kategori_issue', 'kategori_d');
      
        $this->cname = 'report';
        $this->menu = 'Report';
        $this->fitur = '';

        if (!cek_auth()) {
            flash_err('Authorization needed.');
            redirect(base_url('auth'));
        }
        $this->active_user_id = get_session('user_id');
        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index() {

        $data['title'] = 'Report Tape PF';
        $data['active'] = 'report_tape';
        $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_tape_pf_l', 'highcharts_tape_pf_v', 'highcharts_tape_of_v');
        $data['content'] = 'report_tape';
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['year'] = $year;
        $data['data_tape'] = $this->generateJSON($this->fdb->getTapePF_bulan());
        $data['data_tape_day'] = $this->fdb->getTapePF_day();
        $data['size_tape_of'] = $this->fdb->getSizeTapeOF();
      
        if($this->input->post())
        {
            $tape = $this->input->post('tape');
            $tipe = 'l';
            $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
            if($tape != "empty" && $tipe != "empty" && $start_date!="" && $end_date!="")
            {
                   if($tape =="of")
                   {
                        $tape_of = $this->fdb->getTapeOF_tanggal($start_date, $end_date);                   
                        $nama_app = $this->fdb->getHostname();
                        $data['title'] = 'Report Tape OF';
                        if($tipe == "l")
                        {     
                            $data_tape = array();
                            $object = array();
                            foreach ($nama_app as $row) {
                            $object['name'] = $row->nama_app;
                            $object['data'] = array();

                            foreach ($tape_of as $key) {
                                $object_data = array();
                                    if($key->nama_app == $object['name'])
                                    {
                                        $object_data['name'] = $key->tanggal;
                                        $object_data['y'] = intval($key->jumlah);
                                        array_push($object['data'], $object_data);
                                    }
                                }
                                array_push($data_tape, $object);
                            }
                            $data['data_tape'] = $data_tape;                       
                            $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_tape_pf_v', 'highcharts_tape_of_v', 'highcharts_tape_of_l');
                        } elseif($tipe =="b")
                        {
                            $data['data_tape'] = $tape_of;
                            $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_tape_of_v', 'highcharts_tape_of_v', 'highcharts_tape_pf_b');
                        }
                   }
                   else if($tape =="pf")
                   {                        
                        $data['title'] = 'Report Tape PF';
                        $tape_pf = $this->fdb->getTapePF_tanggal($start_date, $end_date);
                        if($tipe == "l")
                        {                            
                            $data['data_tape'] = $this->generateJSON($tape_pf);
                            $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_tape_pf_l', 'highcharts_tape_pf_v', 'highcharts_tape_of_v');
                        } elseif($tipe =="b")
                        {
                            $data['data_tape'] = $tape_pf;
                            $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_tape_pf_b', 'highcharts_tape_pf_v', 'highcharts_tape_of_v');
                        }
                   }
            }
            else
            {

            }
        }
    
        $this->load->view('template', $data);
    }

    public function generateJSON($tape_pf = array())
    {
        $data_tape = array();
        $object = array();
        $avaibility = $this->fdb->getAvaibility();
        foreach ($avaibility as $row) {
            $object['name'] = $row->jenis;
            $object['data'] = array();

            foreach ($tape_pf as $key) {
                $object_data = array();
                if($key->jenis == $object['name'])
                {
                    $object_data['name'] = $key->tanggal;
                    $object_data['y'] = intval($key->jumlah);
                    array_push($object['data'], $object_data);
                }
            }
        array_push($data_tape, $object);
        }
        return $data_tape;
    }

}
