<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daily_issue extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_daily', 'fdb');
        $this->load->model('m_kategori_issue', 'k_fdb');
        $this->load->model('m_mdsc', 'mdsc');
        $this->load->model('m_data_job', 'job');
        $this->cname = 'daily_issue';
        $this->menu = 'Daily Activity';
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
        $data['title'] = 'Daily Activity';
        $data['active'] = 'data_issue';
        $this->fitur = 'Daftar';
        $data['content'] = 'daily_list';
        $data['plugins'] = array('datatables','daterangepicker','kategori_suggest','ticket_source');
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();
             // $post['isi'] = $post['files']." ".$post['isi'];
            unset($post['files']);
           
            $post['status'] = "selesai"; 
         
            //unset($post['user_nama']);
            // $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            // $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('user_id', 'Nama', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Issue Baru Gagal. " . validation_errors());
                flash_err('Tambah Issue Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);
            $cek_app = $this->mdsc->cek_app($post['nama_app']);
            $cek_job = $this->job->cek_job($post['job_nama']);
            $cek_fitur = $this->mdsc->cek_fitur($post['nama_fitur']);

           
            if (!$cek_kategori && !$cek_job) {
                
                // $kategori_id = $this->k_fdb->add($post['kategori_nama']);

                // if ($kategori_id) {
                //     $post['kategori_id'] = $kategori_id;
                //     if($post['type'] == 'Daily Activity'){
                //      date_default_timezone_set("Asia/Jakarta");
                //      $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                //      $post['tgl_input'] = $stringtgl2;
                    
                //     }
                //     unset($post['kategori_nama']);
                //     $data['id'] = $this->fdb->add($post);
                //     if ($data['id']) {
                //         writelog('success', "Tambah Ticket Baru dengan id {$data['id']} Sukses.");
                //         flash_succ("Tambah  Ticket Baru `{$data['id']}` Sukses.");
                //     } else {
                //         writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                //         flash_err('Tambah Ticket Baru Gagal. Mohon periksa kembali formulir wajib.');
                //     }
                // } else {

                //     writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                //     flash_err('Tambah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                // }

                writelog('error', "Tambah ticket Baru Gagal. Kategori tidak ada di database. ");
                flash_err('Tambah ticket Baru Gagal. Kategori tidak ada di database.');
            } else if ($cek_kategori && $cek_job && $post['kategori_nama'] != '' && $post['job_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }
                //  if($post['type'] == 'Daily Activity'){
                //     date_default_timezone_set("Asia/Jakarta");
                //      $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                //      $post['tgl_input'] = $stringtgl2;
                    
                // }
               // unset($post['kategori_nama']);
                date_default_timezone_set("Asia/Jakarta");
                $tanggal = date("Y-m-d", strtotime($post['tanggal']));
                $post['tanggal'] = $tanggal;
                $post['jam_mulai'] = date("H:i", strtotime($post['jam_mulai']));
                $post['jam_selesai'] = date("H:i", strtotime($post['jam_selesai']));

                $a = $post['jam_mulai'];
                $b = $post['jam_selesai'];

                if($a >= date("H:i", strtotime("12:00")) && $b <= date("H:i", strtotime("12:00"))){
                    $tem1 = date("H:i", strtotime("23:59"));
                    $interval1 = (((strtotime($tem1) - strtotime($a)))/60);
                  
                    $hours = floor($interval1 / 60).':'.($interval1 -   floor($interval1 / 60) * 60);
                    $jam_selesai = (((strtotime($hours) + strtotime($b)))/60);
                    $post['jam_selisih'] = date("H:i", strtotime($jam_selesai));
                    

                }else{
                    $interval1 = (((strtotime($b) - strtotime($a)))/60);
                  
                    $jam_selesai = floor($interval1 / 60).':'.($interval1 -   floor($interval1 / 60) * 60);
                     
                   
                    $post['jam_selisih'] = date("H:i", strtotime($jam_selesai));
                       
                }



                $data['issue_id'] = $this->fdb->add($post);
                if ($data['issue_id']) {
                    writelog('success', "Tambah Ticket Baru dengan id {$data['id']} Sukses.");
                    flash_succ("Tambah  Ticket Baru `{$data['id']}` Sukses.");
                } else {
                    writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                }
            }

            redirect(base_url($this->cname));
        }

         $maxticket = $this->fdb->selectmaxid();

        if($maxticket->max_id == NULL){
            $value = '1';
        }else{
            $temid = $maxticket->max_id;
           
            $value = explode('-', $temid);

            (int)$value = (int)$value[1] + 1;
        }

        date_default_timezone_set("Asia/Jakarta");
        $str1 = date("YmdHi");
        $str2 = str_pad($value, 8, '0', STR_PAD_LEFT);
         
        $tnum = $str1."DAI-".$str2;

        $data['idx'] = $tnum;


        $data['title'] = 'Daily';
        $data['active'] = 'daily_issue';
        $this->fitur = 'Tambah';
        $this->fitur2 = '';
        $data['content'] = 'daily_form';
        $data['kategori'] = $this->k_fdb->get_all();
        $data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','kategori_suggest','summernote','ticket_source');

        $this->load->view('template', $data);
    }

    protected function edit($id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();
             //$post['isi'] = $post['files']." ".$post['isi'];
            unset($post['files']);
            $id = $post['id'];
            unset($post['user_nama']);
            // $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            // $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('user_id', 'Nama', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Issue  id {$id} Gagal. " . validation_errors());
                flash_err("Ubah Issue `{$id}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id));
            }

            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);
            $cek_app = $this->mdsc->cek_app($post['nama_app']);
            $cek_fitur = $this->mdsc->cek_fitur($post['nama_fitur']);

           
            if (!$cek_kategori) {
                
                // $kategori_id = $this->k_fdb->add($post['kategori_nama']);


                // if ($kategori_id) {
                //     $post['kategori_id'] = $kategori_id;
                //     if($post['type'] == 'Daily Activity'){
                //      date_default_timezone_set("Asia/Jakarta");
                //      $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                //      $post['tgl_input'] = $stringtgl2;
                    
                // }
                //     unset($post['kategori_nama']);
                //     $result = $this->fdb->update($id, $post);

                //     if ($result === false) {
                //         writelog('error', "Ubah Ticket id {$id} Gagal.");
                //         flash_err("Ubah Ticket '{$post['id']}' Gagal. Periksa kembali formulir wajib.");
                //     } else {
                //         if ($result > 0) {
                //             writelog('success', "Ubah Ticket id {$id} Sukses.");
                //             flash_succ("Ubah Ticket '{$id}' Sukses.");
                //         } else {
                //             writelog('warning', "Ubah Ticket id {$id} Gagal. Tidak ada data yang berubah.");
                //             flash_warn("Ubah Ticket Gagal. Tidak ada data yang berubah.");
                //         }
                //     }
                // } else {

                //     writelog('error', "Ubah Ticket Baru Gagal. Dari databasenya. ");
                //     flash_err('Ubah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                // }
                 writelog('error', "Tambah ticket Baru Gagal. Kategori tidak ada di database. ");
                flash_err('Tambah ticket Baru Gagal. Kategori tidak ada di database.');
            }else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }

                 if($post['type'] == 'Daily Activity'){
                     date_default_timezone_set("Asia/Jakarta");
                     $stringtgl2 = date("Y-m-d")." ".date('H:m:s');

                     $post['tgl_input'] = $stringtgl2;
                    
                }
                unset($post['kategori_nama']);
                $result = $this->fdb->update($issue_id, $post);

                if ($result === false) {
                    writelog('error', "Ubah Ticket id {$id} Gagal.");
                    flash_err("Ubah Ticket '{$post['id']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah Ticket id {$id} Sukses.");
                        flash_succ("Ubah Ticket '{$id}' Sukses.");
                    } else {
                        writelog('warning', "Ubah Ticket id {$issue_id} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah Ticket Gagal. Tidak ada data yang berubah.");
                    }
                }
            }

            redirect(base_url($this->cname));
        }

        $data['title'] = 'Daily';
        $data['active'] = 'daily_issue';
        $this->fitur = 'Ubah';
        $data['kategori'] = $this->k_fdb->get_all();
        $data['issue_detail'] = $this->fdb->get_row($issue_id);
        $data['issue'] = $this->fdb->get_all();
        $data['content'] = 'daily_form';
        $data['plugins'] = array('popconfirm','daterangepicker','kategori_suggest','summernote','ticket_source');

        $this->load->view('template', $data);
    }

 
     protected function view($id = '',$from = NULL) {
       
        $data['title'] = 'Daily';
        $data['active'] = 'daily_issue';
        $this->fitur = 'Lihat';
        $this->fitur2 = 'Jawaban';
        $data['content'] = 'daily_form';
        $data['plugins'] = array();
        $data['issue_detail'] = $this->fdb->get_row($id);
       
        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        //$answer = $this->fdb->get_answer($id);
        $issue = $this->fdb->get_row($id);
        // if($answer != NULL){
        //     foreach ($answer as $answer) {
        //          $this->fdb->delete_answer($answer->id);
        //     }
        // }
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$issue->id}) Sukses.");
            flash_succ("Hapus Ticket  '{$issue->id}' Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$issue->id}) Gagal.");
            flash_err("Hapus  Ticket  '{$issue->id}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    ///////////////////////////////////////////////// ajax //////////////////////////////////////////////
    

    public function ajax_list_daily()
    {
        $list = $this->fdb->get_datatables_daily('data_daily', array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id'=>'desc'));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $list->id;
            $row[] = $list->shift;
            $row[] = $list->user_nama;
            $row[] = $list->tanggal;
            $row[] = date("h:i", strtotime($list->jam_mulai)); ;
            $row[] = date("h:i", strtotime($list->jam_selesai)); 
            $row[] = date("h:i", strtotime($list->jam_selisih)); 
            $row[] = $list->nama_app;
            $row[] = $list->nama_fitur;
            $row[] = $list->job_nama;
            $row[] = $list->kategori_nama;
           
            $string = strip_tags($list->isi);
            // if (strlen($string) > 50) {
            //      // truncate string
            // $stringCut = substr($string, 0, 50);

            //  // make sure it ends in a word so assassinate doesn't become ass...
            // $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
            // }
            $row[] = $string;
            $row[] = $list->jumlah;
            // if ($list->status == "belum selesai" ) {
            //   $row[] =    "<i class='btn btn-xs bg-red'>belum selesai</i>";
            // } elseif ($list->status == "selesai") {
            //   $row[] =    "<i class='btn btn-xs bg-green'>selesai</i>";
            // }

            if ($this->active_privilege == "superadmin" ){
                if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                        <a title='Edit' href='".base_url().'daily_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
                            <i class='fa fa-edit'></i>
                        </a> 
                        <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
                }else{

                $row[] = "<td style='text-align:center' width='140px'>
                        <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                            <i class='fa fa-folder'></i>
                        </a>
                      
                        <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                            <i class='fa fa-trash'></i>
                        </a>

                    </td>";
                }

             }elseif( (($this->active_privilege == "signer") || ($this->active_privilege == "checker") || ($this->active_privilege== "maker") )) { 
                if($this->active_user == $list->user_nama){
                        if($list->status == "belum dikerjakan" || $list->status == "belum dikoreksi" ){

                        $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'></i>
                                </a>
                                <a title='Edit' href='".base_url().'daily_issue/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-blue'>
                                    <i class='fa fa-edit'></i>
                                </a> 
                                <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'></i>
                                </a>

                            </td>";
                        }else{

                        $row[] = "<td style='text-align:center' width='140px'>
                                    <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                        <i class='fa fa-folder'></i>
                                    </a>
                                
                                    <a title='Delete' data-href='".base_url().'daily_issue/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                        <i class='fa fa-trash'></i>
                                    </a>

                                </td>";
                        }

                    } else{

                    $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'daily_issue/action/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'></i>
                                </a>
                               

                            </td>";
               }
           }
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fdb->count_all_daily('data_daily',array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id'=>'asc')),
                        "recordsFiltered" => $this->fdb->count_filtered_daily('data_daily', array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id','shift', 'user_nama','tanggal', 'jam_mulai','jams_selesai','jam_selisih','nama_app','nama_fitur','job_nama' ,'kategori_nama','isi','jumlah'), array('id'=>'asc')),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


}
