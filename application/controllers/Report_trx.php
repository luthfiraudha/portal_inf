<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_trx extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report_eod', 'fdb');
      
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

        $data['title'] = 'Report Transaksi';
        $data['active'] = 'report_trx';
        $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_trx');
        $data['content'] = 'report_trx';
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['year'] = $year;

		$datatrx = $this->fdb->getTrxLast();
                $datajob = $this->fdb->getJobTrx();
                $data_trx = $this->generateJSON($datatrx, $datajob);
                $data['data_trx'] = $data_trx;                       
                $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_trx');
      
        if($this->input->post())
        {
            $tipe = $this->input->post('tipe');
            $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
            if($tipe == "perhost" && $start_date!="" && $end_date!="")
            {
                   
                $datatrx = $this->fdb->getTrx_Tanggal($start_date, $end_date);
                $datajob = $this->fdb->getJob();
                $data_trx = $this->generateJSON($datatrx, $datajob);
                $data['data_trx'] = $data_trx;                       
                $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_trx');
            }
            else if($tipe == "All" && $start_date!="" && $end_date!=""){

            }
            else
            {

            }
        }
    
        $this->load->view('template', $data);
    }

    public function generateJSON($datatrx = array(), $data_job = array())
    {
        $data_trx = array();
        $object = array();
        
        foreach ($data_job as $row) {
            $object['name'] = $row->nama_job;
            $object['data'] = array();

            foreach ($datatrx as $key) {
                $object_data = array();
                if($key->jenis == $object['name'])
                {
                    $object_data['name'] = $key->tanggal;
                    $object_data['y'] = intval($key->jumlah);
                    array_push($object['data'], $object_data);
                }
            }
        array_push($data_trx, $object);
        }
        return $data_trx;
    }

}
