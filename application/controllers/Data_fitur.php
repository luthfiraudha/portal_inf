<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_fitur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_fitur', 'fdb');
        $this->cname = 'data_fitur';
        $this->menu  = 'Data Fitur';
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
        $data['title']   = 'Data Fitur';
        $data['active']  = 'data_fitur';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_fitur_list';
        $data['plugins'] = array('datatables2');
        $data['fitur']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add($id)
    {

        if ($this->input->post()) 
        {
            $post = $this->input->post();
            $post['id_app'] = $id;
            $id_app = $post['id_app'];

            $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            /*$this->form_validation->set_rules('des_fitur', 'Deskripsi Fitur', 'required');
            $this->form_validation->set_rules('tipe_fitur', 'Tipe Fitur', 'required');
            $this->form_validation->set_rules('pengembang', 'Pengembang', 'required'); 
            $this->form_validation->set_rules('programmer', 'Programmer', 'required'); 
            $this->form_validation->set_rules('platform', 'Platform', 'required'); */
            

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Fitur Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Fitur Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add'.$id_app);
            }

                $data['id_fitur'] = $this->fdb->add($post);
            if ($data['id_fitur']) {
                    writelog('success', "Tambah Data Fitur Baru dengan id {$data['id_fitur']} Sukses.");
                    flash_succ("Tambah Data Fitur Baru '{$post['nama_fitur']}' Sukses.");
                } else {
                    writelog('error', "Tambah Data Fitur Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Data Fitur Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->xname. '/data_aplikasi/action/view/'.$id_app));
                
            
        }

        $data['title']   = 'Data fitur';
        $data['active']  = 'data fitur';
        $this->fitur     = 'Tambah';
        $this->aktif     = 'Data Fitur';
        $this->xname = 'data_aplikasi';
        $data['content'] = 'data_fitur_form';
        
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    

    protected function edit($id_fitur = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $id_fitur = $post['id_fitur'];
            $id_app = $post['id_app'];

            //$post['tgl_deploy'] = date("Y-m-d", strtotime($post['tgl_deploy']));
            
            $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('tipe_fitur', 'Tipe Fitur', 'required');
            $this->form_validation->set_rules('des_fitur', 'Deskripsi Fitur', 'required');
            $this->form_validation->set_rules('pengembang', 'Bagian Pengembang', 'required');
            $this->form_validation->set_rules('programmer', 'Programmer', 'required');
            $this->form_validation->set_rules('platform', 'Platform', 'required');


            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Data Fitur id {$id_fitur} Gagal. " . validation_errors());
                flash_err("Ubah Data APlikasi `{$post['nama_fitur']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id_fitur));
            }

            $result = $this->fdb->update($id_fitur, $post);

            if ($result === false) {
                writelog('error', "Ubah data fitur id '{$id_fitur}' Gagal.");
                flash_err("Ubah data fitur '{$post['nama_fitur']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah data fitur id {$id_fitur} dengan nama '{$post['nama_fitur']}' Sukses.");
                    flash_succ("Ubah data fitur '{$post['nama_fitur']}' Sukses.");
                    
                    ;
                    redirect(base_url().'data_aplikasi/action/view/'.$id_app);
                } else {
                    writelog('warning', "Ubah data fitur id '{$id_fitur}' Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah data fitur '{$post['nama_fitur']}' Gagal. Tidak ada data yang berubah.");
                    redirect(base_url().'data_aplikasi/action/view/'.$id_app);  
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title']         = 'Data fitur';
        $data['active']        = 'data fitur';
        $this->fitur           = 'Ubah';
        $this->aktif           = 'Data Fitur';
        $data['fitur_detail'] = $this->fdb->get_row($id_fitur);
        $data['fitur']        = $this->fdb->get_all();
        $data['content']       = 'data_fitur_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }

    protected function view($id_fitur = '')
    {
        $data['title']         = 'Data Dokumen';
        $data['active']        = 'data Dokumen';
        $this->fitur           = 'Lihat';
        $this->aktif           = 'Data Dokumen';
        $data['fitur_detail'] = $this->fdb->get_row($id_fitur);
        $data['dokumen_detail'] = $this->fdb->get_dok($id_fitur);

        $data['content'] = 'data_fitur_form';
        $data['plugins'] = array('popconfirm','datatables2');

        $this->load->view('template', $data);

    }

    protected function delete($id_fitur = 0)
    {
        $fitur = $this->fdb->get_row($id_fitur);
        $result = $this->fdb->delete($id_fitur);
        $id_app=$fitur->id_app;
        $id_fitur=$fitur->id_fitur;
        $nama_fitur= $fitur->nama_fitur;

        if ($result) {
            writelog('success', "Hapus data fitur id ({$id_fitur}) dengan nama {$nama_fitur} Sukses.");
            flash_succ("Hapus data fitur  '{$nama_fitur}' Sukses.");
        } else {
            writelog('error', "Hapus data fitur id ({$id_fitur}) {$nama_fitur} Gagal.");
            flash_err("Hapus data fitur  '{$nama_fitur}' Gagal.");
        }

        $data['plugins'] = array('popconfirm','datatables2');
        redirect(base_url().'data_aplikasi/action/view/'.$id_app);  
    }

    public function get_allproject(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_project($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_project;
        echo json_encode($json_array);      
    }

    public function get_allfitur(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_fitur($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->fitur_nama;
        echo json_encode($json_array);      
    }


    /*public function upload_file()
    {
        $data['title']   = 'Data fitur';
        $data['active']  = 'data fitur';
        $this->fitur     = 'Upload';
        $data['content'] = 'data_fitur_form_upload';
        $data['plugins'] = [''];

        $this->load->view('template', $data);
    }*/

       

}
