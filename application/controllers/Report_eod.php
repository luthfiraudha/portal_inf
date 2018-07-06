<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_eod extends CI_Controller {

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

        $data['title'] = 'Report Transaksi EOD Brinets';
        $data['active'] = 'report_eod';
        $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_trx');
        $data['content'] = 'report_eod';

        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['year'] = $year;
	   $datatrx = $this->fdb->getTrxLast();
	   $data['data_job'] = $this->fdb->getJobTrx();
       $datajob = $this->fdb->getJobTrx();
	   $data_trx = $this->generateJSON($datatrx, $datajob);
        
        $data['data_trx'] = $data_trx;


      
        if($this->input->post())
        {
            $tipe = $this->input->post('tipe');
            $job = $this->input->post('job');
            $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));

            if($tipe == "Transaksi")
            {
                if($start_date != "" && $end_date !="")
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $datatrx = $this->fdb->getTrx_Tanggal($start_date, $end_date);
                    $datajob = $this->fdb->getJobTrx();
                    $data_trx = $this->generateJSON($datatrx, $datajob);
                    $data['data_trx'] = $data_trx;   
                    $data['title'] = 'Report Transaksi EOD';                    
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_trx');
                }
                else
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $datatrx = $this->fdb->getTrx_Tanggal($start_date, $end_date);
                    $datajob = $this->fdb->getJobTrx();
                    $data_trx = $this->generateJSON($datatrx, $datajob);
                    $data['data_trx'] = $data_trx;                       
                    $data['title'] = 'Report Transaksi EOD';
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_trx');
                }
                $data['title_chart'] = "Report Transaksi";
            }
            else if($tipe == "Elapsed Time")
            {
                if($start_date != "" && $end_date !="")
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $data['title'] = 'Report Elapsed Time EOD';
                    $data['data_elapsed'] = $this->fdb->getElapsed_Tanggal_Job($start_date, $end_date, $job);
                    
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_waktu_eod');
                }
                else
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $data['data_elapsed'] = $this->fdb->getElapsed_Last();
                    $data['title'] = 'Report Elapsed Time EOD';
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_waktu_eod');
                }
                $data['title_chart'] = "Report Elapsed Time";
                $data['job'] = $job;
            }
            else if($tipe == "Start End EOD")
            {
                if($job != "" && $start_date != "" && $end_date !="")
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $dataafter = $this->fdb->getAfter_Tanggal($start_date, $end_date, $job);
                    $databe4 = $this->fdb->getBe4_Tanggal($start_date, $end_date, $job);
                    $data['data_after'] = $dataafter;                       
                    $data['data_be4'] = $databe4;  
                    //$data['data_eod'] = $this->generateJSON($dataafter, $databe4);
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_afterbe4');
                }
                else
                {
                    $data['data_job'] = $this->fdb->getJobTrx();
                    $job = "EOD Brinets Indonesia";
                    $dataafter = $this->fdb->getAfter_Tanggal($start_date, $end_date, $job);
                    $databe4 = $this->fdb->getBe4_Tanggal($start_date, $end_date, $job);
                    $data['data_after'] = $dataafter;                       
                    $data['data_be4'] = $databe4;  
                    $data['plugins'] = array('highcharts','datatables', 'daterangepicker', 'highcharts_report_afterbe4');
                }
                $data['title'] = 'Report Start End Job '.$job;
                $data['title_chart'] = "Report Start End Job ".$job;
                
            }
            $data['data_job'] = $this->fdb->getJobTrx();
        }
    
        $this->load->view('template', $data);
    }

    public function generateJSON($datatrx = array(), $data_job = array())
    {
        $data_trx = array();
        $object = array();
        
        foreach ($data_job as $row) {
            $object['name'] = $row->job_nama;
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
