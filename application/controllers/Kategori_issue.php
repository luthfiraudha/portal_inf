<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_issue extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_kategori_issue', 'fdb');
        $this->load->model('m_data_issue', 'd_fdb');
        $this->cname = 'kategori_issue';
        $this->menu = 'Category Ticket';
        $this->fitur = '';


        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index() {
        $this->lists();
    }

    public function action($func = '', $id = 0) {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
                if (!empty($id))
                    $this->$func($id);
                else if (empty($id))
                    $this->$func();
            }
            else {
                flash_err("Akses ditolak.");
                redirect(base_url($this->cname));
            }
        } else {
            flash_err("Akses ditolak.");
            redirect(base_url($this->cname));
        }
    }

    public function lists() {
        $data['title'] = 'Category Ticket';
        $data['active'] = 'Category Ticket';
        $this->fitur = 'Daftar';
        $data['content'] = 'kategori_issue_list';
        $data['plugins'] = array('datatables');
        $data['kategori'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {
        
        if ($this->input->post()) {
            $post = $this->input->post();    
            $this->form_validation->set_rules('kategori_nama', 'Nama Kategori', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Kategori Baru Gagal. " . validation_errors());
                flash_err('Tambah Kategori Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
           

            $cek_kategori = $this->fdb->cek_kategori($post['kategori_nama']);

            if(!$cek_kategori){
            $kategori_nama = strtolower($post['kategori_nama']);

            $data['kategori_id'] = $this->fdb->add($kategori_nama);
                if ($data['kategori_id']) {
                    writelog('success', "Tambah Kategori dengan id {$data['kategori_id']} Sukses.");
                    flash_succ("Tambah Hak Akses Baru `{$post['kategori nama']}` Sukses.");
                } else {
                    writelog('error', "Tambah Kategori  Gagal. Dari databasenya. ");
                    flash_err('Tambah Kategori  Gagal. Mohon periksa kembali formulir wajib.');
                }
            

            }else{
                writelog('error', "Tambah Kategori  Gagal. Nama sudah ada. ");
                flash_err('Tambah Kategori  Gagal. Nama kategori sudah dipakai.');
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Category Ticket';
        $data['active'] = 'Category Ticket';
        $this->fitur = 'Tambah';
        $data['content'] = 'kategori_issue_form';
        $data['kategori'] = $this->fdb->get_all();
        $data['plugins'] = array();

        $this->load->view('template', $data);
    }

    protected function edit($kategori_id= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
            $kategori_id = $post['kategori_id'];

            $this->form_validation->set_rules('kategori_nama', 'Nama Kategori', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            
            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Ubah kategori id {$kategori_id} Gagal. " . validation_errors());
                flash_err("Ubah kategori `{$post['kategori_nama']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $kategori_id));
            }

            $cek_kategori = $this->fdb->cek_kategori($post['kategori_nama']);

            if(!$cek_kategori){
                unset($post['kategori_id']);
                $post['kategori_nama'] = strtolower($post['kategori_nama']);
                $data = array('kategori_nama' => $post['kategori_nama']);
                $result = $this->fdb->update($kategori_id, $data);

                if ($result === FALSE) {
                    writelog('error', "Ubah Kategori id {$kategori_id} Gagal.");
                    flash_err("Ubah Kategori '{$post['kategori_nama']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah Kategori id {$kategori_id} Sukses.");
                        flash_succ("Ubah Kategori '{$post['kategori_nama']}' Sukses.");
                    } else {
                        writelog('warning', "Ubah Kategori id {$kategori_id} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah Kategori Gagal. Tidak ada data yang berubah.");
                    }
                }
                

            }else{
                writelog('error', "Tambah Kategori  Gagal. Nama sudah ada. ");
                flash_err('Tambah Kategori  Gagal. Nama kategori sudah dipakai.');
            }

            
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Category Ticket';
        $data['active'] = 'Category Ticket';
        $this->fitur = 'Ubah';
        $data['kategori_detail'] = $this->fdb->get_row($kategori_id);
        $data['kategori'] = $this->fdb->get_all();
        $data['content'] = 'kategori_issue_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($kategori_id= '') {
        $data['title'] = 'Category Ticket';
        $data['active'] = 'Category Ticket';
        $this->fitur = 'Lihat';
        $data['kategori_detail'] = $this->fdb->get_row($kategori_id);
       
        $data['content'] = 'kategori_issue_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($kategori_id= 0) {
        $issue = $this->d_fdb->get_kategori_issue($kategori_id);
        $kategori = $this->fdb->get_row($kategori_id);
        if($issue != NULL){
            foreach ($issue as $issue) {
                 $this->d_fdb->delete($issue->issue_id);
                 $this->d_fdb->delete_answer($issue->answer_id);
            }
        }
        $result = $this->fdb->delete($kategori_id);
        if ($result) {
            writelog('success', "Hapus Kategori id ({$kategori->kategori_id}) {$kategori->kategori_nama} Sukses.");
            flash_succ("Hapus Kategori  '{$kategori->kategori_nama}' Sukses.");
        } else {
            writelog('error', "Hapus Kategori id ({$kategori->kategori_id}) {$kategori->kategori_nama} Gagal.");
            flash_err("Hapus Kategori '{$kategori->kategori_nama}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

}
