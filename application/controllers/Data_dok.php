<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_dok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_dok', 'fdb');
        $this->cname = 'data_dok';
        $this->menu  = 'Data Dokumen';
        $this->fitur = '';

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
        $data['title']   = 'Data Dokumen';
        $data['active']  = 'data_dok';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_projek_list';
        $data['plugins'] = array('datatables2');
        $data['projek']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function get_allproject(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_project($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_project;
        echo json_encode($json_array);      
    }

    
    public function upload_file()
    {
        $data['title']   = 'Data projek';
        $data['active']  = 'data projek';
        $this->fitur     = 'Upload';
        $data['content'] = 'data_projek_form_upload';
        $data['plugins'] = array('');

        $this->load->view('template', $data);
    }

   
    protected function edit($id_doc = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $id_doc = $post['id_doc'];
            $id_fitur = $post['id_fitur'];
            $versi_app = $post['versi_a'] ."_". $post['versi_b'] ."_". $post['versi_c'];
            
            $result_id = $this->fdb->get_id_app($id_fitur);
            $id_app = $result_id->id_app;
            $nama_fitur = $result_id->nama_fitur;
            $tipe_fitur = $result_id->tipe_fitur;

            $result_nama_app = $this->fdb->get_nama_app($id_app); 
            $nama_app= $result_nama_app->nama_app;

            $nama_app= str_replace (' ','_',$nama_app);
            $nama_fitur= str_replace (' ','_',$nama_fitur);
            $tipe_fitur= str_replace (' ','_',$tipe_fitur);

            
            $this->form_validation->set_rules('versi_a', 'Versi Aplikasi', 'required');
            $this->form_validation->set_rules('versi_b', 'Versi Aplikasi', 'required');
            $this->form_validation->set_rules('versi_c', 'Versi Aplikasi', 'required');




            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah versi id {$id_doc} Gagal. " . validation_errors());
                flash_err("Ubah Data Aplikasi Versi `{$versi_app}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id_doc));
            }

            if(isset($post['yesno'])){
                //$post['tgl_deploy'] = date("Y-m-d", strtotime($post['tgl_deploy']));

                $fileName = $nama_app . "_Fitur_".$nama_fitur. "_V_".$versi_app . "(".$tipe_fitur.")";
                $config['upload_path'] = './uploads/dataapp/'; //buat folder dengan nama uploads di root folder
                $config['file_name'] = $fileName;
                $config['allowed_types'] = 'rar';
                $config['max_size'] = 250000;
               
                 
                $this->load->library('upload');
                $this->upload->initialize($config);
                 
                if(! $this->upload->do_upload('dok_app') ){
                    $error = array('error' => $this->upload->display_errors());
                    $data = array('upload_data' => $this->upload->data('dok_app'));
                    echo var_dump($error);exit;

                }
                else{
                    $data = array('upload_data' => $this->upload->data('dok_app'));
                    if($data){
                    $post['dok_app'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/dataapp/' . $fileName.".rar";
                    unset($post['yesno']);
                    $data['id_doc'] = $this->fdb->update($id_doc,$post);
                    if ($data['id_doc']) {
                        writelog('success', "Ubah Dokumen Aplikasi id '{$id_doc}' Sukses.");
                        flash_succ("Ubah Dokumen Aplikasi versi `{$versi_app}` fitur `{$nama_fitur}` Sukses.");
                    } else {
                        writelog('error', "Ubah  Dokumen Aplikasi Gagal. Dari database-nya. ");
                        flash_err('Ubah  Dokumen Aplikasi  Gagal. Mohon periksa kembali formulir wajib.');
                    }
                    redirect(base_url().'data_fitur/action/view/'.$id_fitur);
                    }
                }
            }

            else{
                $result= $data['id_doc'] = $this->fdb->update($id_doc,$post);

                if ($result === false) {
                    writelog('error', "Ubah data versi '{$versi_app}' Gagal.");
                    flash_err("Ubah data versi '{$versi_app}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah data dokumen id {$id_fitur} versi '{$versi_app}' Sukses.");
                        flash_succ("Ubah data versi '{$versi_app}' Sukses.");
                        redirect(base_url().'data_fitur/action/view/'.$id_fitur);
                    } else {
                        writelog('warning', "Ubah data versi '{$versi_app}' Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah data versi '{$versi_app}' Gagal. Tidak ada data yang berubah.");
                        redirect(base_url().'data_aplikasi/action/view/'.$id_fitur);  
                    }
                }
            }

        }

        $data['title']         = 'Data Dokumen';
        $data['active']        = 'data_dok';
        $this->fitur           = 'Ubah';
        $data['projek_detail'] = $this->fdb->get_row($id_doc);
        $data['projek']        = $this->fdb->get_all();
        $data['content']       = 'data_dok_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }

    protected function delete($id_doc = 0)
    {
        $projek = $this->fdb->get_row($id_doc);
        $result = $this->fdb->delete($id_doc);
        $id_fitur = $projek->id_fitur;
        $id_doc = $projek->id_doc;
        $versi_app = $projek->versi_a .".". $projek->versi_b."." . $projek->versi_c;
        if ($result) {
            writelog('success', "Hapus dokumen aplikasi versi ({$id_doc}) Sukses.");
            flash_succ("Hapus dokumen aplikasi versi '{$versi_app}' Sukses.");
        } else {
            writelog('error', "Hapus dokumen aplikasi versi ({$id_doc}) Gagal.");
            flash_err("Hapus dokumen aplikasi '{$versi_app}' Gagal.");
        }
        redirect(base_url("data_fitur/action/view/". $id_fitur));
    }

    public function get_allproject2(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_project($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_project;
        echo json_encode($json_array);      
    }

    public function get_allprojek2(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_projek($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->versi_app;
        echo json_encode($json_array);      
    }

    //--------------------------------------

   

}
