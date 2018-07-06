<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_register', 'fdb');
        $this->cname = 'register';
        $this->menu = 'Register';
        $this->fitur = '';
        $this->active_user = '';
    }

    public function index() {
        $this->do_register();
    }

    public function do_register() {
        if (cek_auth()) {//helper - kalo session ada isi maka masuk dashboard
            redirect(base_url('dashboard'));
        } else {

            if ($this->input->post()) {
                $this->form_validation->set_rules('pn', 'Personal Number', 'required');
                $this->form_validation->set_rules('nama', 'Nama', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('nohp', 'Nomor Handphone', 'required');
                 $this->form_validation->set_rules('user_type', 'Jabatan', 'required');
                //$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $sekarang = unix_to_human(now(), TRUE, 'id');
                if ($this->form_validation->run() == FALSE) {

                    $data['alert']['class'] = 'danger';
                    $data['alert']['message'] = validation_errors();
                    $sekarang = unix_to_human(now(), TRUE, 'id');
                    $log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' alert = ' . $data['alert']['message'];
                    write_file('./log/logattfail.log', $log, 'a');
                } else {

                    $data = array(
                        'user_pn' => $this->input->post('pn'),
                        'user_email' => $this->input->post('email'),
                        'user_nama' => $this->input->post('nama'),
                        'user_nohp' => $this->input->post('nohp'),
                        'user_type' => $this->input->post('user_type'),
                       // 'password' => encode($this->input->post('password')),
                        'user_akses' => 'maker',
                        'user_aktif' => '1'
                        
                    );
                    $ceksemua = $this->fdb->get_all();
                    foreach ($ceksemua as $key) {
                        $availability = $this->fdb->cek_unique_update($data['user_pn'], $key->user_id);
                    }
                    
                    if ($availability) {
                       
                        flash_err("Ubah User Gagal. User `{$data['user_pn']}` telah diambil.");
                        redirect(base_url('register'));
                    }else{

                        $result = $this->fdb->register($data);
                        if ($result) {
                            $data['alert']['class'] = 'success';
                            $data['alert']['message'] = 'register succes, you can login after user activated';
                           
                            $log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' alert = ' . $data['alert']['message'];
                        write_file('./log/logattfail.log', $log, 'a');
                        }
                    }

                }
            }

            //--------------END LOGIN AUTH LOGIC ----------------
            $data['jabatan'] = $this->fdb->getjabatan();
            $data['title'] = 'Register'; //prim1_title
            $data['active'] = ''; //prim3_sidebarmenu
            $data['content'] = ''; //prim5_contentview


            $this->load->view('page/register', $data);
        }
    }

}
