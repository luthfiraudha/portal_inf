<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Recycle_tape extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
       
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape', 'fdb');
        $this->cname = 'recycle_tape_list';
        $this->menu  = 'Recycle Tape';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index()
    {
        $this->lists();
    }

    public function action($func = '', $id = 0)
    {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc) ){
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
        $data['title']   = 'Recycle Tape';
        $data['active']  = 'recycle_tape';
        $this->fitur     = 'List';
        $data['content'] = 'recycle_tape_list';
        $data['plugins'] = array('kategori_suggest');
        $data['data_tape'] = $this->fdb->get_all();
        // $data['issue']  = $this->fdb->get_bank_issue();
        // $data['kategori'] = $this->k_fdb->get_all();
        $this->load->view('template', $data);
    }

    protected function view($id = '')
    {
        $data['title']         = 'Request Tape';
        $data['active']        = 'data_tape';
        $this->fitur           = 'Lihat';
        $data['content'] = 'data_tape_form';
        $data['plugins'] = array('datatables');
        $data['tape_detail'] = $this->fdb->view($id );
        $this->load->view('template', $data);
    }


}
