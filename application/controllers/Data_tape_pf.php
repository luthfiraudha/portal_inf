<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_tape_PF extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape', 'fdb');
        //$this->load->model('m_tape_record', 'k_fdb');
        $this->cname = 'data_tape_pf';
        $this->menu = 'Data Tape PF';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index() {
        $this->lists();
    }

    public function action($func = '', $id = 0) {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
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

    public function lists() {
        $data['title'] = 'Data Tape PF';
        $data['active'] = 'data_tape_pf';
        $this->fitur = 'Daftar';
        $data['content'] = 'data_tape_list_pf';
        $data['plugins'] = array('daterangepicker','datatables','library_suggest', 'manajemen_tape');

        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $data['vol_id'] = strtoupper($this->input->post('vol_id'));
            $data['lokasi'] = $this->input->post('lokasi');
            $data['start_date'] = date("Y-m-d", strtotime($this->input->post('start_date'))); 
            $data['end_date'] = "9999-12-31";
            $data['set_tape'] = "New Tape";
            $data['state'] = "New Tape";
            $data['status']= "New Tape";
            $data['jenis'] = "New Tape";

            $data_record['rak_after'] = $this->input->post('rak_after');
            $data_record['koordinat_after'] = strtoupper($this->input->post('koordinat_after'));
            $data_record['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->add($data, $data_record);
            if ($result) {
                    writelog('success', "Tambah Tape Baru ({$this->input->post('vol_id')}) Sukses.");
                    flash_succ("Tambah  Tape Baru ({$this->input->post('vol_id')}) Sukses.");
                } else {
                    writelog('error', "Tambah Tape Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Tape Gagal. Mohon periksa kembali formulir wajib.');
                }
            
            redirect(base_url($this->cname));
        }

        $data['title'] = 'New Tape PF';
        $data['active'] = 'data_tape_pf';
        $this->fitur = 'Tambah';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_pf';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','library_suggest');

        $this->load->view('template', $data);
    }


    protected function request($id = 0)
    {
        $data['data_tape_pf'] = $this->fdb->view_id($id);
        if ($this->input->post()) {
            date_default_timezone_set('Asia/Jakarta');
            $tape_request['vol_id'] = $this->input->post('vol_id');
            $tape_request['lastupdated'] = date('Y-m-d H:i:s', time());
            $tape_request['no_surat'] = $this->input->post('no_surat');
            $tape_request['tujuan'] = $this->input->post('tujuan');
            $tape_request['perihal'] = $this->input->post('perihal');
            $tape_request['status'] = "Keluar";
            $tape_request['user_pn'] = get_session('user_nama');


            $tape_record['rak_before'] = $data['data_tape_pf']->rak_after;
            $tape_record['koordinat_before'] = $data['data_tape_pf']->koordinat_after;
            $tape_record['rak_after'] = "Request";
            $tape_record['koordinat_after'] = "Request";
            $data_record['user_pn'] = get_session('user_nama');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->request($id, $tape_request, $tape_record);
            if ($result) {
                    writelog('success', "Request Tape  ({$this->input->post('vol_id')}) Sukses.");
                    flash_succ("Request Tape ({$this->input->post('vol_id')}) Sukses.");
                } else {
                    writelog('error', "Request Tape Gagal. Dari databasenya. ");
                    flash_err('Request Tape Gagal. Mohon periksa kembali formulir wajib.');
                }
            
            redirect(base_url($this->cname));

        }
        $data['title'] = 'Request PF';
        $data['active'] = 'data_tape_pf';
        $this->fitur = 'Request';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_pf';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','library_suggest');

        $this->load->view('template', $data);
    }

    protected function edit($id = '') {
        $data['data_tape']= $this->fdb->view_id($id);
        $data_tape= $this->fdb->view_id($id);
        if ($this->input->post()) {
            $data_tape_['vol_id'] = $this->input->post('vol_id');
            $data_tape_['lokasi'] = $this->input->post('lokasi');
            $data_tape_['start_date'] = date("Y-m-d", strtotime($this->input->post('start_date'))); 
            $data_tape_['end_date'] = date("Y-m-d", strtotime($this->input->post('end_date')));
            if($data_tape_['end_date'] == "1970-01-01")
            {
                $data_tape_['end_date'] == "9999-12-31";
            }
            $data_tape_['set_tape'] = $this->input->post('set_tape');;
            $data_tape_['state'] = $this->input->post('state');;
            $data_tape_['status']= $this->input->post('status');
            $data_tape_['jenis']= $this->input->post('jenis');
            $data_tape_['isi']= $this->input->post('isi');

            $data_record['rak_after'] = $this->input->post('rak_after');
            $data_record['koordinat_after'] = strtoupper($this->input->post('koordinat_after'));
            $data_record['rak_before'] = $data_tape->rak_after;
            $data_record['koordinat_before'] = strtoupper($data_tape->koordinat_after);

            $data_record['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->update($id, $data_tape_, $data_record);
            if ($result) {
                writelog('success', "Edit Tape dengan ({$data_tape->vol_id}) Sukses.");
                flash_succ("Edit Tape  '{$data_tape->vol_id}' Sukses.");
            } else {
                writelog('success', "Edit Tape ({$data_tape->vol_id}) Gagal.");
                flash_succ("Edit Tape  '{$data_tape->vol_id}' Gagal.");
            }
            
            redirect(base_url($this->cname));
        }

        

        $data['title'] = 'Edit Tape PF';
        $data['active'] = 'data_tape_pf';
        $this->fitur = 'Ubah';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_pf';
        
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

 
     protected function view($id = '') {
        //$id = decode($id);
        $data['title']         = 'Data Tape PF ';
        $data['active']        = 'data_tape_pf';
        $this->fitur           = 'Lihat';
        $data['data_tape'] = $this->fdb->view_id($id);

        $data['content'] = 'data_tape_form_pf';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }


    protected function delete($id_tape = 0)
    {
        $tape = $this->fdb->get_row($id_tape);
        $result = $this->fdb->delete($id_tape);
        if ($result) {
            writelog('success', "Hapus Tape ({$tape->vol_id}) Sukses.");
            flash_succ("Hapus Tape  '{$tape->vol_id}' Sukses.");
        } else {
            writelog('error', "Hapus Tape ({$tape->vol_id}) Gagal.");
            flash_succ("Hapus Tape  '{$tape->vol_id}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    protected function recycle($id_tape = 0)
    {
        $data['start_date'] = date("Y-m-d", time()); 
        $data['end_date'] = "9999-12-31";
        $data['set_tape'] = "Kosong";
        $data['state'] = "Kosong";
        $data['status']= "000";
        $data['jenis']= "Kosong";
        $data_record['user_pn'] = get_session('user_nama');
        date_default_timezone_set('Asia/Jakarta');
        $data_record['lastupdated'] = date('Y-m-d H:i:s', time());
        $tape = $this->fdb->get_row($id_tape);
        $result = $this->fdb->update($id_tape, $data, $data_record);
        if ($result) {
            writelog('success', "recycle Tape ({$tape->vol_id}) Sukses.");
            flash_succ("Recycle Tape  '{$tape->vol_id}' Sukses.");
        } else {
            writelog('error', "Recycle Tape ({$tape->vol_id}) Gagal.");
            flash_succ("Recycle Tape  '{$tape->vol_id}' Gagal.");
        }
        // /redirect(base_url($this->cname));
        $this->load->view('template', $data);
    }

   

public function search()
{
         if ($this->input->post()) 
         {
            if($this->input->post('start_date') =="")
            {
                $tanggal ="";
            }else
            {
                 $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
            }
           
            $set_tape = $this->input->post('set_tape');
            $state = $this->input->post('state');
            
            $data['tape'] = $this->fdb->search($start_date,$set_tape,$state);


           if ($data['tape']) 
           {  

                writelog('success', "Data ditemukan");
                //flash_succ("Data Ditemukan");
            } else 
            {
                if ($data['tape'] > 0) 
                {
                    writelog('success', "Data ditemukan");
                  //  flash_succ("Data ditemukan");
                } else 
                {
                    writelog('warning', "Data Tidak Ada");
                    //flash_warn("Data Tidak Ada");
                    redirect(base_url($this->cname));
                }
                redirect(base_url($this->cname));
            }
                $data['title']         = 'Problem / Request Solution';
                $data['active']        = 'data_tape';
                $this->fitur          = 'Cari';
                $data['content']       = 'data_tape_list';
                //$data['kategori']   = $this->k_fdb->get_all();
                $data['plugins']       = array('datatables','daterangepicker','library_suggest');
                $this->load->view('template', $data);
        }
    }
    public function getall_library(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->suges_library($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->library;
        echo json_encode($json_array);    
    }

}