<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_report', 'fdb');
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

        $data['title'] = 'Report';
        $data['active'] = 'report';
        $data['plugins'] = array('highcharts','datatables');
        $data['content'] = 'Report';
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['report_problem_success'] = $this->fdb->countSuccessMonth($month,$year);
      
        $data['report_problem_notsuccess'] = $this->fdb->countnotSuccessMonth($month,$year);
        $data['report_problem_kategori'] = $this->fdb->countProblembyKategori($month);
        
        $data['vendor'] = $this->fdb->getIntervalVendor();
    
        $this->load->view('template', $data);
    }

   

    public function vendor_summary(){
        $data['title'] = 'Vendor Summary';
        $data['active'] = 'vendor_summary';
        $data['plugins'] = array('datatables');
        $data['content'] = 'vendor_summary';
        $month = date('m');
        $year = date('Y');
        $data['month'] = $month;
        $data['vendor'] = $this->fdb->getIntervalVendor();
         $this->load->view('template', $data);
    }



    public function ts_perform(){
        $month = date('m');
        $year = date('Y');

        $data['title'] = 'Troubleshoot Perfrom';
        $data['active'] = 'ts_perform';
        
        $data['content'] = 'ts_perform';
        $data['month'] = $month;
        $data['plugins'] = array('highcharts','highcharts_ts_l');
        $data['report_problem_success'] = $this->fdb->countSuccessMonth($month,$year);
        $data['report_problem_notsuccess'] = $this->fdb->countnotSuccessMonth($month,$year);
        
       
        $this->load->view('template', $data);
    }

   public function ts_performm(){
        
        if($this->input->post()){
            $month = $this->input->post('month');

            if ($month == "empty") {
                $month = date('m');
            }

            $type = $this->input->post('tipe');
            if ($type == "empty") {
                $type = 'l';
            }
        }
        $year = date('Y');

        
        $data['title'] = 'Troubleshoot Perfrom';
        $data['active'] = 'ts_perform';
        
        $data['content'] = 'ts_perform';
        $data['month'] = $month;

        if($type=='v'){
            
            $data['plugins'] = array('highcharts', 'highcharts_ts_v');
            $data['report_problem'] = $this->fdb->totalTicketPeform($month,$year);
            
        }elseif($type=='b'){
            
            $data['plugins'] = array('highcharts', 'highcharts_ts_b');
            $data['report_problem_success'] = $this->fdb->countSuccessMonth($month,$year);
            $data['report_problem_notsuccess'] = $this->fdb->countnotSuccessMonth($month,$year);
        }else{
            $data['plugins'] = array('highcharts', 'highcharts_ts_l');
            $data['report_problem_success'] = $this->fdb->countSuccessMonth($month,$year);
            $data['report_problem_notsuccess'] = $this->fdb->countnotSuccessMonth($month,$year);
        }
        
        $this->load->view('template', $data);
    }



    public function report_ticket(){
        $month = date('m');
        $year = date('Y');

        $data['title'] = 'Report Ticket';
        $data['active'] = 'report_ticket';
        
        $data['content'] = 'report_ticket';
        $data['month'] = $month;
        $data['plugins'] = array('highcharts', 'highcharts_ticket_l','kategori_suggest');
        $kategori = $this->fdb->getKategoriTicket();
        $i=0;
        foreach ($kategori as $k) {
            $data['kategori_nama'][$i] = $k->nama;
            $data['report_problem_kategori'][$i] = $this->fdb->countProblembyKategoriLine($month,$year,$k->kategori_id);
            $i++;
        }
        $data['total_data'] = $i;
            
        
       
        $this->load->view('template', $data);
    }

   public function report_ticketm(){
        
        if($this->input->post()){
            $month = $this->input->post('month');

            if ($month == "empty") {
                $month = date('m');
            }

            $type = $this->input->post('tipe');
            if ($type == "empty") {
                $type = 'l';
            }

            $kategori = $this->input->post('kategori_nama');
            
            if($kategori == ''){
                $kategori = NULL;
            }
        }
        $year = date('Y');

        
        $data['title'] = 'Report Ticket';
        $data['active'] = 'report_ticket';
        
        $data['content'] = 'report_ticket';
        $data['month'] = $month;

        if($type=='v'){
            
            $data['plugins'] = array('highcharts', 'highcharts_ticket_v','kategori_suggest');
            $data['report_problem_kategori'] = $this->fdb->countProblembyKategori($month,$year);
            
        }elseif($type=='b'){
            $cekkategori = $this->kategori_d->cek_kategori($kategori);
            if($cekkategori){
                 $data['report_problem_kategori'] = $this->fdb->countProblembyKategori($month,$year,$kategori);
            }elseif(!$cekkategori){
                  flash_err("Data yang dicari tidak ditemukan. Berikut Data semua yang ada.");
                 $kategori = '';
                 $data['report_problem_kategori'] = $this->fdb->countProblembyKategori($month,$year,$kategori);
            }
            $data['plugins'] = array('highcharts', 'highcharts_ticket_b','kategori_suggest');
           
        }elseif($type=='l'){

            $data['plugins'] = array('highcharts', 'highcharts_ticket_l','kategori_suggest');
            if($kategori != NULL){

                $cekkategori = $this->kategori_d->cek_kategori($kategori);
                
                if($cekkategori){

                    $j=0;
                    foreach ($cekkategori as $k) {

                        $data['kategori_nama'][$j] = $k->kategori_nama;
                        $data['report_problem_kategori'][$j] = $this->fdb->countProblembyKategoriLine($month,$year,$k->kategori_id);
                        $j++;
                    }
                   $data['total_data'] = $j;
                }elseif(!$cekkategori){
                     flash_err("Data yang dicari tidak ditemukan. Berikut Data semua yang ada.");
                     $kategori = $this->fdb->getKategoriTicket();
                    $i=0;
                    foreach ($kategori as $k) {
                        $data['kategori_nama'][$i] = $k->nama;
                        $data['report_problem_kategori'][$i] = $this->fdb->countProblembyKategoriLine($month,$year,$k->kategori_id);
                        $i++;
                    }
                    $data['total_data'] = $i;
                }
            }elseif($kategori == NULL){
                flash_err("Data yang dicari tidak ditemukan. Berikut Data semua yang ada.");
                $kategori = $this->fdb->getKategoriTicket();
                $i=0;
                foreach ($kategori as $k) {
                    $data['kategori_nama'][$i] = $k->nama;
                    $data['report_problem_kategori'][$i] = $this->fdb->countProblembyKategoriLine($month,$year,$k->kategori_id);
                    $i++;
                }
                $data['total_data'] = $i;
            }
            
            
        }
        
       
       
        $this->load->view('template', $data);
    }



    public function report_user(){
        $month = date('m');
        $year = date('Y');
        $data['title'] = 'Report User Activity';
        $data['active'] = 'report_user';
        
        $data['content'] = 'report_user';
        $data['month'] = $month;
        $data['plugins'] = array('highcharts','highcharts_user_l');
        
        if($this->active_privilege == 'superadmin' || $this->active_privilege == 'signer'){
            $kategori = $this->fdb->getUserkategori();
            $i=0;
            foreach ($kategori as $k) {
                $data['user_nama'][$i] = $k->nama;
                $data['user_perform'][$i] = $this->fdb->getUserperformLine($month,$year,$k->user_id);
                $i++;
            }
            $data['total_data'] = $i;
        }else{
            
                $data['user_nama'][0] = $this->active_user;
                $data['user_perform'][0] = $this->fdb->getUserperformLine($month,$year,$this->active_user_id);
                $data['total_data'] = '1';
        }
      
        
       
        $this->load->view('template', $data);
    }

   public function report_userm(){
        
        if($this->input->post()){
            $month = $this->input->post('month');

            if ($month == "empty") {
                $month = date('m');
            }

            $type = $this->input->post('tipe');
            if ($type == "empty") {
                $type = 'l';
            }
        }
        $year = date('Y');

        
        $data['title'] = 'Report User Activity';
        $data['active'] = 'report_user';
        
        $data['content'] = 'report_user';
        $data['month'] = $month;

        if($type=='v'){
            
            $data['plugins'] = array('highcharts', 'highcharts_user_v');
            $data['user_perform'] = $this->fdb->getUserperform($month,$year);
        
            
        }elseif($type=='b'){
            
           $data['plugins'] = array('highcharts', 'highcharts_user_b');

           $data['user_perform'] = $this->fdb->getUserperform($month,$year);
        ;
        }else{
            $data['plugins'] = array('highcharts','highcharts_user_l');
            if($this->active_privilege == 'superadmin' || $this->active_privilege == 'signer'){
            $kategori = $this->fdb->getUserkategori();
            $i=0;
            foreach ($kategori as $k) {
                $data['user_nama'][$i] = $k->nama;
                $data['user_perform'][$i] = $this->fdb->getUserperformLine($month,$year,$k->user_id);
                $i++;
            }
            $data['total_data'] = $i;
            }else{
                
                    $data['user_nama'][0] = $this->active_user;
                    $data['user_perform'][0] = $this->fdb->getUserperformLine($month,$year,$this->active_user_id);
                    $data['total_data'] = '1';
            }
            
        }
        
       
        $this->load->view('template', $data);
    }
}
