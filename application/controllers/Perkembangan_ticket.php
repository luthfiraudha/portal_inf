<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perkembangan_ticket extends CI_Controller {

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



    /////////////////////////// REPORT TICKET  ///////////////////////////////////////////
    public function index(){
        $month = date('m');
        $year = date('Y');

        $data['title'] = 'Perkembangan Ticket';
        $data['active'] = 'perkembangan_ticket';
        
        $data['content'] = 'perkembangan_ticket';
        $data['month'] = $month;
        $data['plugins'] = array('daterangepicker','highcharts', 'highcharts_ticket_l','kategori_suggest');
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

        
        $data['title'] = 'Perkembangan Ticket';
        $data['active'] = 'perkembangan_ticket';
        
        $data['content'] = 'perkembangan_ticket';
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


}
