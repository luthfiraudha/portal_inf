<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pms_lan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_pms_lan', 'fdb');
        $this->cname = 'pms_lan';
        $this->menu = 'PMS LAN';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index() {
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

    public function lists() {
        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur = 'Daftar';
        $data['content'] = 'pms_lan/pms_lan_list';
        $data['plugins'] = array('datatables','daterangepicker','pms_lan');
       
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('kanwil_divisi', 'Kanwil / Divisi', 'required');
            $this->form_validation->set_rules('kanca_bagian', 'Kanca / Bagian', 'required');
            $this->form_validation->set_rules('jenis', 'Jenis', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $post['smu_status'] = 0;
            $post['sku_status'] = 0;
            $post['suk_status'] = 0;
            $post['ip_status'] = 0;   
            $post['sph_status'] = 0;
            $post['spk_status'] = 0;
            $post['sik_status'] = 0;
            $post['bai_status'] = 0;
            $post['bast_status'] = 0;
            $data['id'] = $this->fdb->add($post);
            if ($data['id']) {
                $data['data_surat'] = $this->fdb->get_surat($data['id']);
                writelog('success', "Tambah Data Baru dengan id {$data['id']} Sukses.");
                flash_succ("Tambah Data Baru  Sukses.");
            } else {
                writelog('error', "Tambah Data Baru Gagal. Dari databasenya. ");
                flash_err('Tambah Data Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname.'/view/'.$data['id']));

        }

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Tambah';
        $data['content'] = 'pms_lan/pms_lan_form';
        
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }

    public function add_surat($id='') {

       if ($this->input->post()) {

            $post = $this->input->post();
            
            $this->form_validation->set_rules('jenis_surat', 'Jenis Surat', 'required');
            $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Surat Baru Gagal. " . validation_errors());
                flash_err('Tambah Surat Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add_surat/'.$id);
            }

            $jenis_surat = stringUrl($post['jenis_surat']);
            $jam = date("h-i-sa");
            $six_digit_random_number = mt_rand(10000, 99999);
            $post['tanggal'] = date("Y-m-d", strtotime($post['tanggal']));
            $fileName = $post['tanggal']."-".$jenis_surat."-".$jam.'-'.$six_digit_random_number;
            
            $config['upload_path'] = './uploads/surat/'; //buat folder dengan nama uploads di root folder
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'txt|pdf|doc|docx';
            $config['max_size'] = 100000;
             
            $this->load->library('upload');
            $this->upload->initialize($config);
             
            if(! $this->upload->do_upload('upload_surat') ){
            $error = array('error' => $this->upload->display_errors());
            
            $data = array('upload_data' => $this->upload->data('upload_surat'));
            

            }else{
               $data = array('upload_data' => $this->upload->data('upload_surat'));
                $file = $_FILES['upload_surat']['name'];
                $ext = substr(strrchr($file, '.'), 1);
                
                if($data){
                $post['link_file'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalinf/uploads/surat/' . $fileName.".".$ext;

                if($post['jenis_surat'] == 'smu'){
                    $post['smu_status'] = 1;
                    $post['smu_no'] = $post['nomor_surat'];
                    $post['smu_file'] = $post['link_file'];
                    $post['smu_tgl'] = $post['tanggal'];

                }elseif($post['jenis_surat'] == 'sku'){
                    $post['sku_status'] = 1;
                    $post['sku_no'] = $post['nomor_surat'];
                    $post['sku_file'] = $post['link_file'];
                    $post['sku_tgl'] = $post['tanggal'];


                }elseif($post['jenis_surat'] == 'suk'){
                    $post['suk_status'] = 1;
                    $post['suk_no'] = $post['nomor_surat'];
                    $post['suk_file'] = $post['link_file'];
                    $post['suk_tgl'] = $post['tanggal'];


                }elseif($post['jenis_surat'] == 'ip'){
                    $post['ip_status'] = 1; 
                    $post['ip_no'] = $post['nomor_surat'];
                    $post['ip_file'] = $post['link_file'];
                    $post['ip_nilai'] = $post['nilai'];
                    $post['ip_tgl'] = $post['tanggal'];


                }elseif($post['jenis_surat'] == 'sph'){
                    $post['sph_status'] = 1;
                    $post['sph_no'] = $post['nomor_surat'];
                    $post['sph_file'] = $post['link_file'];
                    $post['sph_tgl'] = $post['tanggal'];


                }elseif($post['jenis_surat'] == 'spk'){
                    $post['spk_status'] = 1;
                    $post['spk_no'] = $post['nomor_surat'];
                    $post['spk_file'] = $post['link_file'];
                    $post['spk_nilai'] = $post['nilai'];
                    $post['spk_provider'] = $post['provider'];
                    $post['spk_tgl'] = $post['tanggal'];


                }elseif($post['jenis_surat'] == 'sik'){
                    $post['sik_status'] = 1;
                    $post['sik_no'] = $post['nomor_surat'];
                    $post['sik_file'] = $post['link_file'];
                    $post['sik_tgl'] = $post['tanggal'];


                }
                unset($post['jenis_surat']);
                unset($post['tanggal']);
                unset($post['nomor_surat']);
                unset($post['link_file']);
                unset($post['nilai']);
                unset($post['provider']);

                $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Tambah Surat Baru dengan id {$id} Sukses.");
                    flash_succ("Tambah Surat Baru Sukses.");
                } else {
                    writelog('error', "Tambah Surat Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Surat Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname.'/view/'.$id));
                }
            }

        }

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Tambah Surat';
        $data['content'] = 'pms_lan/pms_lan_surat_form';
       
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }




    public function add_bai($id=''){
         if ($this->input->post()) {

            $post = $this->input->post();
            
            $this->form_validation->set_rules('bai_bri', 'PIC BRI', 'required');
            $this->form_validation->set_rules('bai_vendor', 'PIC VENDOR', 'required');
            $this->form_validation->set_rules('bai_tgl', 'Tanggal Pengerjaan', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Surat Baru Gagal. " . validation_errors());
                flash_err('Tambah Surat Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add_bai/'.$id);
            }

          
            $post['bai_tgl'] = date("Y-m-d", strtotime($post['bai_tgl']));
            $post['bai_ke_inf'] = date("Y-m-d", strtotime($post['bai_ke_inf']));    
            $post['bai_ke_provider'] = date("Y-m-d", strtotime($post['bai_ke_provider']));
            $post['bai_status'] = 1;
        
                
            $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Tambah BAI Baru dengan id {$id} Sukses.");
                    flash_succ("Tambah BAI Baru Sukses.");
                } else {
                    writelog('error', "Tambah BAI Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah BAI Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
            redirect(base_url($this->cname.'/view/'.$id));
        }
         

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Tambah BAI';
        $data['content'] = 'pms_lan/pms_lan_bai_form';
       
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }




    public function add_bast($id=''){
         if ($this->input->post()) {

            $post = $this->input->post();
            
           
            $this->form_validation->set_rules('bast_tgl', 'Tanggal Pengerjaan', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah BAST Gagal. " . validation_errors());
                flash_err('Tambah BAST Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add_bast/'.$id);
            }

          
            $post['bast_tgl'] = date("Y-m-d", strtotime($post['bai_tgl']));
           
            $post['bast_status'] = 1;
        
                
            $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Tambah BAST Baru dengan id {$id} Sukses.");
                    flash_succ("Tambah BAST Baru Sukses.");
                } else {
                    writelog('error', "Tambah BAST Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah BAST Baru Gagal. Mohon periksa kembali formulir wajib.');
                }
            redirect(base_url($this->cname.'/view/'.$id));
        }
         

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Tambah BAST';
        $data['content'] = 'pms_lan/pms_lan_bast_form';
       
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }


public function add_exclude($id=''){
         if ($this->input->post()) {

            $post = $this->input->post();
            
           
           
          
          
           
            $post['exclude_status'] = 1;
        
                
            $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Tambah exclude dengan id {$id} Sukses.");
                    flash_succ("Tambah exclude Sukses.");
                } else {
                    writelog('error', "Tambah exclude Gagal. Dari databasenya. ");
                    flash_err('Tambah exclude Gagal. Mohon periksa kembali formulir wajib.');
                }
            redirect(base_url($this->cname.'/view/'.$id));
        }
         

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Tambah exclude';
        $data['content'] = 'pms_lan/pms_lan_exclude_form';
       
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }


    protected function edit($id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('kanwil_divisi', 'Kanwil / Divisi', 'required');
            $this->form_validation->set_rules('kanca_bagian', 'Kanca / Bagian', 'required');
            $this->form_validation->set_rules('jenis', 'Jenis', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/view/'.$id);
            }


         
            $update = $this->fdb->update($id,$post);
            if ($update) {
              
                writelog('success', "Tambah Data Baru dengan id {$data['id']} Sukses.");
                flash_succ("Tambah Data Baru  Sukses.");
            } else {
                writelog('error', "Tambah Data Baru Gagal. Dari databasenya. ");
                flash_err('Tambah Data Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname.'/view/'.$id));

        }

        $data['title']   = 'PMS LAN';
        $data['active']  = 'pms lan';
        $this->fitur     = 'Ubah';
        $data['content'] = 'pms_lan/pms_lan_form';
        $data['pmslan_detail'] = $this->fdb->get_row($id);
        $data['data_surat'] = $this->fdb->get_surat($id);
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }





     public function view($id = '')
    {
        $data['title']         = 'PMS LAN';
        $data['active']        = 'pms lan';
        $this->fitur           = 'Lihat';
        $data['pmslan_detail'] = $this->fdb->get_row($id);
        $data['data_surat'] = $this->fdb->get_surat($id);
        $data['content'] = 'pms_lan/pms_lan_form';
        $data['plugins'] = array('popconfirm','datatables');

        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        $pmslan = $this->fdb->get_row($id);
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$pmslan->id}) Sukses.");
            flash_succ("Hapus Data Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$pmslan->id}) Gagal.");
            flash_err("Hapus  Ticket  Gagal.");
        }
        redirect(base_url($this->cname));
    }

     protected function delete_surat() {
        $id = $this->uri->segment(4);
        $jenis_surat = $this->uri->segment(5);

         if($jenis_surat == 'smu'){
                    $post['smu_status'] = 0;
                    $post['smu_no'] = '';
                    $post['smu_file'] = '';
                    $post['smu_tgl'] = '';

                }elseif($jenis_surat == 'sku'){
                    $post['sku_status'] = 0;
                    $post['sku_no'] = '';
                    $post['sku_file'] = '';
                    $post['sku_tgl'] = '';


                }elseif($jenis_surat == 'suk'){
                    $post['suk_status'] = 0;
                    $post['suk_no'] ='';
                    $post['suk_file'] = '';
                    $post['suk_tgl'] = '';


                }elseif($jenis_surat == 'ip'){
                    $post['ip_status'] = 0; 
                    $post['ip_no'] ='';
                    $post['ip_file'] = '';
                    $post['ip_nilai'] = '';
                    $post['ip_tgl'] = '';


                }elseif($jenis_surat == 'sph'){
                    $post['sph_status'] = 0;
                    $post['sph_no'] ='';
                    $post['sph_file'] = '';
                    $post['sph_tgl'] = '';


                }elseif($jenis_surat == 'spk'){
                    $post['spk_status'] = 0;
                    $post['spk_no'] ='';
                    $post['spk_file'] = '';
                    $post['spk_nilai'] = '';
                    $post['spk_provider'] = '';
                    $post['spk_tgl'] = '';


                }elseif($jenis_surat == 'sik'){
                    $post['sik_status'] = 0;
                    $post['sik_no'] ='';
                    $post['sik_file'] = '';
                    $post['sik_tgl'] = '';


                }
                

                $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Hapus surat dengan id {$id} Sukses.");
                    flash_succ("Hapus surat Sukses.");
                } else {
                    writelog('error', "Hapus surat Gagal. Dari databasenya. ");
                    flash_err('Hapus surat Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname.'/view/'.$id));
            
    }

    protected function delete_bai($id='') {
   
                $post['bai_status'] = 0;
                $post['bai_tgl'] = '';
                $post['bai_bri'] = '';
                $post['bai_vendor'] = '';
                $post['bai_ke_provider'] = '';
                $post['bai_ke_inf'] = '';


                $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Hapus bai dengan id {$id} Sukses.");
                    flash_succ("Hapus BAI Sukses.");
                } else {
                    writelog('error', "Hapus bai Gagal. Dari databasenya. ");
                    flash_err('Hapus BAI Gagal');
                }
                redirect(base_url($this->cname.'/view/'.$id));
            
    }

    protected function delete_bast($id='') {
   
                $post['bast_status'] = 0;
                $post['bast_tgl'] = '';
                $post['bast_ttd'] = '';
               

                $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Hapus bast dengan id {$id} Sukses.");
                    flash_succ("Hapus BAST Sukses.");
                } else {
                    writelog('error', "Hapus bast Gagal ");
                    flash_err('Hapus BAST Gagal');
                }
                redirect(base_url($this->cname.'/view/'.$id));
            
    }

     protected function delete_exclude($id='') {
   
                $post['exclude_status'] = 0;
               
               

                $update = $this->fdb->update($id,$post);
            if ($update) {
                    writelog('success', "Hapus exclude dengan id {$id} Sukses.");
                    flash_succ("Hapus exclude Sukses.");
                } else {
                    writelog('error', "Hapus exclude Gagal ");
                    flash_err('Hapus exclude Gagal');
                }
                redirect(base_url($this->cname.'/view/'.$id));
            
    }


   /////////////////////////////////////////////////// datatables /////////////////////////////////////////////////////

    public function ajax_list_pmslan()
    {
        $list = $this->fdb->get_datatables('pms_lan', array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id'=>'desc'));
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kanwil_divisi." / ".$list->kanca_bagian;
            $row[] = $list->jenis;

            if($list->smu_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->smu_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a  style='color:red;'  >
                                    on progress
                                </a>
                                

                            </td>";
            }
            if($list->sku_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->sku_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
            if($list->suk_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->suk_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
            if($list->ip_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->ip_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
             if($list->sph_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->sph_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
             if($list->spk_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->spk_no."
                                </a>
                                

                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
             if($list->sik_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->sik_no."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }
             if($list->bai_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->bai_tgl."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }

            if($list->bast_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->bast_tgl."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }

             if($list->exclude_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->keterangan_exclude."
                                </a>


                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                               -
                                

                            </td>";
            }


              $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'pms_lan/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'> </i>
                                </a>
                                <a title='Edit' href='".base_url().'pms_lan/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-orange'>
                                    <i class='fa fa-edit'> </i>
                                </a> 
                                <a title='Delete' data-href='".base_url().'pms_lan/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                                </a>

                            </td>";
            



           
            // $row[] = " <td style='text-align:center' width='140px'>
                               
            //                     <a title='Detail' data-href='".base_url().'data_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-primary' data-toggle='modal' data-target='.detail-modal'>
            //                         <i class='fa fa-file'></i>
            //                     </a>


            //                 </td>";

            
                
               
           
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fdb->count_all('pms_lan', array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id'=>'asc')),
                        "recordsFiltered" => $this->fdb->count_filtered('pms_lan', array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id','kanwil_divisi','kanca_bagian','jenis','smu_no','sku_no','suk_no','ip_no','sph_no','spk_no','sik_no','bai_tgl','bast_tgl','keterangan_exclude'), array('id'=>'asc')),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    
}
