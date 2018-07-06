<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_user', 'fdb');
        $this->load->model('m_master_hak_akses', 'akses_fdb');
        $this->cname = 'pengajuan_user';
        $this->menu = 'Pengajuan User';
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
        $data['title'] = 'Pengajuan User';
        $data['active'] = 'pengajuan user';
        $this->fitur = 'Daftar';
        $data['content'] = 'pengajuan_user_list';
        $data['plugins'] = array('datatables');
        $data['user'] = $this->fdb->get_not_active();
        $this->load->view('template', $data);
    }

 

    protected function delete($user_id= 0) {
        $user = $this->fdb->get_row($user_id);
        $result = $this->fdb->delete($user_id);
        if ($result) {
            writelog('success', "Hapus User id ({$user->user_id}) {$user->user_pn} Sukses.");
            flash_succ("Hapus User  '{$user->user_pn}' Sukses.");
        } else {
            writelog('error', "Hapus User id ({$user->user_id}) {$user->user_pn} Gagal.");
            flash_err("Hapus User '{$user->user_pn}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

     protected function edit($user_id= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
           

            $result = $this->fdb->update($user_id, $post);

            if ($result === FALSE) {
                writelog('error', "Confrim User id {$user_id} Gagal.");
                flash_err("Confrim User '{$user_id}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Confrim User id {$user_id} Sukses.");
                    flash_succ("Confrim User '{$user_id}' Sukses.");
                } else {
                    writelog('warning', "Confrim User id {$user_id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Confrim User Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Data User';
        $data['active'] = 'data user';
        $this->fitur = 'Pengajuan User';
        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['jabatan'] = $this->fdb->getjabatan();
        $data['content'] = 'data_user_form';
        $data['plugins'] = array();

        $this->load->view('template', $data);
    }


    // protected function accept($user_id= 0) {
    //     $user = $this->fdb->get_row($user_id);
    //     $result = $this->fdb->accept($user_id);
    //     if ($result) {
    //         writelog('success', "Aktifasi User id ({$user->user_id}) {$user->user_pn} Sukses.");
    //         flash_succ("Aktifasi User  '{$user->user_pn}' Sukses.");
    //     } else {
    //         writelog('error', "Aktifasi User id ({$user->user_id}) {$user->user_pn} Gagal.");
    //         flash_err("Aktifasi User '{$user->user_pn}' Gagal.");
    //     }
    //     redirect(base_url($this->cname));
    // }

}
