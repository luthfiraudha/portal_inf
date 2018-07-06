<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Portal_monitor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_monitor', 'fdb');
        $this->cname = 'portal_monitor';
        $this->menu  = 'Portal Monitor';
        $this->fitur = '';
        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index()
    {
     
        $jumlah_data = $this->fdb->jumlah_data();
        $this->load->library('pagination');
        $config['base_url'] = base_url($this->cname)."/index/";
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 5;
        $from = $this->uri->segment(3);

                  // CSS Bootstrap               
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
                // Akhir CSS

        $this->pagination->initialize($config);     
        $data['monitor'] = $this->fdb->data($config['per_page'],$from);

        $data['title']   = 'Portal Monitor';
        $data['active']  = 'portal_monitor';
        $this->fitur     = 'Daftar';
        $data['content'] = 'portal_monitor_list';
        $data['plugins'] = array();
        //$data['monitor']  = $this->fdb->get_all();
        $this->load->view('template', $data);

        //$this->lists();
    }

    public function action($func = '', $id = 0)
    {
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

    public function lists()
    {
        $data['title']   = 'Portal Monitor';
        $data['active']  = 'portal_monitor';
        $this->fitur     = 'Daftar';
        $data['content'] = 'portal_monitor_list';
        $data['plugins'] = array();
        $data['monitor']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

     public function cari()
    {
         // get search string
        $search = ($this->input->post("cari"))? $this->input->post("cari") : "";

        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;

        
        $jumlah_data = $this->fdb->jumlah_data_cari($search);
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

        $data['monitor'] = $this->fdb->data_cari($config['per_page'], $data['page'], $search);

        if ($data['monitor']) {  

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

            $data['title']   = 'Portal Monitor';
            $data['active']  = 'portal_monitor';
            $this->fitur     = 'cari';
            $data['content'] = 'portal_monitor_list';
            $data['plugins'] = array();
            //$data['monitor']  = $this->fdb->get_all();
            $this->load->view('template', $data);

       
       
    }

   
}
