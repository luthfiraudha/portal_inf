<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_hak_akses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_master_hak_akses', 'fdb');
        $this->cname = 'master_hak_akses';
        $this->menu = 'Master Hak Akses';
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
        $data['title'] = 'Master Hak Akses';
        $data['active'] = 'master hak akses';
        $this->fitur = 'Daftar';
        $data['content'] = 'master_hak_akses_list';
        $data['plugins'] = array('datatables');
        $data['hak_akses'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {
        
        if ($this->input->post()) {
            $post = $this->input->post();    
            $this->form_validation->set_rules('akses_nama', 'Akses Nama', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Hak Akses Baru Gagal. " . validation_errors());
                flash_err('Tambah Hak Akses Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            $data['akses_id'] = $this->fdb->add($post);
            if ($data['akses_id']) {
                writelog('success', "Tambah Hak Akses Baru dengan id {$data['akses_id']} Sukses.");
                flash_succ("Tambah Hak Akses Baru `{$post['akses_nama']}` Sukses.");
            } else {
                writelog('error', "Tambah Hak Akses Gagal. Dari databasenya. ");
                flash_err('Tambah Hak Akses Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Master Hak Akses';
        $data['active'] = 'master hak akses';
        $this->fitur = 'Tambah';
        $data['content'] = 'master_hak_akses_form';
        $data['menu'] = $this->fdb->get_all();
        $data['plugins'] = array();

        $this->load->view('template', $data);
    }

    protected function edit($akses_id= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
            $akses_id = $post['akses_id'];

            $this->form_validation->set_rules('akses_nama', 'Akses Nama', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Ubah Hak Akses id {$akses_id} Gagal. " . validation_errors());
                flash_err("Ubah Hak Akses `{$post['akses_nama']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $akses_id));
            }

            $availability = $this->fdb->cek_unique_update($post['akses_nama'], $akses_id);
            if ($availability) {
                writelog('error', "Ubah Hak Akses id {$akses_id} Gagal. Nama telah diambil.");
                flash_err("Ubah Hak Akses Gagal. Hak Akses `{$post['akses_nama']}` telah diambil. Silakan gunakan nama lain.");
                redirect(base_url($this->cname . '/action/edit/' .$akses_id));
            }

            unset($post['akses_id']);
            
            $result = $this->fdb->update($akses_id, $post);

            if ($result === FALSE) {
                writelog('error', "Ubah Hak Akses id {$akses_id} Gagal.");
                flash_err("Ubah Hak Akses '{$post['akses_nama']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Hak Akses id {$akses_id} Sukses.");
                    flash_succ("Ubah Hak Akses '{$post['akses_nama']}' Sukses.");
                } else {
                    writelog('warning', "Ubah Hak Akses id {$akses_id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah Hak Akses Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Master Hak Akses';
        $data['active'] = 'master hak akses';
        $this->fitur = 'Ubah';
        $data['akses_detail'] = $this->fdb->get_row($akses_id);
        $data['hak_akses'] = $this->fdb->get_all();
        $data['content'] = 'master_hak_akses_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($akses_id= '') {
        $data['title'] = 'Master Hak Akses';
        $data['active'] = 'master hak akses';
        $this->fitur = 'Lihat';
        $data['akses_detail'] = $this->fdb->get_row($akses_id);
       
        $data['content'] = 'master_hak_akses_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($akses_id= 0) {
        $akses = $this->fdb->get_row($akses_id);
        $result = $this->fdb->delete($akses_id);
        if ($result) {
            writelog('success', "Hapus Hak Akses id ({$akses->akses_id}) {$akses->akses_nama} Sukses.");
            flash_succ("Hapus Hak Akses  '{$akses->akses_nama}' Sukses.");
        } else {
            writelog('error', "Hapus Hak Akses id ({$akses->akses_id}) {$akses->akses_nama} Gagal.");
            flash_err("Hapus Hak Akses '{$akses->akses_nama}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

}
