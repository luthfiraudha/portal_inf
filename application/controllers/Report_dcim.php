<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_dcim extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report_dcim', 'fdb');
        $this->load->model('m_kategori_issue', 'kategori_d');
      
        $this->cname = 'report_dcim';
        $this->menu = 'DCIM';
        $this->fitur = 'Report';

        if (!cek_auth()) {
            flash_err('Authorization needed.');
            redirect(base_url('auth'));
        }
        $this->active_user_id = get_session('user_id');
        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index() {

        $data['title'] = 'DCIM';
        $data['fitur'] = 'Report';
        $data['active'] = 'report_dcim';
        $data['plugins'] = array('datatables');
        $data['content'] = 'report_dcim';
        $data['dcim'] = $this->fdb->getall();

        $this->load->view('template', $data);
    }

    public function search()
    {
        if($this->input->post())
        {
            $location = $this->input->post('cabinet');
            $dc = $this->input->post('datacenter');
            $no_serial = $this->input->post('no_serial');
            if($no_serial == "" && $location ==""){
                $data['data_cabinet'] = $this->fdb->getNotBy_SerialLocation($dc);
                $data['dcim'] ="";
            } else if($location != ""){
                $data['data_location'] = $this->fdb->getByLocation($location, $dc);
                $data['dcim'] ="";
            } else if($no_serial != "" || $dc !="" || $location =="")
            {
                $data['data_serial'] = $this->fdb->getByNoSerial($no_serial);
                $data['data_detail'] = $this->fdb->getDataDevice($no_serial);
                $data['dcim'] ="";
            }
        }
        $data['title'] = 'Report DCIM';
        $data['active'] = 'report_dcim';
        $data['plugins'] = array('datatables');
        $data['content'] = 'Report_dcim';

        $this->load->view('template', $data);
    }

}
