<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_monitor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_monitor', 'fdb');
        $this->cname = 'data_monitor';
        $this->menu  = 'Data Monitor';
        $this->fitur = '';
        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index()
    {
        $this->lists();
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
        $data['title']   = 'Management Monitor';
        $data['active']  = 'data_monitor';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_monitor_list';
        $data['plugins'] = array('datatables');
        $data['monitor']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add()
    {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('monitor_nama', 'Nama Monitor', 'required');
            $this->form_validation->set_rules('monitor_link', 'Alamat IP Monitor', 'required');
           

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Monitor Baru Gagal. " . validation_errors());
                flash_err('Tambah Monitor Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

           $data['monitor_id'] = $this->fdb->add($post);
            if ($data['monitor_id']) {
                writelog('success', "Tambah Monitor Baru dengan id {$data['monitor_id']} Sukses.");
                flash_succ("Tambah Monitor Baru `{$post['monitor_nama']}` Sukses.");
            } else {
                writelog('error', "Tambah Monitor Baru Gagal. Dari databasenya. ");
                flash_err('Tambah Monitor Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname));
        }
      

        $data['title']   = 'Data monitor';
        $data['active']  = 'data monitor';
        $this->fitur     = 'Tambah';
        $data['content'] = 'data_monitor_form';
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    protected function edit($monitor_id = '')
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('monitor_nama', 'Nama Monitor', 'required');
            $this->form_validation->set_rules('monitor_link', 'Alamat IP Monitor', 'required');  
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Monitor Gagal. " . validation_errors());
                flash_err('Ubah Monitor Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
           
            $result = $this->fdb->update($monitor_id, $post);

            if ($result === FALSE) {
                writelog('error', "Ubah id {$monitor_id} Gagal.");
                flash_err("Ubah Monitor '{$post['monitor_nama']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Monitor id {$monitor_id} Sukses.");
                    flash_succ("Ubah Monitor '{$post['monitor_nama']}' Sukses.");
                } else {
                    writelog('warning', "Ubah Monitor id {$monitor_id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah Monitor Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title']   = 'Data monitor';
        $data['active']  = 'data monitor';
        $this->fitur     = 'Ubah';
        $data['content'] = 'data_monitor_form';
        $data['monitor_detail'] = $this->fdb->get_row($monitor_id);
        $data['plugins'] = array('daterangepicker','popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($monitor_id = '')
    {
        $data['title']         = 'Data monitor';
        $data['active']        = 'data monitor';
        $this->fitur           = 'Lihat';
        $data['monitor_detail'] = $this->fdb->get_row($monitor_id);

        $data['content'] = 'data_monitor_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($monitor_id = 0)
    {
        $monitor = $this->fdb->get_row($monitor_id);
        $result = $this->fdb->delete($monitor_id);
        if ($monitor) {
            writelog('success', "Hapus monitor id ({$monitor->monitor_id}) Sukses.");
            flash_succ("Hapus monitor  '{$monitor->ap_name}' Sukses.");
        } else {
            writelog('error', "Hapus monitor id ({$monitor->monitor_id}) Gagal.");
            flash_err("Hapus  monitor  '{$monitor->ap_name}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    
    

    

}
