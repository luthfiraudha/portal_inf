<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Request_tape extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape_of', 'fdb_of');
        $this->load->model('m_data_tape', 'fdb_pf');
        $this->load->model('m_request_tape', 'fdb_rt');
        //$this->load->model('m_tape_record', 'k_fdb');
        $this->cname = 'Request_tape';
        $this->menu = 'Request Tape';
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
        $data['title'] = 'Request Tape';
        $data['active'] = 'Request_tape';
        $this->fitur = 'Daftar';
        $data['content'] = 'request_tape_list';
        $data['plugins'] = array('daterangepicker','manajemen_tape','library_suggest', 'datatables');
        //$data['issue'] = $this->fdb->get_daily();

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
        $data['plugins'] = array('daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function masuk($id = '') {
        $data['data_tape'] = $this->fdb_rt->view_id($id);

        if($this->input->post())
        {
            date_default_timezone_set('Asia/Jakarta');
            $tape_request['vol_id'] = $this->input->post('vol_id');
            $tape_request['lastupdated'] = date('Y-m-d H:i:s', time());
            $tape_request['no_surat'] = $this->input->post('no_surat');
            $tape_request['tujuan'] = $this->input->post('tujuan');
            $tape_request['perihal'] = $this->input->post('perihal');
            $tape_request['status'] = "Masuk";
            $tape_request['user_pn'] = get_session('user_nama');


            $tape_record['rak_before'] = "Request";
            $tape_record['koordinat_before'] = "Request";
            $tape_record['rak_after'] = $this->input->post('rak_after');
            $tape_record['koordinat_after'] = strtoupper($this->input->post('koordinat_after'));
            $data_record['user_pn'] = get_session('user_nama');
            $data_record['lastupdated'] = date('Y-m-d H:i:s', time());

            $tape = substr($this->input->post('vol_id'),0,2);
            if($tape == "PF"){
                $temp = $this->fdb_rt->getID_PF($data['data_tape']->vol_id);
                $result = $this->fdb_rt->update_pf($id, $tape_request, $tape_record, $temp->id_tape);
            } else if($tape == "OF"){
                $temp = $this->fdb_rt->getID_OF($data['data_tape']->vol_id);
                $result = $this->fdb_rt->update_of($id, $tape_request, $tape_record, $temp->id_tape);
            }
            if ($result) {
                    writelog('success', "Disposisi Masuk Tape  ({$this->input->post('vol_id')}) Sukses.");
                    flash_succ("Disposisi Masuk Tape ({$this->input->post('vol_id')}) Sukses.");
                } else {
                    writelog('error', "Disposisi Masuk Tape Gagal. Dari databasenya. ");
                    flash_err("Disposisi Masuk Tape Gagal. Mohon periksa kembali ({$tape}) formulir wajib.");
                }
            
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Disposisi Masuk Tape';
        $data['active'] = 'request_tape';
        $this->fitur = 'Masuk';
        $this->fitur2 = '';
        $data['content'] = 'request_tape_form';
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

}