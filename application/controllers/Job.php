<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_job', 'fdb');
        $this->load->model('m_data_daily', 'd_fdb');
        $this->cname = 'Job';
        $this->menu = 'Job
        ';
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
        $data['title'] = 'Job';
        $data['active'] = 'Job';
        $this->fitur = 'Daftar';
        $data['content'] = 'job_list';
        $data['plugins'] = array('datatables');
        $data['job'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {
        
        if ($this->input->post()) {
            $post = $this->input->post();    
            $this->form_validation->set_rules('job_nama', 'Nama Job', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Job Baru Gagal. " . validation_errors());
                flash_err('Tambah Job Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
           

            $cek_Job = $this->fdb->cek_job($post['job_nama']);

            if(!$cek_Job){
            $Job_nama = strtolower($post['job_nama']);

                $data['job_id'] = $this->fdb->add($Job_nama);
                if ($data['job_id']) {
                    writelog('success', "Tambah Job dengan id {$data['Job_id']} Sukses.");
                    flash_succ("Tambah Job Baru `{$post['Job nama']}` Sukses.");
                } else {
                    writelog('error', "Tambah Job  Gagal. Dari databasenya. ");
                    flash_err('Tambah Job  Gagal. Mohon periksa kembali formulir wajib.');
                }
            

            }else{
                writelog('error', "Tambah Job  Gagal. Nama sudah ada. ");
                flash_err('Tambah Job  Gagal. Nama Job sudah dipakai.');
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Job';
        $data['active'] = 'Job';
        $this->fitur = 'Tambah';
        $data['content'] = 'job_form';
        $data['Job'] = $this->fdb->get_all();
        $data['plugins'] = array();

        $this->load->view('template', $data);
    }

    protected function edit($Job_id= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
            $Job_id = $post['Job_id'];

            $this->form_validation->set_rules('Job_nama', 'Nama Job', 'required');
            
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            
            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Ubah Job id {$Job_id} Gagal. " . validation_errors());
                flash_err("Ubah Job `{$post['Job_nama']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $Job_id));
            }

            $cek_Job = $this->fdb->cek_Job($post['Job_nama']);

            if(!$cek_Job){
                unset($post['Job_id']);
                $post['Job_nama'] = strtolower($post['Job_nama']);
                $data = array('Job_nama' => $post['Job_nama']);
                $result = $this->fdb->update($Job_id, $data);

                if ($result === FALSE) {
                    writelog('error', "Ubah Job id {$Job_id} Gagal.");
                    flash_err("Ubah Job '{$post['Job_nama']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah Job id {$Job_id} Sukses.");
                        flash_succ("Ubah Job '{$post['Job_nama']}' Sukses.");
                    } else {
                        writelog('warning', "Ubah Job id {$Job_id} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah Job Gagal. Tidak ada data yang berubah.");
                    }
                }
                

            }else{
                writelog('error', "Tambah Job  Gagal. Nama sudah ada. ");
                flash_err('Tambah Job  Gagal. Nama Job sudah dipakai.');
            }

            
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Job';
        $data['active'] = 'Job';
        $this->fitur = 'Ubah';
        $data['job_detail'] = $this->fdb->get_row($Job_id);
        $data['job'] = $this->fdb->get_all();
        $data['content'] = 'job_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($Job_id= '') {
        $data['title'] = 'Job';
        $data['active'] = 'Job';
        $this->fitur = 'Lihat';
        $data['Job_detail'] = $this->fdb->get_row($Job_id);
       
        $data['content'] = 'Job_issue_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($Job_id= 0) {
       
        $Job = $this->fdb->get_row($Job_id);
       
        $result = $this->fdb->delete($Job_id);
        if ($result) {
            writelog('success', "Hapus Job id ({$Job->Job_id}) {$Job->Job_nama} Sukses.");
            flash_succ("Hapus Job  '{$Job->Job_nama}' Sukses.");
        } else {
            writelog('error', "Hapus Job id ({$Job->Job_id}) {$Job->Job_nama} Gagal.");
            flash_err("Hapus Job '{$Job->Job_nama}' Gagal.");
        }
        redirect(base_url($this->cname));
    }


    public function get_job(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->suges_job($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->job_nama;

        echo json_encode($json_array);      
    }

}
