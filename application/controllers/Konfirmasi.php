<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_konfirmasi', 'fdb');
        $this->load->model('m_data_aplikasi', 'fdba');
        $this->load->model('m_data_fitur', 'fdbb');
        $this->load->model('m_data_dok', 'fdbc');
        $this->cname = 'konfirmasi';
        $this->menu = 'Konfirmasi';
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
        $data['title'] = 'Konfirmasi';
        $data['active'] = 'konfirmasi';
        $this->fitur = 'Daftar';
        $data['content'] = 'konfirmasi_list';
        $data['plugins'] = array('datatables2');
       // $data['issue'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

   

    protected function cek($id_doc = '') {
        if ($this->input->post()) {
         $post      = $this->input->post();
            $id_doc = $post['id_doc'];
            $id_fitur = $post['id_fitur'];
            $nama_fitur = $post['nama_fitur'];
            $nama_app = $post['nama_app'];

            $id_app = $this->fdb->get_id_app($id_fitur);
            $id_app = $id_app->id_app;

            $status_app = $this->fdb->get_status_app($id_app);
            $status_app = $status_app->status;

            $status_fitur = $this->fdb->get_status_fitur($id_fitur);
            $status_fitur = $status_fitur->status;

            //print_r($status_app);exit;


            //$post['tgl_deploy'] = date("Y-m-d", strtotime($post['tgl_deploy']));
            
            $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('des_app', 'Deskripsi Aplikasi', 'required');
            $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('des_fitur', 'Deskripsi Fitur', 'required');
            $this->form_validation->set_rules('tipe_fitur', 'Tipe Fitur', 'required');
            $this->form_validation->set_rules('platform', 'Platform', 'required');
            $this->form_validation->set_rules('pengembang', 'Bagian Pengembang', 'required');
            $this->form_validation->set_rules('programmer', 'Programmer', 'required');
            $this->form_validation->set_rules('status', 'Konfirmasi Pengajuan', 'required');


            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Konfirmasi Pengajuan id {$id_doc} Gagal. " . validation_errors());
                flash_err("Konfirmasi Pengajuan Dokumen Fitur '{$nama_fitur}' Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/cek/' . $id_doc));
            }
            /*unset($post["nama_app"]);
            unset($post["tipe_fitur"]);
            unset($post["des_app"]);
            unset($post["platform"]);
            unset($post["pengembang"]);
            unset($post["programmer"]);
            unset($post["nama_fitur"]);*/
 

            $status = $post["status"];

            if ($status == 'dikonfirmasi') {
                $this->fdb->updatea($id_app, $status);

                $this->fdb->updateb($id_fitur,  $status);

                $result = $this->fdb->updatec($id_doc,$status);
            }

            elseif ($status == 'ditolak') {
                if ($status_app == 'belum dikonfirmasi') {
                    $this->fdb->reject_app($id_app);
                    $this->fdb->reject_fitur($id_fitur);
                    $result = $this->fdb->reject_doc($id_doc);
                }
                elseif($status_app == 'dikonfirmasi'){
                    if ($status_fitur == 'belum dikonfirmasi') {
                        $this->fdb->reject_fitur($id_fitur);
                        $result = $this->fdb->reject_doc($id_doc);
                    }
                    elseif ($status_fitur == 'dikonfirmasi') {
                        $result = $this->fdb->reject_doc($id_doc);
                    }
                    
                }
                
            }
            

            if ($result === false) {
                writelog('error', "Konfirmasi Pengajuan id {$id_doc} Gagal.");
                flash_err("Konfirmasi Pengajuan Aplikasi '{$nama_app}' Fitur '{$post['nama_fitur']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    if($status == "ditolak"){
                        writelog('success', "Konfirmasi Pengajuan id {$id_doc} Sukses ditolak.");
                        flash_succ("Konfirmasi Pengajuan Aplikasi '{$nama_app}' fitur '{$nama_fitur}' Sukses ditolak.");   
                    }
                    else{
                        writelog('success', "Konfirmasi Pengajuan id {$id_doc} Sukses dikonfirmasi.");
                        flash_succ("Konfirmasi Pengajuan Aplikasi '{$nama_app}' fitur '{$nama_fitur}' Sukses dikonfirmasi.");
                    }
                    redirect(base_url().'konfirmasi/');
                } else {
                    writelog('warning', "Konfirmasi Pengajuan id {$id_doc} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Konfirmasi Pengajuan Aplikasi '{$nama_app}' Fitur '{$post['nama_fitur']}'. Tidak ada data yang berubah.");
                    redirect(base_url().'konfirmasi/');  
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Konfirmasi';
        $data['active'] = 'konfirmasi';
        $this->fitur = 'Cek';
        $this->aktif = 'Konfirmasi';
        $data['konf_detail'] = $this->fdb->get_row($id_doc);
        $data['konfirmasi'] = $this->fdb->get_all();
        $data['content'] = 'konfirmasi_form';
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function view($id_doc = '',$from = NULL) {
        $data['title']         = 'Konfirmasi';
        $data['active']        = 'Konfirmasi';
        $this->fitur           = 'Lihat';
        $this->aktif           = 'Pengajuan';
        $data['konf_detail'] = $this->fdb->get_row($id_doc);

        $data['content'] = 'konfirmasi_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        $answer = $this->fdb->get_answer($id);
        $issue = $this->fdb->get_row($id);
        if($answer != NULL){
            foreach ($answer as $answer) {
                 $this->fdb->delete_answer($answer->id);
            }
        }
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$issue->id}) Sukses.");
            flash_succ("Hapus Ticket  '{$issue->issue_id}' Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$issue->id}) Gagal.");
            flash_err("Hapus  Ticket  '{$issue->id}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

}
