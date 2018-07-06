<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_waktu_eod extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report_eod', 'fdb');
        $this->load->model('m_kategori_issue', 'kategori_d');
      
        $this->cname = 'report';
        $this->menu = 'Report EOD';
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

        $data['title'] = 'Report Elapsed Time EOD';
        $data['active'] = 'report_waktu_eod';
        $data['data_elapsed'] = $this->fdb->getElapsed_Last();
        $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_waktu_eod');
        $data['data_job'] = $this->fdb->getJob();
        $data['content'] = 'report_waktu_eod';
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['year'] = $year;
      
        if($this->input->post())
        {
            $tipe = $this->input->post('tipe');
            $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
            if($tipe == "All" && $start_date!="" && $end_date!="")
            {
                $data['data_job'] = $this->fdb->getJob();
                $data['data_elapsed'] = $this->fdb->getElapsed_Tanggal($start_date, $end_date);
                $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_waktu_eod');
            }
            else
            {
                $data['data_job'] = $this->fdb->getJob();
                $data['data_elapsed'] = $this->fdb->getElapsed_Tanggal_Job($start_date, $end_date, $tipe);
                $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_waktu_eod');
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
