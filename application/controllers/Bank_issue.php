<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bank_issue extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
       
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_issue', 'fdb');
        $this->load->model('m_kategori_issue', 'k_fdb');
        $this->cname = 'bank_issue';
        $this->menu  = 'Problem / Request Solution';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index()
    {
        $this->lists();
    }

    public function action($func = '', $id = 0)
    {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc) ){
                if (!empty($id)) {
                    $this->$func($id);
                } else if (empty($id)) {
                    $this->$func();
                }

            } else {
                flash_err("Akses ditolak.");
                redirect(base_url($this->cname));
            }
        } else {
            flash_err("Akses ditolak.");
            redirect(base_url($this->cname));
        }
    }

    public function lists()
    {
        $data['title']   = 'Problem / Request Solution';
        $data['active']  = 'bank_issue';
        $this->fitur     = 'Daftar';
        $data['content'] = 'bank_issue_list';
        $data['plugins'] = array('daterangepicker','datatables','kategori_suggest','ticket_source');
        $data['issue']  = $this->fdb->get_bank_issue();
        $data['kategori'] = $this->k_fdb->get_all();
        $this->load->view('template', $data);
    }

    public function search(){
         if ($this->input->post()) {
            if($this->input->post('tanggal') ==""){
                $tanggal ="";
            }else{
                 $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
            }
           
            $shift = $this->input->post('shift');
            $kategori = $this->input->post('kategori');
            
            $data['issue'] = $this->fdb->search($tanggal,$shift,$kategori);


           if ($data['issue']) {  

                writelog('success', "Data ditemukan");
                //flash_succ("Data Ditemukan");
            } else {
                if ($data['issue'] > 0) {
                    writelog('success', "Data ditemukan");
                  //  flash_succ("Data ditemukan");
                } else {
                    writelog('warning', "Data Tidak Ada");
                    //flash_warn("Data Tidak Ada");
                    redirect(base_url($this->cname));
                }
                redirect(base_url($this->cname));
            }
                $data['title']         = 'Problem / Request Solution';
                $data['active']        = 'bank_issue';
                $this->fitur          = 'Cari';
                $data['content']       = 'bank_issue_list';
                $data['kategori'] = $this->k_fdb->get_all();
                $data['plugins']       = array('datatables','daterangepicker','kategori_suggest');
                $this->load->view('template', $data);
            }

        
    }

    protected function view($issue_id = '', $answer_id = '')
    {
        $data['title']         = 'Problem / Request Solution';
        $data['active']        = 'bank_issue';
        $this->fitur           = 'Lihat';
        $data['content'] = 'bank_issue_form';
        $data['plugins'] = array('datatables');
        $issue_id =  $this->uri->segment(4);
        $answer_id =  $this->uri->segment(5);
        $data['issue_detail'] = $this->fdb->get_bank_issue_row($issue_id,$answer_id);
        $this->load->view('template', $data);
    }

   

  

   






}
