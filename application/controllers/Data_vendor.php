<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_vendor', 'fdb');
        $this->cname = 'data_vendor';
        $this->menu  = 'Data Vendor';
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
        $data['title']   = 'Data Vendor';
        $data['active']  = 'data_vendor';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_vendor_list';
        $data['plugins'] = array('datatables');
        $data['vendor']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add()
    {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('spk_nmr', 'SPK Nomor', 'required');
            $this->form_validation->set_rules('vendor_nama', 'Nama Vendor', 'required');
            $this->form_validation->set_rules('nama_projek', 'Nama Projek', 'required');
            $this->form_validation->set_rules('vendor_begindate', 'Tanggal Kontrak', 'required');
            $this->form_validation->set_rules('vendor_enddate', 'Tanggal Berakhir', 'required');
            $this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'required');
            

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Kontrak Vendor Baru Gagal. " . validation_errors());
                flash_err('Tambah Kontrak Vendor Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            $post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
            $post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));
            $post['status']           = "baru";



            $fileName = $post['vendor_begindate']."-".$post['spk_nmr']."-".uniqid();
            $config['upload_path'] = './uploads/spk/'; //buat folder dengan nama uploads di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 99999999999999;
             
            $this->load->library('upload');
            $this->upload->initialize($config);
             
            if(! $this->upload->do_upload('vendor_dokumen') ){
            $error = array('error' => $this->upload->display_errors());
            $data = array('upload_data' => $this->upload->data('vendor_dokumen'));
            echo var_dump($error);exit;

            }else{
                $data = array('upload_data' => $this->upload->data('vendor_dokumen'));
                if($data){
                $post['vendor_dokumen'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/spk/' . $fileName.".pdf";
                    $ceksemua = $this->fdb->get_all();
                    foreach ($ceksemua as $key) {
                        $availability = $this->fdb->cek_unique_update($post['spk_nmr'], $key->vendor_id);
                    }
                    
                    if ($availability) {
                       
                        flash_err("Tambah kontrak Gagal. vendor `{$post['spk_nmr']}` telah diambil.");
                        redirect(base_url($this->cname));
                    }else{
                    $data['vendor_id'] = $this->fdb->add($post);
                    if ($data['vendor_id']) {
                            writelog('success', "Tambah SPK vendor Baru dengan id {$data['vendor_id']} Sukses.");
                            flash_succ("Tambah SPK vendor Baru `{$post['vendor_nama']}` dengan projek `{$post['nama_projek']}` Sukses.");
                        } else {
                            writelog('error', "Tambah SPK vendor Baru Gagal. Dari databasenya. ");
                            flash_err('Tambah SPK vendor Baru Gagal. Mohon periksa kembali formulir wajib.');
                        }
                    }
            
                redirect(base_url($this->cname));
                }
            }

           
        }

        $data['title']   = 'Data Vendor';
        $data['active']  = 'data vendor';
        $this->fitur     = 'Tambah';
        $data['content'] = 'data_vendor_form';
        
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    protected function edit($vendor_id = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $vendor_id = $post['vendor_id'];
            $this->form_validation->set_rules('spk_nmr', 'SPK Nomor', 'required');
            $this->form_validation->set_rules('vendor_nama', 'Nama Vendor', 'required');
            $this->form_validation->set_rules('nama_projek', 'Nama Projek', 'required');
            $this->form_validation->set_rules('vendor_begindate', 'Tanggal Kontrak', 'required');
            $this->form_validation->set_rules('vendor_enddate', 'Tanggal Berakhir', 'required');
            $this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'required');
            

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Kontrak Vendor Baru Gagal. " . validation_errors());
                flash_err('Tambah Kontrak Vendor Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            if(isset($post['yesno'])){
                $post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
                $post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));
               
                $fileName = $post['vendor_begindate']."-".$post['spk_nmr']."-".uniqid();
                $config['upload_path'] = './uploads/spk/'; //buat folder dengan nama uploads di root folder
                $config['file_name'] = $fileName;
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = 99999999999999;
                 
                $this->load->library('upload');
                $this->upload->initialize($config);
                 
                if(! $this->upload->do_upload('vendor_dokumen') ){
                $error = array('error' => $this->upload->display_errors());
                $data = array('upload_data' => $this->upload->data('vendor_dokumen'));
                echo var_dump($error);exit;

                }else{
                    $data = array('upload_data' => $this->upload->data('vendor_dokumen'));
                    if($data){
                    $post['vendor_dokumen'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/spk/' . $fileName.".pdf";
                    unset($post['yesno']);
                     $cekspk =$this->fdb->get_row($vendor_id);
                        $temp = NULL;
                        
                        if($cekspk->spk_nmr == $post['spk_nmr']){
                                $temp = 1;
                         }
                    
                   
                        if($temp == 1){
                            
                            $data['vendor_id'] = $this->fdb->update($vendor_id,$post);
                            if ($data['vendor_id']) {
                                writelog('success', "Ubah SPK vendor dengan id {$data['vendor_id']} Sukses.");
                                flash_succ("Ubah SPK vendor  `{$post['vendor_nama']}` dengan projek `{$post['nama_projek']}` Sukses.");
                            } else {
                                writelog('error', "Ubah SPK vendor  Gagal. Dari databasenya. ");
                                flash_err('Ubah SPK vendor  Gagal. Mohon periksa kembali formulir wajib.');
                            }

                        }else if($temp == NULL){
                             $ceksemua =$this->fdb->get_all();
                           foreach ($ceksemua as $key) {
                                $availability = $this->fdb->cek_unique_update($post['spk_nmr'], $key->vendor_id);
                            }
                            
                            if ($availability) {
                               
                                flash_err("Tambah kontrak Gagal. vendor `{$post['spk_nmr']}` telah diambil.");
                                redirect(base_url($this->cname));
                            }else{
                                
                                $data['vendor_id'] = $this->fdb->update($vendor_id,$post);
                                if ($data['vendor_id']) {
                                        writelog('success', "Tambah SPK vendor Baru dengan id {$data['vendor_id']} Sukses.");
                                        flash_succ("Tambah SPK vendor Baru `{$post['vendor_nama']}` dengan projek `{$post['nama_projek']}` Sukses.");
                                    } else {
                                        writelog('error', "Tambah SPK vendor Baru Gagal. Dari databasenya. ");
                                        flash_err('Tambah SPK vendor Baru Gagal. Mohon periksa kembali formulir wajib.');
                                    }
                            } 
                        }               
                   

                    redirect(base_url($this->cname));
                    }
                }

            }else{

                $post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
                $post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));
                unset($post['vendor_dokumen']);
                unset($post['yesno']);

                        $cekspk =$this->fdb->get_row($vendor_id);
                        $temp = NULL;
                        
                        if($cekspk->spk_nmr == $post['spk_nmr']){
                                $temp = 1;
                         }
                    
                   
                        if($temp == 1){
                            
                            $data['vendor_id'] = $this->fdb->update($vendor_id,$post);
                            if ($data['vendor_id']) {
                                writelog('success', "Ubah SPK vendor dengan id {$data['vendor_id']} Sukses.");
                                flash_succ("Ubah SPK vendor  `{$post['vendor_nama']}` dengan projek `{$post['nama_projek']}` Sukses.");
                            } else {
                                writelog('error', "Ubah SPK vendor  Gagal. Dari databasenya. ");
                                flash_err('Ubah SPK vendor  Gagal. Mohon periksa kembali formulir wajib.');
                            }

                        }else if($temp == NULL){
                             $ceksemua =$this->fdb->get_all();
                           foreach ($ceksemua as $key) {
                                $availability = $this->fdb->cek_unique_update($post['spk_nmr'], $key->vendor_id);
                            }
                            
                            if ($availability) {
                               
                                flash_err("Tambah kontrak Gagal. vendor `{$post['spk_nmr']}` telah diambil.");
                                redirect(base_url($this->cname));
                            }else{
                                
                                $data['vendor_id'] = $this->fdb->update($vendor_id,$post);
                                if ($data['vendor_id']) {
                                        writelog('success', "Tambah SPK vendor Baru dengan id {$data['vendor_id']} Sukses.");
                                        flash_succ("Tambah SPK vendor Baru `{$post['vendor_nama']}` dengan projek `{$post['nama_projek']}` Sukses.");
                                    } else {
                                        writelog('error', "Tambah SPK vendor Baru Gagal. Dari databasenya. ");
                                        flash_err('Tambah SPK vendor Baru Gagal. Mohon periksa kembali formulir wajib.');
                                    }
                            } 
                        }
               
                
                    redirect(base_url($this->cname));
                  
            }

            

           
        }

        $data['title']   = 'Data Vendor';
        $data['active']  = 'data vendor';
        $this->fitur     = 'Ubah';
        $data['content'] = 'data_vendor_form';
        $data['vendor_detail'] = $this->fdb->get_row($vendor_id);

       $data['plugins'] = array('daterangepicker','popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($vendor_id = '')
    {
        $data['title']         = 'Data Vendor';
        $data['active']        = 'data vendor';
        $this->fitur           = 'Lihat';
        $data['vendor_detail'] = $this->fdb->get_row($vendor_id);

        $data['content'] = 'data_vendor_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($vendor_id = 0)
    {
        $vendor = $this->fdb->get_row($vendor_id);
        $result = $this->fdb->delete($vendor_id);
        if ($result) {
            writelog('success', "Hapus Vendor id ({$vendor->vendor_id}) {$vendor->spk_nmr} Sukses.");
            flash_succ("Hapus Vendor  '{$vendor->spk_nmr}' Sukses.");
        } else {
            writelog('error', "Hapus Vendor id ({$vendor->vendor_id}) {$vendor->spk_nmr} Gagal.");
            flash_err("Hapus  Vendor  '{$vendor->spk_nmr}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function get_allprojek(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_projek($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_projek;
        echo json_encode($json_array);      
    }

    public function get_allvendor(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_vendor($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->vendor_nama;
        echo json_encode($json_array);      
    }


    public function upload_file()
    {
        $data['title']   = 'Data Vendor';
        $data['active']  = 'data vendor';
        $this->fitur     = 'Upload';
        $data['content'] = 'data_vendor_form_upload';
        $data['plugins'] = array('');

        $this->load->view('template', $data);
    }

    public function upload(){
        $fileName = date("Y-m-d")."-".$_FILES['file']['name'];
         
        $config['upload_path'] = './uploads/'; //buat folder dengan nama uploads di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'csv|xls';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') ){
           writelog('error', "upload gagal");
            flash_err("upload gagal. file harus CSV"); 
            redirect($this->cname.'/upload_file');
        }
        
       
        
             
        $media = $this->upload->data('file');

        
        $inputFileName = './uploads/'.$fileName;
         
        try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
 
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
             
            for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                NULL,
                                                TRUE,
                                                FALSE);
                                                 
                //Sesuaikan sama nama kolom tabel di database                                
                 $data = array(
                    "spk_nmr"=> (string)$rowData[0][0],
                    "vendor_nama"=> (string)$rowData[0][1],
                    "vendor_begindate"=> (string)$rowData[0][2],
                    "vendor_enddate"=> (string)$rowData[0][3],
                    "vendor_tugas"=> (string)$rowData[0][4],
                    "status"=> (string)$rowData[0][5],
                    "nilai_kontrak"=> (string)$rowData[0][6]
                );

               
                 
                //sesuaikan nama dengan nama tabel
                $insert = $this->fdb->add($data);
                delete_files($media['file_path']);
                if ($insert) {
                    writelog('success', "upload Sukses.");
                    flash_succ("upload Sukses.");
                } else {
                    writelog('error', "Upload Gagal.");
                    flash_err("Upload Gagal.");
                }
                     
            }
        writelog('succes', "upload sukses");
        flash_succ("upload sukses"); 
        redirect($this->cname);
    }

}
