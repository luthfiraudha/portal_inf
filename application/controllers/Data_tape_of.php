<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_tape_OF extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape_of', 'fdb');
        //$this->load->model('m_tape_record', 'k_fdb');
        $this->cname = 'data_tape_OF';
        $this->menu = 'Data Tape OF';
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
        $data['title'] = 'Host Tape OF';
        $data['active'] = 'data_tape_OF';
        $this->fitur = 'Daftar';
        $data['content'] = 'data_tape_list_of';
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

            $result = $this->fdb->request($data['data_tape_of']->tape, $tape_request, $tape_record);
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
        $data['content'] = 'data_tape_form_of';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','library_suggest');

        $this->load->view('template', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $data['vol_id'] = strtoupper($this->input->post('vol_id'));
            $data['lokasi'] = $this->input->post('lokasi');
            $data['tanggal_tape'] = date("Y-m-d", strtotime($this->input->post('tanggal'))); 
            $size = $this->input->post('size');
            $tipe = $this->input->post('tipe');
            if($tipe == "GB")
            {
                $data['size_total'] = $size*1024;
            }
            else
            {
                $data['size_total'] = $size;
            }
            $data['size_usage'] = 0;
            $data['status'] = "New Tape";
            $data_record['rak_after'] = $this->input->post('rak');
            $data_record['koordinat_after'] = strtoupper($this->input->post('koordinat'));
            $data_record['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $result = $this->fdb->add($data, $data_record);
            if ($result) {
                    writelog('success', "Tambah Tape Baru ({$data['vol_id']}) Sukses.");
                    flash_succ("Tambah  Tape Baru ({$this->input->post('vol_id')}) Sukses.");
                } else {
                    writelog('error', "Tambah Tape Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Tape Gagal. Mohon periksa kembali formulir wajib.');
                }
            
            redirect(base_url('of_available'));
        }

        

        $data['title'] = 'New Tape OF';
        $data['active'] = 'data_tape_of';
        $this->fitur = 'Tambah';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_of';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function edit($id = '') {
        $data['content_tape_of']= $this->fdb->view_id($id);
        $size_awal = $data['content_tape_of']->size;
        $size_usage = $data['content_tape_of']->size_usage;
        $size_total = $data['content_tape_of']->size_total;
        $vol_id = $data['content_tape_of']->vol_id;

        $id_tape = $data['content_tape_of']->tape;
        if ($this->input->post()) {
            $content_tape_of['tanggal'] = date("Y-m-d", strtotime($this->input->post('tanggal'))); 
            $content_tape_of['hostname'] = $this->input->post('hostname');;
            $content_tape_of['ip'] = $this->input->post('ip');
            $size = $this->input->post('size');
            $ukuran = $this->input->post('ukuran');
            if($ukuran == "GB")
            {
                $size = $size * 1024;
            }
            $content_tape_of['size']= $size;
            $content_tape_of['jenis']= $this->input->post('status');
            $size_usage = $size_usage + ($size - $size_awal);;
            $data_tape_of['size_usage'] = $size_usage;

            $data_record['user_pn'] = get_session('user_nama');
            date_default_timezone_set('Asia/Jakarta');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());
            if($size_total < $size_usage)
            {
                writelog('error', "Edit Host Tape OF dengan ({$vol_id}) Gagal. Size Tape tidak mencukupi.");
                flash_err("Edit Tape  '{$vol_id}' Gagal. Size Tape tidak mencukupi.");
            }
            else
            {
                $result = $this->fdb->update($id, $id_tape, $content_tape_of, $data_record, $data_tape_of);
                if ($result) {
                    writelog('success', "Edit Content Tape OF dengan ({$vol_id}) Sukses.");
                    flash_succ("Edit Tape  '{$vol_id}' Sukses.");
                } else {
                    writelog('error', "Edit Tape ({$vol_id}){$result} Gagal.");
                    flash_err("Edit Tape  '{$vol_id}' {$result}Gagal.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Edit Content Tape OF';
        $data['active'] = 'data_tape_of';
        $this->fitur = 'Ubah';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form_of';
        
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

 
     protected function view($id = '') {
        //$id = decode($id);
        $data['title']         = 'Data Tape OF';
        $data['active']        = 'data_tape_of';
        $this->fitur           = 'Lihat';
        $data['content_tape_of'] = $this->fdb->view_id($id);

        $data['content'] = 'data_tape_form_of';
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

    public function getall_hostname(){
        $kode=$this->input->post('kode',TRUE);
        $query=$this->fdb->suges_hostname($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_app;
        echo json_encode($json_array);    
    }

    public function getall_ip(){
        $hostname=$this->input->post('hostname',TRUE);
        $ip=$this->input->post('ip',TRUE);
        $query=$this->fdb->suges_ip($hostname, $ip);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->ip_fitur;
        echo json_encode($json_array);    
    }

}