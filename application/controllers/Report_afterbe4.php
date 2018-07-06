<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_afterbe4 extends CI_Controller {

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

        $data['data_job'] = $this->fdb->getJob();
        $data['title'] = 'Report After Before EOD';
        $data['active'] = 'report_afterbe4';
        $data['plugins'] = array('highcharts','daterangepicker', 'highcharts_report_afterbe4');
        $data['content'] = 'report_afterbe4';
	$dataafter = $this->fdb->getAfter_Last("EOD Brinets Indonesia");
        $databe4 = $this->fdb->getBe4_Last("EOD Brinets Indonesia");
        $data['data_after'] = $dataafter;                       
        $data['data_be4'] = $databe4; 
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['year'] = $year;
	$data['title'] = 'Report After Before EOD'.' Brinets Indonesia';

        // $data['data_tape'] = $this->generateJSON($this->fdb->getTapePF_bulan());
        // $data['data_tape_day'] = $this->fdb->getTapePF_day();
        // $data['size_tape_of'] = $this->fdb->getSizeTapeOF();
      
        if($this->input->post())
        {
            $tipe = $this->input->post('tipe');
            $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
            if($tipe != "All" && $start_date!="" && $end_date!="")
            {
                $dataafter = $this->fdb->getAfter_Tanggal($start_date, $end_date, $tipe);
                $databe4 = $this->fdb->getBe4_Tanggal($start_date, $end_date, $tipe);
                $data['data_after'] = $dataafter;                       
                $data['data_be4'] = $databe4;  
                //$data['data_eod'] = $this->generateJSON($dataafter, $databe4);
		$data['title'] = 'Report After Before EOD '.$tipe;
                $data['plugins'] = array('highcharts', 'daterangepicker', 'highcharts_report_afterbe4');
            }
            else if($tipe == "All" && $start_date!="" && $end_date!=""){

            }
            else
            {

            }
        }
    
        $this->load->view('template', $data);
    }

    public function generateJSON($data_after = array(), $data_be4 = array())
    {
        $data_eod = array();
        $object = array();
        $a = array('after','before');
        
        for ($i=0; $i<2; $i++) {
            $object['name'] = $a[$i];
            $object['data'] = array();

            if($a[$i] == "after")
            {
                foreach ($data_after as $key) {
                  $object_data = array();
                  $object_data['name'] = $key->tanggal;
                      $object_data['y'] = $key->jam;
                      array_push($object['data'], $object_data);
                  
              }
            }
            else
            {
              foreach ($data_be4 as $key2) {
                  $object_data = array();
                  $object_data['name'] = $key2->tanggal;
                      $object_data['y'] = $key2->jam;
                      array_push($object['data'], $object_data);
                  
              }
            }
        array_push($data_eod, $object);
        }
        return $data_eod;
    }

    // public function generateJSON($data=array(), $nama=""){
    //   $data_eod = array();
    //   $object = array();
    //   $object['name'] = $nama;
    //   $object['data'] = array();
    //   foreach ($data as $key) {
    //     $object_data = array();
    //     $object_data['name'] = $key->tanggal;
    //     $object_data['y'] = $key->jam;
    //     array_push($object['data'], $object_data);
    //   }
    //   array_push($data_eod, $object);
    //   return $data_eod;
    // }
}
