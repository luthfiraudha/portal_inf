<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_inven extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_inven', 'fdb');
        $this->load->model('m_data_transaksi', 'fdbs');
        $this->cname = 'data_inven';
        $this->menu  = 'Data Inventori';
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
        $data['title']   = 'Data Inventori';
        $data['active']  = 'data_inven';
        $this->fitur     = 'Daftar';
        $data['content'] = 'data_inven_list';
        $data['plugins'] = array('datatables2');
        $data['inven']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add()
    {

        if ($this->input->post()) {
            $post = $this->input->post();
            

            $this->form_validation->set_rules('spk_inven', 'SPK Nomor', 'required');
            $this->form_validation->set_rules('nama_inven', 'Nama Inventori', 'required');
            $this->form_validation->set_rules('merk', 'Merk', 'required');
            $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');
            $this->form_validation->set_rules('sumber_inven', 'Sumber Inventori', 'required');
            $this->form_validation->set_rules('qty_inven', 'Jumlah Inventori', 'required');
            $this->form_validation->set_rules('tgl_datang', 'Tanggal Datang', 'required');
           
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Inventori Baru Gagal. " . validation_errors());
                flash_err('Tambah Inventori Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            /*$post['tgl_dipakai'] = date("Y-m-d", strtotime($post['tgl_dipakai']));*/
            $post['tgl_datang']   = date("Y-m-d", strtotime($post['tgl_datang']));
            $post["nama_inven"] = $post["nama_inven"] == "nn" ? $post["nama_inven_txt"] : $post["nama_inven"];
            unset($post["nama_inven_txt"]);    
            $post['tersedia'] = $post['qty_inven'];
            /*$post['ket_inven']           = "Belum dipakai";
            
            $post['tgl_dipakai']           = "0000/00/00";*/
            $nama = $post['nama_inven'] . " " . $post['merk'] ." " . $post['kapasitas'] . " GB" ;

            $ceksemua = $this->fdb->get_all();
                    foreach ($ceksemua as $key){
                    $availability = $this->fdb->cek_unique_update($post['spk_inven'], $key->id_inven);
                    }
            if ($availability) {
                flash_err("Tambah Inventori Baru Gagal. SPk nomor `{$post['spk_inven']}` telah diambil.");
                redirect(base_url($this->cname));
            }
            else{

            //$post["id_transaksi"] = $post2["id_transaksi"];    
            $data['id_inven'] = $this->fdb->add($post);    


                if ($data['id_inven']) {
                    writelog('success', "Tambah Inventori Baru dengan id {$data['id_inven']} Sukses.");
                    flash_succ("Tambah Inventori Baru `{$nama}` Sukses.");
                } else {
                    writelog('error', "Tambah Inventori Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Inventori Baru Gagal. Mohon periksa kembali formulir wajib.');
                }

            }
                redirect(base_url($this->cname));
                
            }

        $data['title']   = 'Data Inventori';
        $data['active']  = 'data Inventori';
        $this->fitur     = 'Tambah';
        $data['content'] = 'data_inven_form';
        
        $data['plugins'] = array('daterangepicker','add_inven');

        $this->load->view('template', $data);
    }

    protected function edit($id_inven = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $id_inven = $post['id_inven'];

            $post['tgl_datang']   = date("Y-m-d", strtotime($post['tgl_datang']));           

            $this->form_validation->set_rules('spk_inven', 'SPK Nomor', 'required');
            $this->form_validation->set_rules('nama_inven', 'Nama Inventori', 'required');
            $this->form_validation->set_rules('merk', 'Merk', 'required');
            $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');
            $this->form_validation->set_rules('sumber_inven', 'Sumber Inventori', 'required');
            $this->form_validation->set_rules('qty_inven', 'Jumlah Inventori', 'required');
            $this->form_validation->set_rules('tgl_datang', 'Tanggal Datang', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Inventori id {$id_inven} Gagal. " . validation_errors());
                flash_err("Ubah Inventori`{$post['nama_inven']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id_inven));
            }

            $post['tersedia'] = ($post['qty_inven'] - $post['rusak'] - $post['dipakai']);

            $result = $this->fdb->update($id_inven, $post);
                //echo var_dump($tes); die;              

                if ($result === false) {
                writelog('error', "Ubah Inventori id {$spk_inven} Gagal.");
                flash_err("Ubah Inventori '{$post['nama_inven']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah Inventori id {$id_inven} Sukses.");
                        flash_succ("Ubah Inventori'{$post['nama_inven']}' Sukses.");
                    } else {
                        writelog('warning', "Ubah Inventori id {$id_inven} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah Inventori Gagal. Tidak ada data yang berubah.");
                    }
                }

        
            redirect(base_url($this->cname));
        }

        $data['title']         = 'Data Inventori';
        $data['active']        = 'data Inventori';
        $this->fitur           = 'Ubah';
        $data['inven_detail'] = $this->fdb->get_row($id_inven);
        $data['inven']        = $this->fdb->get_all();
        $data['content']       = 'data_inven_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }

    protected function pakai($id_inven = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $id_inven = $post['id_inven'];

            $post['tgl_dipakai']   = date("Y-m-d", strtotime($post['tgl_dipakai'])); 

            $this->form_validation->set_rules('qty_inven_temp', 'Jumlah yang akan dipakai', 'required');
            //$this->form_validation->set_rules('status', 'Keterangan pengambilan', 'required');
            $this->form_validation->set_rules('ket_inven', 'Keterangan Pemakaian', 'required');
            $this->form_validation->set_rules('tgl_dipakai', 'Tanggal dipakai', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Pemakaian Inventori id {$id_inven} Gagal. " . validation_errors());
                flash_err("pemakaian Inventori`{$post['nama_inven']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/pakai/' . $id_inven));
            }

            
            if (($post['qty_inven_temp'] > $post['tersedia']) || ($post['qty_inven_temp'] <= 0)){
                writelog('error', "Pemakaian Inventori id {$id_inven} Gagal. " . validation_errors());
                flash_err("Jumlah Pemakaian Inventori tidak sesuai. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/pakai/' . $id_inven));
            }
            else{

                $post2['id_inven']=$post['id_inven'];
                $post2['qty_transaksi']=$post['qty_inven_temp'];
                //$post2['status']=$post['status'];
                $post2['ket_inven']=$post['ket_inven'];
                $post2["tgl_transaksi"] = $post["tgl_dipakai"];
                $data2['id_transaksi'] = $this->fdbs->add($post2); 

                
                if ($post['ket_inven']=="Rusak"){
                    $post['rusak'] = $post['rusak_temp'] + $post['qty_inven_temp'];                    
                }
                else{
                    $post['dipakai'] = $post['dipakai_temp'] + $post['qty_inven_temp'];                    
                }

                $post['tersedia'] = $post['tersedia'] - $post['qty_inven_temp'];

                
                  
                    unset($post['qty_inven_temp']);
                    unset($post['dipakai_temp']);
                    unset($post['rusak_temp']);
                    unset($post['status']);
                    unset($post['ket_inven']);
                    unset($post['tgl_dipakai']);

                    $result = $this->fdb->update($id_inven, $post);

                
                 
                //echo var_dump($tes); die;              
                }

            if ($result === false) {
                writelog('error', "Pemakaian Inventori id {$spk_inven} Gagal.");
                flash_err("Pemakaian Inventori SPK '{$post['spk_inven']}' dengan nama '{$post['nama_inven']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Pemakaian Inventori id {$id_inven} Sukses.");
                        flash_succ("Pemakaian Inventori SPK '{$post['spk_inven']}' dengan nama '{$post['nama_inven']}' Sukses.");
                    } else {
                        writelog('warning', "Pemakaian Inventori  SPK '{$post['spk_inven']}' dengan nama '{$post['nama_inven']}' Gagal. Tidak ada data yang berubah.");
                        flash_warn("Pemakaian Inventori Gagal. Tidak ada data yang berubah.");
                    }
                }
            
            redirect(base_url($this->cname));
            
        }

        $data['title']         = 'Data Inventori';
        $data['active']        = 'data Inventori';
        $this->fitur           = 'Pakai';
        $data['inven_detail'] = $this->fdb->get_row($id_inven);
        $data['inven']        = $this->fdb->get_all();
        $data['list_server']   = $this->fdb->get_list_server();
        $data['content']       = 'data_inven_form';
        $data['plugins']       = array('popconfirm', 'daterangepicker');

        $this->load->view('template', $data);
    }    

    protected function view($id_inven = '')
    {
        $data['title']         = 'Data Inventori';
        $data['active']        = 'data Inventori';
        $this->fitur           = 'Lihat';
        $data['inven_detail'] = $this->fdb->get_row($id_inven);
        $data['trans_detail'] = $this->fdb->get_trans($id_inven);

        $data['content'] = 'data_inven_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($id_inven = 0)
    {
        $inven = $this->fdb->get_row($id_inven);
        $result = $this->fdb->delete($id_inven);
        $this->fdbs->delete($id_inven);
        if ($result) {
            writelog('success', "Hapus Inventori ({$inven->id_inven}) Sukses.");
            flash_succ("Hapus Inventori  '{$inven->nama_inven}' SPK '{$inven->spk_inven}' Sukses.");
        } else {
            writelog('error', "Hapus Inventori id ({$inven->id_inven}) Gagal.");
            flash_err("Hapus  Inventori  '{$inven->nama_inven}' SPK '{$inven->spk_inven}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function get_allprojek(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_projek($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_inven;
        echo json_encode($json_array);      
    }

    public function get_allinven(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_inven($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_inven;
        echo json_encode($json_array);      
    }

}
