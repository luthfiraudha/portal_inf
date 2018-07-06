<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reminder_vendor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_vendor', 'fdb');
        $this->cname = 'reminder_vendor';
        $this->menu  = 'Check Contract Vendor';
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
        $sv = $this->fdb->get_setting();
        $data['title']   = 'reminder kontrak vendor';
        $data['active']  = 'reminder_vendor';
        $this->fitur     = 'Daftar';
        $data['content'] = 'reminder_vendor_list';
        $data['plugins'] = array('datatables');
        $data['sv'] = $sv->sv_value;
        $data['vendor']  = $this->fdb->getInterval($sv->sv_value);
        $this->load->view('template', $data);
    }

    public function add($vendor_id='')
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
            $post['status']           = "perpanjang";



            $fileName = $post['vendor_begindate']."-".$post['spk_nmr']."-".uniqid();
            $config['upload_path'] = './uploads/spk/'; //buat folder dengan nama uploads di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 100000;
             
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
                       
                        flash_err("Ubah User Gagal. User `{$post['spk_nmr']}` telah diambil.");
                        redirect(base_url($this->cname));
                    }else{
                      $data['vendor_id'] = $this->fdb->add($post);
                        $result = $this->fdb->extend($vendor_id);
                    if ($data['vendor_id'] ) {
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
        $this->fitur     = 'Perpanjang';
        $data['content'] = 'reminder_vendor_form';
        $data['vendor_detail'] = $this->fdb->get_row($vendor_id);
        $data['plugins'] = array('daterangepicker');
        $this->load->view('template', $data);
    }

    protected function extend($vendor_id = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $vendor_id = $post['vendor_id'];

            $post['vendor_begindate'] = date("Y-m-d", strtotime($post['vendor_begindate']));
            $post['vendor_enddate']   = date("Y-m-d", strtotime($post['vendor_enddate']));

            $this->form_validation->set_rules('spk_nmr', 'SPK Nomor', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Kontrak Vendor id {$vendor_id} Gagal. " . validation_errors());
                flash_err("Ubah Kontrak Vendor`{$post['spk_nmr']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $vendor_id));
            }

            $availability = $this->fdb->cek_unique_update($post['spk_nmr'], $vendor_id);
            if ($availability) {
                writelog('error', "Ubah Kontrak Vendor id {$vendor_id} Gagal. Nama telah diambil.");
                flash_err("Ubah Kontrak Vendor Gagal. Nomor Vendor `{$post['spk_nomor']}` telah diambil.");
                redirect(base_url($this->cname . '/action/edit/' . $akses_id));
            }

            $result = $this->fdb->update($vendor_id, $post);

            if ($result === false) {
                writelog('error', "Ubah Kontrak Vendor id {$vendor_id} Gagal.");
                flash_err("Ubah Kontrak Vendor '{$post['spk_nmr']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Kontrak Vendor id {$vendor_id} Sukses.");
                    flash_succ("Ubah Kontrak Vendor'{$post['spk_nmr']}' Sukses.");
                } else {
                    writelog('warning', "Ubah Kontrak Vendor id {$vendor_id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah Kontrak Vendor Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title']         = 'Data vendor';
        $data['active']        = 'data vendor';
        $this->fitur           = 'Ubah';
        $data['vendor_detail'] = $this->fdb->get_row($vendor_id);
        $data['vendor']        = $this->fdb->get_all();
        $data['content']       = 'reminder_vendor_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }


    protected function dismiss($vendor_id = 0)
    {
        $vendor = $this->fdb->get_row($vendor_id);
        $result = $this->fdb->dismiss($vendor_id);
        if ($result) {
            writelog('success', "dimiss Vendor id ({$vendor->vendor_id}) {$vendor->spk_nmr} Sukses.");
            flash_succ("dismiss Vendor  '{$vendor->spk_nmr}' Sukses.");
        } else {
            writelog('error', "dismiss Vendor id ({$vendor->vendor_id}) {$vendor->spk_nmr} Gagal.");
            flash_err("dismiss  Vendor  '{$vendor->spk_nmr}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function update_setting(){
        if ($this->input->post()) {
            $post      = $this->input->post();
            
            $this->form_validation->set_rules('sv_value', 'Waktu Reminder', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Setting Reminder Vendor Gagal. " . validation_errors());
                flash_err("Ubah Setting Reminder Vendor Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/upadate_setting/'));
            }


            $result = $this->fdb->set_setting($post);

            if ($result === false) {
                writelog('error', "Ubah Setting Reminder Vendor Gagal.");
                flash_err("Ubah Setting Reminder Vendor  Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Kontrak Vendor  Sukses.");
                    flash_succ("Ubah Setting Reminder Vendor  Sukses.");
                } else {
                    writelog('warning', "Ubah Kontrak Vendor. Tidak ada data yang berubah.");
                    flash_warn("Ubah Setting Reminder Vendor Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title']         = 'Setting Reminder Vendor';
        $data['active']        = 'reminder kontrak vendor';
        $this->fitur           = 'Update Setting';
        $data['sv_detail'] = $this->fdb->get_setting();
        $data['content']       = 'reminder_vendor_form';
        $data['plugins']       = array('popconfirm');

        $this->load->view('template', $data);
    }




}
