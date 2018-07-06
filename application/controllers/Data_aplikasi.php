<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_aplikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_aplikasi', 'fdb');
        $this->load->model('m_data_fitur', 'fdbb');
        $this->load->model('m_data_dok', 'fdbc');
        $this->cname = 'data_aplikasi';
        $this->menu  = 'Data Aplikasi';
        $this->fitur = '';
        $this->aktif = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index()
    {
        $this->lists();
    }

    public function action($func = '', $id = 0) {
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
        $data['title']   = 'Data aplikasi';
        $data['active']  = 'data_aplikasi';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_aplikasi_list';
        $data['plugins'] = array('datatables2');
        $data['aplikasi']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add()
    {

        if ($this->input->post()) 
        {
            $post = $this->input->post();

            $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            /*$this->form_validation->set_rules('des_app', 'Deskripsi Aplikasi', 'required');*/
            

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Aplikasi Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Aplikasi Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
            $ceksemua = $this->fdb->get_all();
                    foreach ($ceksemua as $key){
                    $availability = $this->fdb->cek_unique_update($post['nama_app'], $key->id_app);
                    }
            if ($availability) {
                flash_err("Tambah Aplikasi Baru Gagal. Nama Aplikasi `{$post['nama_app']}` telah diambil.");
                redirect(base_url($this->cname));
            }
            else{

                $data['id_app'] = $this->fdb->add($post);
            if ($data['id_app']) {
                    writelog('success', "Tambah Data Aplikasi Baru dengan id {$data['id_app']} Sukses.");
                    flash_succ("Tambah Data Aplikasi Baru '{$post['nama_app']}' Sukses.");
                } else {
                    writelog('error', "Tambah Data Aplikasi Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Data Aplikasi Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
            }
                redirect(base_url($this->cname));
                
            
        }

        $data['title']   = 'Data aplikasi';
        $data['active']  = 'data aplikasi';
        $this->fitur     = 'Tambah';
        $data['content'] = 'data_aplikasi_form';
        
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    

    protected function edit($id_app = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $id_app = $post['id_app'];

            //$post['tgl_deploy'] = date("Y-m-d", strtotime($post['tgl_deploy']));
            
            $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('des_app', 'Deskripsi Aplikasi', 'required');


            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Data Aplikasi id {$id_app} Gagal. " . validation_errors());
                flash_err("Ubah Data APlikasi `{$post['nama_app']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id_app));
            }

                $ceknama = $this->fdb->get_row($id_app);

                if($ceknama->nama_app == $post['nama_app'])
                {
                    $data['id_app'] = $this->fdb->update($id_app, $post);
                    
                        if ($data['id_app']) {
                            writelog('success', "Ubah data aplikasi id {$id_app} Sukses.");
                            flash_succ("Ubah data aplikasi '{$post['nama_app']}' Sukses.");
                        } else {
                            writelog('warning', "Ubah data aplikasi id {$id_app} Gagal. Tidak ada data yang berubah.");
                            flash_warn("Ubah data aplikasi Gagal. Tidak ada data yang berubah.");
                        }
                    
                }

                else {
                    $ceksemua = $this->fdb->get_all();
                        foreach ($ceksemua as $key){
                        $availability = $this->fdb->cek_unique_update($post['nama_app'], $key->id_app);
                        }
                    if ($availability) {
                        flash_err("Ubah Data Aplikasi gagal, Nama Aplikasi `{$post['nama_app']}` telah diambil.");
                        redirect(base_url($this->cname));
                    }
                    else{
                        $data['id_app'] = $this->fdb->update($id_app, $post);
                            if ($data['id_app']) {
                                writelog('success', "Ubah data aplikasi id {$id_app} Sukses.");
                                flash_succ("Ubah data aplikasi '{$post['nama_app']}' Sukses.");
                            } else {
                                writelog('warning', "Ubah data aplikasi id {$id_app} Gagal. Tidak ada data yang berubah.");
                                flash_warn("Ubah data aplikasi Gagal. Tidak ada data yang berubah.");
                            }
                    }

            }
            
            redirect(base_url($this->cname));
        }
    
                    

        $data['title']         = 'Data aplikasi';
        $data['active']        = 'data aplikasi';
        $this->fitur           = 'Ubah';
        $this->aktif           = 'Data Aplikasi';
        $data['app_detail'] = $this->fdb->get_row($id_app);
        $data['aplikasi']        = $this->fdb->get_all();
        $data['content']       = 'data_aplikasi_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }

    protected function view($id_app = '')
    {
        $data['title']         = 'Data Fitur';
        $data['active']        = 'data Fitur';
        $this->fitur           = 'Lihat';
        $this->aktif           = 'Data Fitur';
        $data['app_detail'] = $this->fdb->get_row($id_app);
        $data['fitur_detail'] = $this->fdb->get_fit($id_app);

        $data['content'] = 'data_aplikasi_form';
        $data['plugins'] = array('popconfirm','datatables2');

        $this->load->view('template', $data);
    }

    protected function delete($id_app = 0)
    {
        $aplikasi = $this->fdb->get_row($id_app);
        $fitur = $this->fdbb->get_row_by_app($id_app);
        $id_app= $aplikasi->id_app;
        $nama_app= $aplikasi->nama_app;
        

        //print_r($fitur);exit;
        foreach ($fitur as $key) {
            $this->fdbb->delete2($key->id_app);

            $dok = $this->fdbc->get_row_by_fitur($key->id_fitur);
            foreach ($dok as $key2) {
                $this->fdbc->delete2($key2->id_fitur);
            }
        }       
        $result = $this->fdb->delete($id_app);
        if ($result) {
            writelog('success', "Hapus aplikasi id '{$id_app}' dengan nama '{$nama_app}' Sukses.");
            flash_succ("Hapus aplikasi  '{$nama_app}' Sukses.");
        } else {
            writelog('error', "Hapus aplikasi id {$id_app} dengan nama '{$nama_app}' Gagal.");
            flash_err("Hapus  aplikasi  '{$nama_app}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function get_allproject(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_project($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_project;
        echo json_encode($json_array);      
    }

    public function get_allaplikasi(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_aplikasi($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->aplikasi_nama;
        echo json_encode($json_array);      
    }



}
