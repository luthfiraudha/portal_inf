<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pakai_anggaran extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_pakai_anggaran', 'fdb');
        $this->cname = 'pakai_anggaran';
        $this->menu = 'Pakai Anggaran';
        $this->fitur = '';

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
        $data['title'] = 'Pakai Anggaran';
        $data['active'] = 'pakai_anggaran';
        $this->fitur = 'Daftar';
        $data['content'] = 'pakai_anggaran/pakai_anggaran_list';
        $data['plugins'] = array('datatables','daterangepicker','pakaianggaran');
       
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('id_anggaran', 'Nama Anggaran', 'required');
         

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            $jenis_surat = 'ijin_prinsip';
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
                $post['link_surat'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalinf/uploads/surat/' . $fileName.".".$ext;


                $query=$this->fdb->get_nilai_anggaran($post['id_anggaran']);
                $query2=$this->fdb->get_nilai_pakai($post['id_anggaran']);

                // echo var_dump($query);die;
               
                foreach ($query as $row){
                     $hasil_a=$row->nilai_anggaran;
                }
                
                foreach ($query2 as $row){
                     $hasil_b=$row->total_pakai;
                }
                   
                $hasil = $hasil_a - $hasil_b;

                    if($hasil > 0){
                         $add = $this->fdb->add($post);
                        if ($add) {
                            writelog('success', "Tambah data pakai anggaran dengan id {$data['id']} Sukses.");
                            flash_succ("Tambah data pakai anggaran Sukses.");
                        } else {
                            writelog('error', "Tambah data pakai anggaran Gagal. Dari databasenya. ");
                            flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.');
                        }
                    }else{
                        writelog('error', "Anggaran kurang ");
                        flash_err('Anggaran Kurang. Dana pengajuan tidak boleh melebihi sisa anggaran.');
                          redirect(base_url($this->cname.'/add'));
                    }
                       
                
                }else{
                    writelog('error', "Tambah data pakai anggaran Gagal. Dari upload data. ");
                    flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.');
                  

                }
                redirect(base_url($this->cname));

            }


           
           

        }

        $data['title']   = 'Pakai Anggaran';
        $data['active']  = 'Pakai anggaran';
        $this->fitur     = 'Tambah';
        $data['pos_anggaran'] = $this->fdb->get_anggaran();
        $data['content'] = 'pakai_anggaran/pakai_anggaran_form';
        
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    

    protected function edit($id = '') {
          if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('id_anggaran', 'Nama Anggaran', 'required');
         

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            if(isset($post['yesno'])){
                $jenis_surat = 'ijin_prinsip';
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
                    $post['link_surat'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalinf/uploads/surat/' . $fileName.".".$ext;

                    $query=$this->fdb->get_nilai_anggaran($post['id_anggaran']);
                    $query2=$this->fdb->get_nilai_pakai($post['id_anggaran']);

                    foreach ($query as $row){
                         $hasil_a=$row->nilai_anggaran;
                    }
                    
                    foreach ($query2 as $row){
                         $hasil_b=$row->total_pakai;
                    }
                       
                    $hasil = $hasil_a - $hasil_b;

                        if($hasil > 0){
                            unset($post['yesno']);
                            $update = $this->fdb->update($id,$post);
                            if ($update) {
                                writelog('success', "Tambah data pakai anggaran dengan id {$data['id']} Sukses.");
                                flash_succ("Tambah data pakai anggaran Sukses.");
                            } else {
                                writelog('error', "Tambah data pakai anggaran Gagal. Dari databasenya. ");
                                flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.');
                            }
                        }else{
                           
                            writelog('error', "Anggaran kurang ");
                            flash_err('Anggaran Kurang. Dana pengajuan tidak boleh melebihi sisa anggaran.');
                              
                        }
                           
                    }else{

                      
                        writelog('error', "Tambah data pakai anggaran Gagal. Dari upload data. ");
                        flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.'); 
                    }
                }
                redirect(base_url($this->cname));



            }else{


                $query=$this->fdb->get_nilai_anggaran($post['id_anggaran']);
                    $query2=$this->fdb->get_nilai_pakai($post['id_anggaran']);

                    foreach ($query as $row){
                         $hasil_a=$row->nilai_anggaran;
                    }
                    
                    foreach ($query2 as $row){
                         $hasil_b=$row->total_pakai;
                    }
                       
                    $hasil = $hasil_a - $hasil_b;

                        if($hasil > 0){
                            unset($post['yesno']);
                            unset($post['uppload_surat']);
                            $update = $this->fdb->update($id,$post);
                            if ($update) {
                                writelog('success', "Tambah data pakai anggaran dengan id {$data['id']} Sukses.");
                                flash_succ("Tambah data pakai anggaran Sukses.");
                            } else {
                                writelog('error', "Tambah data pakai anggaran Gagal. Dari databasenya. ");
                                flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.');
                            }
                        }else{
                           
                            writelog('error', "Anggaran kurang ");
                            flash_err('Anggaran Kurang. Dana pengajuan tidak boleh melebihi sisa anggaran.');
                        }

                         redirect(base_url($this->cname));

            }
                $jenis_surat = 'ijin_prinsip';
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
                    $post['link_surat'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalinf/uploads/surat/' . $fileName.".".$ext;

                    $query=$this->fdb->get_nilai_anggaran($post['id_anggaran']);
                    $query2=$this->fdb->get_nilai_pakai($post['id_anggaran']);

                    foreach ($query as $row){
                         $hasil_a=$row->nilai_anggaran;
                    }
                    
                    foreach ($query2 as $row){
                         $hasil_b=$row->total_pakai;
                    }
                       
                    $hasil = $hasil_a - $hasil_b;

                        if($hasil > 0){
                            $update = $this->fdb->update($id,$post);
                            if ($update) {
                                writelog('success', "Tambah data pakai anggaran dengan id {$data['id']} Sukses.");
                                flash_succ("Tambah data pakai anggaran Sukses.");
                            } else {
                                writelog('error', "Tambah data pakai anggaran Gagal. Dari databasenya. ");
                                flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.');
                            }
                        }else{
                           
                            writelog('error', "Anggaran kurang ");
                            flash_err('Anggaran Kurang. Dana pengajuan tidak boleh melebihi sisa anggaran.');
                              
                        }
                           
                    }else{

                      
                        writelog('error', "Tambah data pakai anggaran Gagal. Dari upload data. ");
                        flash_err('Tambah data pakai anggaran Gagal. Mohon periksa kembali formulir wajib.'); 
                    }
                }
            redirect(base_url($this->cname));


        }

        $data['title']   = 'Pakai Anggaran';
        $data['active']  = 'pakai_anggaran';
        $this->fitur     = 'Ubah';
        $data['content'] = 'pakai_anggaran/pakai_anggaran_form';
          $data['pos_anggaran'] = $this->fdb->get_anggaran();
        $data['pakai_anggaran_detail'] = $this->fdb->get_row($id);
        $data['plugins'] = array('daterangepicker','popconfirm');
        $this->load->view('template', $data);
    }



     public function view($id = '')
    {
        $data['title']         = 'Pakai Angaran';
        $data['active']        = 'pakai_anggaran';
        $this->fitur           = 'Lihat';
        $data['pakai_anggaran_detail'] = $this->fdb->get_row($id);
        $data['content'] = 'pakai_anggaran/pakai_anggaran_form';
        $data['plugins'] = array('popconfirm','datatables');

        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        $pmslan = $this->fdb->get_row($id);
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$pmslan->id}) Sukses.");
            flash_succ("Hapus Ticket  Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$pmslan->id}) Gagal.");
            flash_err("Hapus  Ticket  Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function ajax_ceknilai(){
         $kode=$this->input->post('id_anggaran',TRUE);
        
        $query=$this->fdb->get_nilai_anggaran($kode);
        $query2=$this->fdb->get_nilai_pakai($kode);

        // echo var_dump($query);die;
       
        foreach ($query as $row){
             $hasil_a=$row->nilai_anggaran;
        }
        
        foreach ($query2 as $row){
             $hasil_b=$row->total_pakai;
        }
           
        $hasil = $hasil_a - $hasil_b;
        echo $hasil; 
    }
    


   /////////////////////////////////////////////////// datatables /////////////////////////////////////////////////////

    public function ajax_list_pakaianggaran()
    {
        $list = $this->fdb->get_datatables('pakai_anggaran', array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array('id'=>'desc'));
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_anggaran;
            $row[] = $list->kanwil_divisi;
            $row[] = $list->kanca_bagian;
            $row[] = $list->judul_ip;
            $row[] = $list->pengirim;
            $row[] = $list->nilai;
            $row[] = $list->tanggal;
            $row[] = "<td  style='text-align: center;' >  <a title='Download' href='".$list->link_surat."' class='btn btn-circle btn-sm bg-purple' target='_blank'>
                                    <i class='fa fa-download'> </i>
                                </a></td>";


           


              $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'pakai_anggaran/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'> </i>
                                </a>
                                <a title='Edit' href='".base_url().'pakai_anggaran/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-orange'>
                                    <i class='fa fa-edit'> </i>
                                </a> 
                                <a title='Delete' data-href='".base_url().'pakai_anggaran/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                                </a>

                            </td>";
            



               
           
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fdb->count_all('pakai_anggaran', array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array('id'=>'desc')),
                        "recordsFiltered" => $this->fdb->count_filtered('pakai_anggaran', array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array(null,'nama_anggaran','kanwil_divisi','kanca_bagian','pengirim','judul_ip','nomor_surat','link_surat','keperluan','tanggal','nilai'), array('id'=>'desc')),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }




    public function tes(){
        echo uniqid();

        echo '</br>';
        $six_digit_random_number = mt_rand(100000, 999999);
        echo date('Ymd',now()).$six_digit_random_number;
    }

    
}
