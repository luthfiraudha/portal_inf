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
         
       
        $data['title'] = 'Dashboard';
        $data['active'] = 'dashboard';
        $data['plugins'] = array();
        $data['content'] = 'home/dashboard';
        $count_kpi = $this->fdb->count_kpi();
        $count_anggaran = $this->fdb->count_totalanggaran();

        foreach ($count_anggaran as $key) {
            $data['count_anggaran'] = $key->total_sisa;
        }
        foreach ($count_kpi as $key) {
            $data['count_kpi'] = $key->nilaikpi;
        }
        
        $this->load->view('template', $data);
    }


     public function filter() {

         // get search string
        $search = ($this->input->post("type"))? $this->input->post("type") : "";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        if($search==''){
            redirect($this->cname);
        }
        
        $jumlah_data = $this->fdb->jumlah_data_record($search);
        $this->load->library('pagination');
        $config['base_url'] = base_url($this->cname).'/filter/'.$search;
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 4;
       // $from = $this->uri->segment(3);
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);
       
                  // CSS Bootstrap 

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                // Akhir CSS

        $this->pagination->initialize($config); 
        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get books list

        $data['record'] = $this->fdb->data_record($config['per_page'], $data['page'], $search);
        $data['daily'] = $this->fdb->data_daily();
        $data['averageTime'] = $this->fdb->countrespontime();
        $data['totalvendor'] = $this->fdb->counttotalvendor();
       
        $data['totaluser'] = $this->fdb->countlogin();
        $data['totalsop'] = $this->fdb->counttotalsop();
        $data['totalprob'] = $this->fdb->counttotalprob();
        $data['totaldai'] = $this->fdb->counttotaldai();
        $data['title'] = 'Dashboard';
        $data['active'] = 'dashboard';
        $data['plugins'] = array();
        $data['content'] = 'dashboard';
    
      
    
        $this->load->view('template', $data);
    }



    public function unpin($id=0){
        $post['pinned'] = 0;

        $result = $this->fdb->update($id, $post);
                if ($result === false) {
                        writelog('error', "unpin gagal");
                        flash_err("Unpin gagal");
                    } else {
                        if ($result > 0) {
                            writelog('success', "unpin sukses");
                            flash_succ("Unpin sukses");
                        } else {
                            writelog('warning', "unpin gagal");
                            flash_warn("unpin gagal");
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
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repassword', 'Confirm Password', 'required|matches[password]');
                $this->form_validation->set_error_delimiters('<li>', '</li>');

                if ($this->form_validation->run() === FALSE) {
                    writelog('error', "Change password failed. " . validation_errors());
                    flash_err('Change Password Failed. <ul>' . validation_errors() . '</ul>');
                    redirect(base_url($this->cname) . '/change_password');
                }
                $post['password'] = encode($post['password']);
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
        $data['plugins'] = array('popconfirm');
        $this->load->view('template', $data);
    }


    function get_weekly_report(){
        $query = $this->fdb->countTicketSuccess();

        echo json_encode($query);
    }


    function cari(){
         if ($this->input->post()) {
            
            $cari = $this->input->post('cari');
            
            
            $data['cari'] = $this->fdb->search_global($cari);
       




           if ($data['cari']) {  

                writelog('success', "Data ditemukan");
                flash_succ("Data Ditemukan");
                
            } else {
                if ($data['issue'] > 0) {
                    writelog('success', "Data ditemukan");
                    flash_succ("Data ditemukan");
                } else {
                    writelog('warning', "Data Tidak Ada");
                    flash_warn("Data Tidak Ada");
                  redirect(base_url($this->cname));
                }
              
            }
                $data['title']         = 'Search';
                $data['active']        = 'dashboard';
                $this->fitur          = 'Cari';
                $data['content']       = 'dashboard_list';
                $data['plugins']       = array('datatables');
                $this->load->view('template', $data);
            }
    }

    

}
