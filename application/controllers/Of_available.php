<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Of_available extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape_of_available', 'fdb');
        //$this->load->model('m_tape_record', 'k_fdb');
        $this->cname = 'of_available';
        $this->menu = 'Available Tape OF';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index() {
        $this->lists();
    }

    public function action($func = '', $id = 0, $size = "") {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
                if (!empty($id) && !empty($size)) {
                    $this->$func($id, $size);
                } else if (!empty($id)) {
                    $this->$func($id);
                }
                else if( empty($id)){
                    $this->func();
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
        $data['title'] = 'Data Tape OF';
        $data['active'] = 'of_available';
        $this->fitur = 'Daftar';
        $data['content'] = 'data_tape_list_of_available';
        $data['plugins'] = array('daterangepicker','manajemen_tape','hostname_suggest', 'datatables');
        //$data['issue'] = $this->fdb->get_daily();

        $this->load->view('template', $data);
    }

    public function request($id='')
    {
        $data['data_tape_of'] = $this->fdb->view_id($id);
        if ($this->input->post()) {
            date_default_timezone_set('Asia/Jakarta');
            $tape_request['vol_id'] = $this->input->post('vol_id');
            $tape_request['lastupdated'] = date('Y-m-d H:i:s', time());
            $tape_request['no_surat'] = $this->input->post('no_surat');
            $tape_request['tujuan'] = $this->input->post('tujuan');
            $tape_request['perihal'] = $this->input->post('perihal');
            $tape_request['status'] = "Keluar";
            $tape_request['user_pn'] = get_session('user_nama');


            $tape_record['rak_before'] = $data['data_tape_of']->rak_after;
            $tape_record['koordinat_before'] = $data['data_tape_of']->koordinat_after;
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
        $data['title'] = 'Request OF';
        $data['active'] = 'data_tape_of';
        $this->fitur = 'Request';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_of_available';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','library_suggest');

        $this->load->view('template', $data);
    }

    public function configuration($id = 0){
        $data['data_tape_of'] = $this->fdb->view_id($id);
        if($this->input->post()){
            $data_tape_of['vol_id'] = $this->input->post('vol_id');
            $data_tape_of['tanggal_tape'] = $this->input->post('tanggal_tape');
            $data_tape_of['lokasi'] = $this->input->post('lokasi');
            $data_tape_of['size_total'] = $this->input->post('size_total');

            $tape_record_of['rak_before'] = $data['data_tape_of']->rak_after;
            $tape_record_of['koordinat_before'] = $data['data_tape_of']->koordinat_after;
            $tape_record_of['rak_after'] = $this->input->post('rak_after');
            $tape_record_of['koordinat_after'] = $this->input->post('koordinat_after');
            $data_record_of['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record_of['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->configuration($id, $data_tape_of, $tape_record_of);
            if ($result) {
                writelog('success', "Konfigurasi Tape ({$this->input->post($this->input->post('vol_id'))}) Sukses.");
                flash_succ("Konfigurasi Tape ({$this->input->post($this->input->post('vol_id'))}) Sukses.");
            } else {
                writelog('error', "Konfigurasi Tape {$this->input->post('vol_id')} Gagal. Dari databasenya. ");
                flash_err("Konfigurasi Tape ({$this->input->post('vol_id')}) Gagal. Mohon periksa kembali formulir wajib.");
            }
            redirect(base_url($this->cname));
        }
        $data['title'] = "Konfigurasi Tape OF";
        $data['active'] = "Of_available";
        $this->fitur = "Konfigurasi";
        $data['content'] = "data_tape_form_of_available";
        $data['plugins'] = array('daterangepicker');
        $this->load->view('template', $data);
    }



    public function add_host($id = 0, $size=0) {

        $data['data_tape_of']= $this->fdb->view_id($id);
        $data_tape= $this->fdb->view_id($id);
        if ($this->input->post()) {
            $content_tape_of['tape'] = $id;
            $content_tape_of['tanggal'] = date("Y-m-d", strtotime($this->input->post('tanggal'))); 
            $content_tape_of['hostname'] = $this->input->post('hostname');
            $content_tape_of['ip'] = $this->input->post('ip');
            $content_tape_of['jenis'] = $this->input->post('jenis');
            $size = $this->input->post('size')*1024;
            $content_tape_of['size'] = $size;
            
            if($size > ($data_tape->size_total - $data_tape->size_usage)){

                writelog('error', "Tambah Host di Tape OF dengan ({$data_tape->vol_id}) Gagal. Size Tape tidak mencukupi.");
                flash_err("Tape  '{$data_tape->vol_id}' Gagal. Size Tape tidak mencukupi.");
            }
            else{
                $data_tape_of['size_usage'] = $data_tape->size_usage + $size;
                $data_record['user_pn'] = get_session('user_nama');
                date_default_timezone_set('Asia/Jakarta');
                $data_record['lastupdated'] = date('Y-m-d H:i:s', time());
                $result = $this->fdb->add_host($id, $data_tape_of, $content_tape_of, $data_record);
                if ($result) {
                        writelog('success', "Tambah Host Baru ({$this->input->post('$data_tape->vol_id')}) Sukses.");
                        flash_succ("Tambah  Host Baru ({$this->input->post('$data_tape->vol_id')}) Sukses.");
                    } else {
                        writelog('error', "Tambah Host Baru Gagal. Dari databasenya. ");
                        flash_err('Tambah Host Gagal. Mohon periksa kembali formulir wajib.');
                    }
            }
            redirect(base_url($this->cname));
        }

        

        $data['title'] = 'Tambah New Host';
        $data['active'] = 'Of_available';
        $this->fitur = 'Tambah Host';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_of_available';
        $data['size'] = $size;
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }


    protected function edit($id = '') {
        $data['data_tape_of']= $this->fdb->view_id($id);
        $data_tape= $this->fdb->view_id($id);
        if($this->input->post('vol_id_baru'))
        {
            $available = $this->fdb->cek($this->input->post('vol_id_baru'));
            $data['available'] = $available;
        }
        if ($this->input->post()) {
            $data_tape_of['vol_id'] = $this->input->post('vol_id');
            $data_tape_of['lokasi'] = $this->input->post('lokasi');
            $data_tape_of['tanggal'] = date("Y-m-d", strtotime($this->input->post('tanggal'))); 
            $data_tape_of['hostname'] = $this->input->post('hostname');;
            $data_tape_of['ip'] = $this->input->post('ip');
            $data_tape_of['status']= $this->input->post('status');
            $data_tape_of['jenis']= $this->input->post('jenis');

            $data_record['rak_after'] = $this->input->post('rak_after');
            $data_record['koordinat_after'] = strtoupper($this->input->post('koordinat_after'));
            $data_record['rak_before'] = $data_tape->rak_after;
            $data_record['koordinat_before'] = strtoupper($data_tape->koordinat_after);
            $data_record['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->update($id, $data_tape_of, $data_record);
            if ($result) {
                writelog('success', "Edit Tape dengan ({$data_tape->vol_id}) Sukses.");
                flash_succ("Edit Tape  '{$data_tape->vol_id}' Sukses.");
            } else {
                writelog('success', "Edit Tape ({$data_tape->vol_id}) Gagal.");
                flash_succ("Edit Tape  '{$data_tape->vol_id}' Gagal.");
            }
            
            redirect(base_url($this->cname));
        }

        

        $data['title'] = 'Edit Tape OF';
        $data['active'] = 'Of_available';
        $this->fitur = 'Ubah';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_of_available';
        
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

 
     protected function view($id = '') {
        //$id = decode($id);
        $data['title']         = 'Tape OF Available';
        $data['active']        = 'Of_available';
        $this->fitur           = 'Lihat';
        $data['data_tape_of'] = $this->fdb->view_id($id);
        $data['content_tape_of'] = $this->fdb->view_content_id($id);

        $data['content'] = 'data_tape_form_of_available';
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
                $data['plugins']       = array('datatables','daterangepicker','kategori_suggest');
                $this->load->view('template', $data);
        }
    }

}