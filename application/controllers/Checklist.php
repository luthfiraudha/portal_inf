<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }
        //Load model dari class model
        $this->load->model('m_checklist', 'fdb');
        $this->load->model('m_manage_ck','fdb2');

        // //coba connect db2
        // $this->load->model('m_tes','fdb3');
        
        //penamaan controller name agar mudal pemanggilan
        $this->cname = 'Checklist';

        //penamaan menu
        $this->menu = 'Checklist';
        $this->fitur = '';


        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }


///// tes fungsi db 2 //////////
  
  

//////////////////////////////

    public function index() {
        $data['title'] = 'Checklist';
        $data['active'] = 'checklist';
        $this->fitur = 'Create';
        $data['content'] = 'checklist_create';
        $data['plugins'] = array('daterangepicker','datechecklist','datatables','dt_checklist');

        $this->load->view('template', $data);
    }



    // CREATE NEW CHECKLIST
    public function create(){
            if ($this->input->post()) {
            $post = $this->input->post(); 
          
            $this->form_validation->set_rules('ck_nama', 'Nama data center', 'required');
            $this->form_validation->set_rules('jenis_field', 'Type', 'required');
            $this->form_validation->set_rules('ck_tgl', 'Tanggal', 'required');
          
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Checklist Baru Gagal. " . validation_errors());
                flash_err('Tambah Checklist Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/create');
            }

            
            $post['ck_status'] = 'Not Completed';
            $post['ck_tgl'] = date("Y-m-d", strtotime($post['ck_tgl']));
            $data['ck_id'] = $this->fdb->main_add($post);
            if ($data['ck_id']) {
                $tempdat = $this->fdb->field_get($post['jenis_field']);
                foreach ($tempdat as $key) {
                    $a['ck_id'] = $data['ck_id'];
                    $a['id_field'] = $key->id_field;
                    $this->fdb->data_add($a);
                }

              

                writelog('success', "Tambah Checklist Baru Sukses.");
                flash_succ("Tambah Checklist Baru  Sukses.");

                $data['title'] = 'Checklist';
                $data['active'] = 'checklist';
                $this->fitur = 'Tambah';
                $data['content'] = 'checklist_form';
                $data['plugins'] = array('datatables');
               
                $data['main'] = $this->fdb->get_main($data['ck_id']);
                $data['kategori'] = $this->fdb->kategori_get();

                $data['data_f'] = $this->fdb->data_get($data['ck_id']);
                
                foreach ($data['kategori'] as $key) {
                        $data[substr($key->nama_kategori,-3)] = $this->fdb->data_get($data['ck_id'],$key->nama_kategori);
                        
                }
                
                $data['empty'] =  $this->fdb->countdata($data['ck_id'],'');
                $data['ok'] =  $this->fdb->countdata($data['ck_id'],'ok');
                $data['notok'] =  $this->fdb->countdata($data['ck_id'],'not ok');

                $this->load->view('template', $data);
            } else {
                writelog('error', "Tambah Checklist Gagal. Dari databasenya. ");
                flash_err('Tambah Checklist Gagal. Mohon periksa kembali formulir wajib.');
                redirect(base_url($this->cname));
            }
           
            
            
        }

        
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

 // get list input form ck     
    protected function inputform($ck_id=0){
        $data['title'] = 'Checklist';
        $data['active'] = 'checklist';
        $this->fitur = 'Tambah';
        $data['content'] = 'checklist_form';       
        $data['plugins'] = array('datatables');

        $data['main'] = $this->fdb->get_main($ck_id);
        $data['kategori'] = $this->fdb->kategori_get();

        $data['data_f'] = $this->fdb->data_get($ck_id);
        foreach ($data['kategori'] as $key) {
                $data[$key->id_kategori] = $this->fdb->data_get($ck_id,$key->nama_kategori);
        }

        $data['empty'] =  $this->fdb->countdata($ck_id,'');
        $data['ok'] =  $this->fdb->countdata($ck_id,'ok');
        $data['notok'] =  $this->fdb->countdata($ck_id,'not ok');

        $this->load->view('template', $data);
    }

// modal pop up input
    public function add_data_modal() {
      
        $this->load->view('content/content_modal_checklist');
    }



//---------------------------------------------------------------------------------------

   
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

             if ($post['user_type'] == 'otherjabatan') {
                unset($post['user_type']);
                $post['nama'] = $this->input->post('user_type2');
                $jabatan = $this->fdb->addjabatan($post['nama']);


                if ($jabatan) {
                    $post['user_type'] = $jabatan;
                    unset($post['nama']);
                    unset($post['user_type2']);
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
            } else if ($post['user_type'] != NULL) {
                $post['nama'] = $this->input->post('user_type2');
                unset($post['user_type2']);
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
            // if($post['user_type2']!=""){
            //     $post['user_type'] = $post['user_type2'];

            //     unset($post['user_type2']); 
            // }else{
            //     unset($post['user_type2']); 
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
                unset($post['user_type']);
                $post['nama'] = $this->input->post('user_type2');
                $jabatan = $this->fdb->addjabatan($post['nama']);


                if ($jabatan) {
                    $post['user_type'] = $jabatan;
                    unset($post['nama']);
                    unset($post['user_type2']);
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
                $post['nama'] = $this->input->post('user_type2');
                unset($post['user_type2']);
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