<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_sop extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_sop', 'fdb');
        $this->load->model('m_mdsc', 'mdsc');
        $this->cname = 'data_sop';
        $this->menu  = 'How To';
        $this->fitur = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function tes(){
        $coba = $this->fdb->tesdb();

        foreach ($coba as $key) {
            echo $key->tes;
            echo "</br>";
        }
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
        $data['title']   = 'How To';
        $data['active']  = 'data_sop';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_sop_list';
        $data['plugins'] = array('datatables');
        $data['sop']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add()
    {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('sop_name', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('sop_tgl', 'Tanggal Release', 'required');
            $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('sop_pic', 'Nama Pembuat (PIC)', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah SOP Baru Gagal. " . validation_errors());
                flash_err('Tambah SOP Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $sop_name = stringUrl($post['sop_name']);
            $nama_app = stringUrl($post['nama_app']);
            $nama_fitur = stringUrl($post['nama_fitur']);
             $jam = date("h-i-sa");
            $six_digit_random_number = mt_rand(10000, 99999);
            $post['sop_tgl'] = date("Y-m-d", strtotime($post['sop_tgl']));
            $fileName = $post['sop_tgl']."-".$nama_app."-".$nama_fitur."-".$sop_name."-".$jam;
            
            $config['upload_path'] = './uploads/sop/'; //buat folder dengan nama uploads di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'txt|pdf|doc|docx';
            $config['max_size'] = 100000;
             
            $this->load->library('upload');
            $this->upload->initialize($config);
             
            if(! $this->upload->do_upload('sop_pdf') ){
            $error = array('error' => $this->upload->display_errors());
            
            $data = array('upload_data' => $this->upload->data('sop_pdf'));
            

            }else{
               $data = array('upload_data' => $this->upload->data('sop_pdf'));
                $file = $_FILES['sop_pdf']['name'];
                $ext = substr(strrchr($file, '.'), 1);
                
                if($data){
                $post['sop_pdf'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/sop/' . $fileName.".".$ext;
                $data['sop_id'] = $this->fdb->add($post);
            if ($data['sop_id']) {
                    writelog('success', "Tambah SOP Baru dengan id {$data['sop_id']} Sukses.");
                    flash_succ("Tambah SOP Baru `{$post['sop_name']}` Sukses.");
                } else {
                    writelog('error', "Tambah SOP Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah SOP Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname));
                }
            }
      

           
        }

        $data['title']   = 'How To';
        $data['active']  = 'data sop';
        $this->fitur     = 'Tambah';
        $data['content'] = 'data_sop_form';
       
        $data['plugins'] = array('daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function edit($sop_id = '')
    {
        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('sop_name', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('sop_tgl', 'Tanggal Release', 'required');
            $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('sop_pic', 'Nama Pembuat (PIC)', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah SOP  Gagal. " . validation_errors());
                flash_err('Ubah SOP Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname));
            }
            if(isset($post['yesno'])){

                $sop_name = stringUrl($post['sop_name']);
                $nama_app = stringUrl($post['nama_app']);
                $nama_fitur = stringUrl($post['nama_fitur']);
                $jam = date("h-i-sa");
                $six_digit_random_number = mt_rand(10000, 99999);
                $post['sop_tgl'] = date("Y-m-d", strtotime($post['sop_tgl']));
                $fileName = $post['sop_tgl']."-".$nama_app."-".$nama_fitur."-".$sop_name."-".$jam;
             
                $config['upload_path'] = './uploads/sop/'; //buat folder dengan nama uploads di root folder
                $config['file_name'] = $fileName;
                $config['allowed_types'] = 'pdf|doc|docx|txt';
                $config['max_size'] = 10000000;
                 
                $this->load->library('upload');
                $this->upload->initialize($config);
               

                    if(! $this->upload->do_upload('sop_pdf') ){
                    $error = array('error' => $this->upload->display_errors());
                    $data = array('upload_data' => $this->upload->data('sop_pdf'));

                  
                    }else{
                        $data = array('upload_data' => $this->upload->data('sop_pdf'));
                         $file = $_FILES['sop_pdf']['name'];
                         $ext = substr(strrchr($file, '.'), 1);
                        if($data){
                        $post['sop_pdf'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/sop/' . $fileName.".".$ext;
                        unset($post['yesno']);
                        $data['sop_id'] = $this->fdb->update($sop_id,$post);
                        if ($data['sop_id']) {
                            writelog('success', "Ubah SOP dengan id {$data['sop_id']} Sukses.");
                            flash_succ("Ubah SOP `{$post['sop_name']}` Sukses.");
                        } else {
                            writelog('error', "Ubah SOP Gagal. Dari databasenya. ");
                            flash_err('Ubah SOP Gagal. Mohon periksa kembali formulir wajib.');
                        }
                        redirect(base_url($this->cname));
                        }
                    }
            }else{

                unset($post['sop_pdf']);
                unset($post['yesno']);
                $post['sop_tgl'] = date("Y-m-d", strtotime($post['sop_tgl']));
                $data['sop_id'] = $this->fdb->update($sop_id,$post);
                if ($data['sop_id']) {
                    writelog('success', "Ubah SOP dengan id {$data['sop_id']} Sukses.");
                    flash_succ("Ubah SOP `{$post['ap_name']}` Sukses.");
                } else {
                    writelog('error', "Ubah SOP Gagal. Dari databasenya. ");
                    flash_err('Ubah SOP Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname));
            }
            
      

           
        }

        $data['title']   = 'How To';
        $data['active']  = 'data sop';
        $this->fitur     = 'Ubah';
        $data['content'] = 'data_sop_form';
        $data['sop_detail'] = $this->fdb->get_row($sop_id);
        $data['plugins'] = array('daterangepicker','popconfirm','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function view($sop_id = '')
    {
        $data['title']         = 'How To';
        $data['active']        = 'data sop';
        $this->fitur           = 'Lihat';
        $data['sop_detail'] = $this->fdb->get_row($sop_id);

        $data['content'] = 'data_sop_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($sop_id = 0)
    {
        $sop = $this->fdb->get_row($sop_id);
        $result = $this->fdb->delete($sop_id);
        if ($sop) {
            writelog('success', "Hapus SOP id ({$sop->sop_id}) Sukses.");
            flash_succ("Hapus SOP  '{$sop->sop_name}' Sukses.");
        } else {
            writelog('error', "Hapus SOP id ({$sop->sop_id}) Gagal.");
            flash_err("Hapus  SOP  '{$sop->sop_name}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function get_allaplikasi(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->mdsc->aplikasi_getall($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_app;

        echo json_encode($json_array);      
    }

    public function get_allfitur(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->mdsc->fitur_getall($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_fitur;
        echo json_encode($json_array);      
    }


    public function get_fitur(){
        $kode=$this->input->post('kode',TRUE);
        $nama_app=$this->input->post('nama_app',TRUE);

        $query=$this->mdsc->get_fitur($nama_app,$kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_fitur;
        echo json_encode($json_array);      
    }

    public function get_app(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->mdsc->get_app($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_app;

        echo json_encode($json_array);      
    }
    

    

}
