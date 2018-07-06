<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }
        //Load model dari class model
        $this->load->model('m_data_user', 'fdb');
        $this->load->model('m_master_hak_akses', 'akses_fdb');

        //penamaan controller name agar mudal pemanggilan
        $this->cname = 'data_user';

        //penamaan menu
        $this->menu = 'Data User';
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
        $data['title'] = 'Data User';
        $data['active'] = 'data user';
        $this->fitur = 'Daftar';
        $data['content'] = 'data_user_list';
        $data['plugins'] = array('datatables');
        $data['user'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {
        
        if ($this->input->post()) {
            $post = $this->input->post(); 
            // if($post['user_jabatan2']!=""){
            //     $post['user_jabatan'] = $post['user_jabatan2'];

            //     unset($post['user_jabatan2']); 
            // }else{
            //     unset($post['user_jabatan2']); 
            // }
          
            $this->form_validation->set_rules('user_pn', 'Personal Number', 'required');
            $this->form_validation->set_rules('user_nama', 'Nama', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('user_email', 'Email', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah User Baru Gagal. " . validation_errors());
                flash_err('Tambah User Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

             if ($post['user_jabatan'] == 'otherjabatan') {
                unset($post['user_jabatan']);
                $post['nama'] = $this->input->post('user_jabatan2');
                $jabatan = $this->fdb->addjabatan($post['nama']);


                if ($jabatan) {
                    $post['user_jabatan'] = $jabatan;
                    unset($post['nama']);
                    unset($post['user_jabatan2']);
                    $post['password'] = encode($post['password']);
                    $data['user_id'] = $this->fdb->add($post);
                    if ($data['user_id']) {
                        writelog('success', "Tambah User Baru dengan id {$data['user_id']} Sukses.");
                        flash_succ("Tambah User Baru `{$post['user_pn']}` Sukses.");
                    } else {
                        writelog('error', "Tambah User Gagal. Dari databasenya. ");
                        flash_err('Tambah User Gagal. Mohon periksa kembali formulir wajib.');
                    }
                    redirect(base_url($this->cname));
                } else {

                    writelog('error', "Tambah User Gagal. Dari databasenya. ");
                    flash_err('Tambah User Gagal. Mohon periksa kembali formulir wajib.');
                }
            } else if ($post['user_jabatan'] != NULL) {
                $post['nama'] = $this->input->post('user_jabatan2');
                unset($post['user_jabatan2']);
                unset($post['nama']);
                $post['password'] = encode($post['password']);

                $data['user_id'] = $this->fdb->add($post);
                if ($data['user_id']) {
                    writelog('success', "Tambah User Baru dengan id {$data['user_id']} Sukses.");
                    flash_succ("Tambah User Baru `{$post['user_pn']}` Sukses.");
                } else {
                    writelog('error', "Tambah User Gagal. Dari databasenya. ");
                    flash_err('Tambah User Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname));
            }
            
        }

        $data['title'] = 'Data User';
        $data['active'] = 'data User';
        $this->fitur = 'Tambah';
        $data['content'] = 'data_user_form';
        $data['jabatan'] = $this->fdb->getjabatan();

        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['user'] = $this->fdb->get_all();
        $data['plugins'] = array();

        $this->load->view('template', $data);
    }

    protected function edit($user_id= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
           
            // $user_id = $post['user_id'];
            // if($post['user_jabatan2']!=""){
            //     $post['user_jabatan'] = $post['user_jabatan2'];

            //     unset($post['user_jabatan2']); 
            // }else{
            //     unset($post['user_jabatan2']); 
            // }
           

            $this->form_validation->set_rules('user_pn', 'Personal Number', 'required');
            $this->form_validation->set_rules('user_nama', 'Nama', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('user_email', 'Email', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Ubah User id {$user_id} Gagal. " . validation_errors());
                flash_err("Ubah user `{$post['user_pn']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $user_id));
            }

            $availability = $this->fdb->cek_unique_update($post['user_pn'], $user_id);
            if ($availability) {
                writelog('error', "Ubah User id {$user_id} Gagal. Nama telah diambil.");
                flash_err("Ubah User Gagal. User `{$post['user_pn']}` telah diambil.");
                redirect(base_url($this->cname . '/action/edit/' .$user_id));
            }


             if ($post['user_type'] == 'otherjabatan') {
                unset($post['user_jabatan']);
                $post['nama'] = $this->input->post('user_jabatan2');
                $jabatan = $this->fdb->addjabatan($post['nama']);


                if ($jabatan) {
                    $post['user_jabatan'] = $jabatan;
                    unset($post['nama']);
                    unset($post['user_jabatan2']);
                    unset($post['user_id']);
                    $post['password'] = encode($post['password']);
                    $result = $this->fdb->update($user_id, $post);


                    if ($result === FALSE) {
                        writelog('error', "Ubah User id {$user_id} Gagal.");
                        flash_err("Ubah User '{$post['user_pn']}' Gagal. Periksa kembali formulir wajib.");
                    } else {
                        if ($result > 0) {
                            writelog('success', "Ubah User id {$user_id} Sukses.");
                            flash_succ("Ubah User '{$post['user_pn']}' Sukses.");
                        } else {
                            writelog('warning', "Ubah User id {$user_id} Gagal. Tidak ada data yang berubah.");
                            flash_warn("Ubah User Gagal. Tidak ada data yang berubah.");
                        }
                    }
                    redirect(base_url($this->cname));

                } else {

                    writelog('error', "Ubah User id {$user_id} Gagal.");
                    flash_err("Ubah User '{$post['user_pn']}' Gagal. Periksa kembali formulir wajib.");
                }

            } else if ($post['user_type'] != NULL) {
                $post['nama'] = $this->input->post('user_jabatan2');
                unset($post['user_jabatan2']);
                unset($post['nama']);
                unset($post['user_id']);
                $post['password'] = encode($post['password']);
                $result = $this->fdb->update($user_id, $post);


                if ($result === FALSE) {
                    writelog('error', "Ubah User id {$user_id} Gagal.");
                    flash_err("Ubah User '{$post['user_pn']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah User id {$user_id} Sukses.");
                        flash_succ("Ubah User '{$post['user_pn']}' Sukses.");
                    } else {
                        writelog('warning', "Ubah User id {$user_id} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah User Gagal. Tidak ada data yang berubah.");
                    }
                }
                redirect(base_url($this->cname));
            }

            
        }

        $data['title'] = 'Data User';
        $data['active'] = 'data user';
        $this->fitur = 'Ubah';
        $data['user_detail'] = $this->fdb->get_row($user_id);
        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['user'] = $this->fdb->get_all();
        $data['jabatan'] = $this->fdb->getjabatan();
        $data['content'] = 'data_user_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($user_id= '') {
        $data['title'] = 'Data User';
        $data['active'] = 'data user';
        $this->fitur = 'Lihat';
        $data['user_detail'] = $this->fdb->get_row($user_id);
       
        $data['content'] = 'data_user_form';
        $data['plugins'] = array('popconfirm');

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

}
