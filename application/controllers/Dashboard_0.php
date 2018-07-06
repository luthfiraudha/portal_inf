<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_dashboard', 'fdb');
        $this->load->model('m_auth', 'fdb_auth');
        $this->cname = 'dashboard';
        $this->menu = 'Dashboard';
        $this->fitur = '';

        if (!cek_auth()) {
            flash_err('Authorization needed.');
            redirect(base_url('auth'));
        }

        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index() {


        $jumlah_data = $this->fdb->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url($this->cname)."/index/";
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 6;
        $from = $this->uri->segment(3);
       
                  // CSS Bootstrap               
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';            
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
                // Akhir CSS

        $this->pagination->initialize($config);     
        $data['shift'] = $this->fdb->data($config['per_page'],$from);

        $data['title'] = 'Dashboard';
        $data['active'] = 'dashboard';
        $data['plugins'] = ['summernote','highcharts'];
        $data['content'] = 'dashboard';
        $data['report_problem_success'] = $this->fdb->countTicketSuccess();
        $data['report_problem_notsuccess'] = $this->fdb->countTicketNotsuccess();
    
      
      //  $data['shift'] = $this->fdb->get_all();
  
        $this->load->view('template', $data);
    }

    public function add_note2() {
       
        
        if ($this->input->post()) {
            $post = $this->input->post();    
             $this->form_validation->set_rules('text', 'Message', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Note Gagal. " . validation_errors());
                flash_err('Tambah Note Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname));
            }

            $post['user_nama'] = $this->active_user;
            $data['text_id'] = $this->fdb->add_note($post);
            if ($data['text_id']) {
                writelog('success', "Tambah Note Sukses.");
                flash_succ("Tambah Note Sukses.");
            } else {
                writelog('error', "Tambah Note Gagal. Dari databasenya. ");
                flash_err('Tambah Note Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname));
        }
      
        $this->fitur = 'Tambah';
        $data['content'] = 'dashboard';
        $data['plugins'] = ['summernote'];
        $this->load->view('template', $data);
    }

    public function add_note() {
       
        
        if ($this->input->post()) {
            $post = $this->input->post();    
            $this->form_validation->set_rules('shift', 'Shift', 'required');
            $this->form_validation->set_rules('text', 'Message', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Note Gagal. " . validation_errors());
                flash_err('Tambah Note Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
           
            $post['user_nama'] = $this->active_user;
            $data['text_id'] = $this->fdb->add_note($post);
            if ($data['text_id']) {
                writelog('success', "Tambah Note Sukses.");
                flash_succ("Tambah Note Sukses.");
            } else {
                writelog('error', "Tambah Note Gagal. Dari databasenya. ");
                flash_err('Tambah Note Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname));
        }
      
        $this->fitur = 'Tambah';
        $data['content'] = 'dashboard';
        $data['plugins'] = ['summernote'];
        $this->load->view('template', $data);
    }

     public function delete_note($text_id = 0)
    {
       
        $result = $this->fdb->delete_note($text_id);
       
        redirect(base_url($this->cname));
    }

    public function edit_note(){
         $post['text_id'] = $this->input->post('text_id');
         $post['text'] = $this->input->post('text');
         $text_id = $post['text_id'];

         
            unset($post['text_id']);
          
            $result = $this->fdb->update($text_id, $post);

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


    public function change_password() {
        if ($this->input->post()) {
            $post = $this->input->post();
            $id_user = $post['user_id'];
            $result = $this->fdb_auth->cek_user(get_session('user_pn'), encode($post['oldpassword']));
            //var_dump($result);exit;
            if ($result) {
                $this->form_validation->set_rules('user_pswd', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'required|matches[user_pswd]');
                $this->form_validation->set_error_delimiters('<li>', '</li>');

                if ($this->form_validation->run() === FALSE) {
                    writelog('error', "Change password failed. " . validation_errors());
                    flash_err('Change Password Failed. <ul>' . validation_errors() . '</ul>');
                    redirect(base_url($this->cname) . '/change_password');
                }
                $post['user_pswd'] = encode($post['user_pswd']);
                unset($post['repassword']);
                unset($post['user_id']);
                unset($post['oldpassword']);
                $result = $this->fdb_auth->update_password($id_user, $post);
                if ($result === FALSE) {
                    writelog('error', "change password id {$id_user} failed.");
                    flash_err(" Change Password Failed. Check your required form.");
                } else {
                    if ($result > 0) {
                        writelog('success', " change password id {$id_user} success.");
                        flash_succ(" Change Password success.");
                    } else {
                      writelog('warning', "change password {$id_user} not updated. No changed data found.");
                        flash_warn(" No changed data found. The data is not updated.");
                    }
                }
                redirect(base_url($this->cname) . '/change_password');
            } else {
                writelog('error', "change password id {$id_user} failed. oldpassword wrong");
                flash_err(" Change Password Failed. Old Password is wrong.");
            }
        }
        $data['title'] = 'Change Password';
        $data['active'] = '';
        $this->fitur = 'Change';
        $data['content'] = 'change_password_form';
        $data['plugins'] = ['popconfirm'];
        $this->load->view('template', $data);
    }


    function get_weekly_report(){
        $query = $this->fdb->countTicketSuccess();

        echo json_encode($query);
    }

    

}
