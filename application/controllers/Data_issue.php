<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_issue extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_issue', 'fdb');
        $this->load->model('m_kategori_issue', 'k_fdb');
        $this->load->model('m_mdsc', 'mdsc');
        $this->load->model('m_data_sop', 'sop');
        $this->cname = 'data_issue';
        $this->menu = 'Ticket';
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
        $data['content'] = 'data_issue_list';
        $data['plugins'] = array('datatables','daterangepicker','kategori_suggest','ticket_source');
       // $data['issue'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();
            //unset($post['files']);
            if($post['type']!="Daily Activity"){
                $post['status'] = "belum dikerjakan"; 
              }else{
                $post['status'] = "selesai"; 
                $post['pinned'] =0;
              }

            //$post['isi'] = $post['files']." ".$post['isi'];
            unset($post['files']);
         
            unset($post['user_nama']);
            // $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            // $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_rules('id', 'ID TICKET', 'required');
            if($post['type']!='Daily Activity'){
            $this->form_validation->set_rules('tgl', 'Tangal', 'required');
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            }

     
            $this->form_validation->set_rules('isi', 'isi', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Ticket Baru Gagal. " . validation_errors());
                flash_err('Tambah Ticket Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);
            $cek_app = $this->mdsc->cek_app($post['nama_app']);
            $cek_fitur = $this->mdsc->cek_fitur($post['nama_fitur']);

     

            if (!$cek_kategori) {
                
                // $post['kategori_nama'] = strtolower($post['kategori_nama']);
                // $kategori_id = $this->k_fdb->add($post['kategori_nama']);


                // if ($kategori_id) {
                //     $post['kategori_id'] = $kategori_id;
                //      if($post['type'] == 'Daily Activity'){
                //      date_default_timezone_set("Asia/Jakarta");
                //      $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                //      $post['tgl_input'] = $stringtgl2;
                        
                //     }else{

                //         date_default_timezone_set("Asia/Jakarta");
                //         $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
                //         $post['tgl_input'] = $stringtgl;
                //     }
                    
                //     unset($post['jam']);
                //     unset($post['tgl']);
                //     unset($post['kategori_nama']);
                //     $add = $this->fdb->add($post);

                //     if ($add) {
                //         writelog('success', "Tambah Ticket Baru dengan id {$post['id']} Sukses.");
                //         flash_succ("Tambah  Ticket Baru `{$post['id']}` Sukses.");
                //     } else {
                //         writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                //         flash_err('Tambah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                //     }
                // } else {

                //     writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                //     flash_err('Tambah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                // }

                writelog('error', "Tambah ticket Baru Gagal. Kategori tidak ada di database. ");
                flash_err('Tambah ticket Baru Gagal. Kategori tidak ada di database.');
            } else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }
                if($post['type'] == 'Daily Activity'){
                     date_default_timezone_set("Asia/Jakarta");
                     $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                     $post['tgl_input'] = $stringtgl2;
                    
                }else{
                    date_default_timezone_set("Asia/Jakarta");
                    $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
                    $post['tgl_input'] = $stringtgl;
                }
                
                unset($post['jam']);
                unset($post['tgl']);
               
                unset($post['kategori_nama']);
                $add = $this->fdb->add($post);
                if ($add) {
                    writelog('success', "Tambah Ticket Baru dengan id {$post['id']} Sukses.");
                    flash_succ("Tambah  Ticket Baru `{$post['id']}` Sukses.");
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
        $str1 = date("YmdHis");
        $str2 = str_pad($value, 5, '0', STR_PAD_LEFT);
         
        $tnum = $str1."-".$str2;

        $data['idx'] = $tnum;

        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur = 'Tambah';
        $this->fitur2 = '';
        $data['content'] = 'data_issue_form';

        $data['kategori'] = $this->k_fdb->get_all();
        $data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','kategori_suggest','ticket_source','summernote');

        $this->load->view('template', $data);
    }

    protected function edit($issue_id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();
             //$post['isi'] = $post['files']." ".$post['isi'];
            unset($post['files']);
            $issue_id = $post['id'];
            unset($post['user_nama']);
            // $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
            // $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_rules('id', 'ID TICKET', 'required');
            $this->form_validation->set_rules('tgl', 'Tangal', 'required');
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            $this->form_validation->set_rules('isi', 'isi', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Issue  id {$issue_id} Gagal. " . validation_errors());
                flash_err("Ubah Issue `{$post['issue_judul']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $issue_id));
            }
            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);
             $cek_app = $this->mdsc->cek_app($post['nama_app']);
            $cek_fitur = $this->mdsc->cek_fitur($post['nama_fitur']);

           
            if (!$cek_kategori) {
                
                // $kategori_id = $this->k_fdb->add($post['kategori_nama']);

                // if ($kategori_id) {
                //     $post['kategori_id'] = $kategori_id;
                //      if($post['type'] == 'Daily Activity'){
                //      date_default_timezone_set("Asia/Jakarta");
                //      $stringtgl2 = date("Y-m-d")." ".date('H:m:s');
                //      $post['tgl_input'] = $stringtgl2;
                        
                //     }else{
                //         $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
                //         $post['tgl_input'] = $stringtgl;
                //     }
                    
                //     unset($post['jam']);
                //     unset($post['tgl']);
                //     unset($post['kategori_nama']);
                //     $result = $this->fdb->update($issue_id, $post);

                //     if ($result === false) {
                //         writelog('error', "Ubah Ticket id {$issue_id} Gagal.");
                //         flash_err("Ubah Ticket '{$post['id']}' Gagal. Periksa kembali formulir wajib.");
                //     } else {
                //         if ($result > 0) {
                //             writelog('success', "Ubah Ticket id {$issue_id} Sukses.");
                //             flash_succ("Ubah Ticket '{$post['id']}' Sukses.");
                //         } else {
                //             writelog('warning', "Ubah Ticket id {$issue_id} Gagal. Tidak ada data yang berubah.");
                //             flash_warn("Ubah Ticket Gagal. Tidak ada data yang berubah.");
                //         }
                //     }
                // } else {

                //     writelog('error', "Ubah Ticket Baru Gagal. Dari databasenya. ");
                //     flash_err('Ubah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                // }
                writelog('error', "Tambah ticket Baru Gagal. Kategori tidak ada di database. ");
                flash_err('Tambah ticket Baru Gagal. Kategori tidak ada di database.');
            }  else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }
                 if($post['type'] == 'Daily Activity'){
                     date_default_timezone_set("Asia/Jakarta");
                     $stringtgl2 = date("Y-m-d")." ".date('H:i:s');
                     $post['tgl_input'] = $stringtgl2;
                    
                }else{
                    $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
                    $post['tgl_input'] = $stringtgl;
                }
                
                unset($post['jam']);
                unset($post['tgl']);
                unset($post['kategori_nama']);
                $result = $this->fdb->update($issue_id, $post);

                if ($result === false) {
                    writelog('error', "Ubah Ticket id {$issue_id} Gagal.");
                    flash_err("Ubah Ticket '{$post['id']}' Gagal. Periksa kembali formulir wajib.");
                } else {
                    if ($result > 0) {
                        writelog('success', "Ubah Ticket id {$issue_id} Sukses.");
                        flash_succ("Ubah Ticket '{$post['id']}' Sukses.");
                    } else {
                        writelog('warning', "Ubah Ticket id {$id} Gagal. Tidak ada data yang berubah.");
                        flash_warn("Ubah Ticket Gagal. Tidak ada data yang berubah.");
                    }
                }
            }

            redirect(base_url($this->cname));
        }

        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur = 'Ubah';
        $data['kategori'] = $this->k_fdb->get_all();
        $data['issue_detail'] = $this->fdb->get_row($issue_id);
        $data['issue'] = $this->fdb->get_all();
        $data['content'] = 'data_issue_form';
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest','ticket_source','summernote');

        $this->load->view('template', $data);
    }

    


     protected function view($id = '',$from = NULL) {
        //$id = decode($id);
        $jumlah_data = $this->fdb->jumlah_data_answer($id);
    
        
        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'offset';

        $config['base_url'] = base_url($this->cname)."/action/view/".$id;
        // add the category if it's set
        if (!is_null($from)) 
            $config['base_url'] = $config['base_url'].'/'.$from;

        // make segment based URL ready to add query strings
        // pagination library does not care if a ? is available
        $config['base_url'] = $config['base_url'].'/?';



       
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 4;
       // $from = $this->uri->segment(5);
     
        // CSS Bootstrap               
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                // Akhir CSS

        $this->pagination->initialize($config);     
        $offset = $this->input->get('offset');
        $data['issue_answer'] = $this->fdb->data_answer($id,$config['per_page'],$offset);
        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur = 'Lihat';
        $this->fitur2 = 'Jawaban';
        $data['content'] = 'data_issue_form';
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');
        $data['issue_detail'] = $this->fdb->get_row($id);
        //$data['issue_answer'] = $this->fdb->get_answer($id);
        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        $answer = $this->fdb->get_answer($id);
        $issue = $this->fdb->get_row($id);
        if($answer != NULL){
            foreach ($answer as $answer) {
                 $this->fdb->delete_answer($answer->id);
            }
        }
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$issue->id}) Sukses.");
            flash_succ("Hapus Ticket  '{$issue->issue_id}' Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$issue->id}) Gagal.");
            flash_err("Hapus  Ticket  '{$issue->id}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    protected function add_answer($id = '') {

        if ($this->input->post()) {
            $post = $this->input->post();
            $post['record_id'] = $id;
            $post['correct'] = "tepat";
            unset($post['user_nama']);

            $this->form_validation->set_rules('user_id', 'Nama', 'required');
           
            $this->form_validation->set_rules('tgl', 'Tangal', 'required');
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            $this->form_validation->set_rules('isi', 'isi', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah tindakan dengan issue user {$user_id} Gagal. " . validation_errors());
                flash_err("Tambah tindakan dengan issue user `{$post['user_id']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/view/' . $id));
            }

            $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
            unset($post['tgl']);
            unset($post['jam']);
            $post['tgl_sol'] = $stringtgl;

            $post2['status'] = 'selesai';
            $updaterecord = $this->fdb->update($id, $post2);
            $data['answer_id'] = $this->fdb->add_answer($post);

            if ($data['answer_id']) {
                writelog('success', "Tambah tindakan Baru dengan id {$data['answer_id']} Sukses.");
                flash_succ("Tambah  tindakan Baru `{$post['answer']}` Sukses.");
            } else {
                writelog('error', "Tambah tindakan Baru Gagal. Dari databasenya. ");
                flash_err('Tambah tindakan Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname . '/action/view/' . $id));
        }

        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur2 = 'Tambah Jawaban';
        $data['issue_id'] = $id;
        $data['answer_detail'] = $this->fdb->get_row($id);
        $data['content'] = 'data_answer_form';
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');

        $this->load->view('template', $data);
    }

    protected function view_answer($id = '') {
        $data['title'] = 'Ticket Tindak Lanjut';
        $data['active'] = 'data_issue';
        $this->fitur2 = 'Lihat Jawaban';
        $data['content'] = 'data_answer_form';
        $data['plugins'] = array();
        $data['answer_detail'] = $this->fdb->get_answer_row($id);
        $this->load->view('template', $data);
    }

    protected function edit_answer($id = '') {

        if ($this->input->post()) {
            $post = $this->input->post();
            $answer_id = $post['id'];
            unset($post['user_nama']);

            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_rules('tgl', 'Tangal', 'required');
            $this->form_validation->set_rules('jam', 'Jam', 'required');
            $this->form_validation->set_rules('isi', 'isi', 'required');
            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah tindakan dengan issue user {$user_id} Gagal. " . validation_errors());
                flash_err("Ubah tindakan dengan issue user `{$post['user_id']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/view/' . $id));
            }

            $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:i:s", strtotime($post['jam']));
            unset($post['tgl']);
            unset($post['jam']);
            $post['tgl_sol'] = $stringtgl;
 
            $result = $this->fdb->update_answer($answer_id, $post);

            if ($result === false) {
                writelog('success', "Ubah tindakan dengan id {$data['id']} Sukses.");
                flash_succ("Ubah tindakan `{$post['id']}` Sukses.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah tindakan id {$id} Sukses.");
                    flash_succ("Ubah tindakan '{$post['id']}' Sukses.");
                } else {
                    writelog('warning', "Ubah tindakan id {$id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah tindakan Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname . '/action/view/' . $id));
        }

        $data['title'] = 'Ticket Tindak Lanjut';
        $data['active'] = 'data_issue';
        $this->fitur2 = 'Ubah Jawaban';
        $data['answer_detail'] = $this->fdb->get_answer_row($id);
        $data['content'] = 'data_answer_form';
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');

        $this->load->view('template', $data);
    }

    protected function delete_answer($id = 0) {
        $answer = $this->fdb->get_answer_row($id);
        $result = $this->fdb->delete_answer($id);
        if ($result) {
            writelog('success', "Hapus tindakan id ({$answer->id}) Sukses.");
            flash_succ("Hapus tindakan  '{$answer->id}' Sukses.");
        } else {
            writelog('error', "Hapus tindakan id ({$answer->id}) Gagal.");
            flash_err("Hapus  tindakan '{$answer->id}' Gagal.");
        }
        redirect(base_url($this->cname . '/action/view/' . $answer->record_id));
    }

    public function add_answer_modal() {
        $this->fitur2 = $this->input->post('fitur');
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');
        $this->load->view('content/content_modal_form_answer',$data);
    }

    public function edit_answer_modal() {
        $id= $this->input->post('id');

        $this->fitur2 = 'Ubah Jawaban';
        $data['answer_detail'] = $this->fdb->get_answer_row($id);
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');
        $this->load->view('content/content_modal_form_answer',$data);
    }

    public function getallkategori(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->k_fdb->suges_kategori($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->kategori_nama;
        echo json_encode($json_array);    
    }








    //----------------------- create SOP ---------------------//

    public function createsop($id = 0,$from=NULL){
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
                redirect(base_url($this->cname) . '/createsop/'.$id);
            }
            unset($post['id']);

            $sop_name = stringUrl($post['sop_name']);
            $nama_app = stringUrl($post['nama_app']);
            $nama_fitur = stringUrl($post['nama_fitur']);
            $jam = date("h-i-sa");
            $six_digit_random_number = mt_rand(10000, 99999);
            $post['sop_tgl'] = date("Y-m-d", strtotime($post['sop_tgl']));
            $fileName = $post['sop_tgl']."-".$nama_app."-".$nama_fitur."-".$sop_name."-".$jam;
            
           
             
            if ( ! write_file("./uploads/sop/$fileName.htm", $post['isi'])){

                 
                writelog('error', "Tambah SOP Baru Gagal. Dari databasenya. ");
                flash_err('Tambah SOP Baru Gagal. Mohon periksa kembali formulir wajib.');
            }else{
               
                $post['sop_pdf'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/sop/' . $fileName."."."htm";
                unset($post['isi']);
                $data['sop_id'] = $this->sop->add($post);
                if ($data['sop_id']) {
                    writelog('success', "Tambah SOP Baru dengan id {$data['sop_id']} Sukses.");
                    flash_succ("Tambah SOP Baru `{$post['sop_name']}` Sukses.");
                } else {
                    writelog('error', "Tambah SOP Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah SOP Baru Gagal. Mohon periksa kembali formulir wajib.');
                }

                redirect(base_url($this->cname) . '/createsop/'.$id);
                
            }
      

           
        }
        //$id = decode($id);
        $jumlah_data = $this->fdb->jumlah_data_answer_right($id);
    
        
        $this->load->library('pagination');
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'offset';

        $config['base_url'] = base_url($this->cname)."/createsop/".$id;
        // add the category if it's set
        if (!is_null($from)) 
            $config['base_url'] = $config['base_url'].'/'.$from;

        // make segment based URL ready to add query strings
        // pagination library does not care if a ? is available
        $config['base_url'] = $config['base_url'].'/?';



       
        $config['total_rows'] = $jumlah_data;
        $config['per_page'] = 3;
       // $from = $this->uri->segment(5);
     
        // CSS Bootstrap               
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
                // Akhir CSS

        $this->pagination->initialize($config);     
        $offset = $this->input->get('offset');
        $data['issue_answer'] = $this->fdb->data_answer_right($id,$config['per_page'],$offset);
        $data['title'] = 'Ticket';
        $data['active'] = 'data_issue';
        $this->fitur = 'Lihat';
        $this->fitur2 = 'Jawaban';
        $data['content'] = 'create_sop_from';
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source','summernote','kategori_suggest');
        $data['issue_detail'] = $this->fdb->get_row($id);
        //$data['issue_answer'] = $this->fdb->get_answer($id);
        $this->load->view('template', $data);
    }

    // public function submit_createsop(){
    //     if ($this->input->post()) {
    //         $post = $this->input->post();

    //         $this->form_validation->set_rules('sop_name', 'Nama Aplikasi', 'required');
    //         $this->form_validation->set_rules('sop_tgl', 'Tanggal Release', 'required');
    //         $this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'required');
    //         $this->form_validation->set_rules('nama_fitur', 'Nama Fitur', 'required');
    //         $this->form_validation->set_rules('sop_pic', 'Nama Pembuat (PIC)', 'required');

    //         $this->form_validation->set_error_delimiters('<li>', '</li>');

    //         if ($this->form_validation->run() === false) {
    //             writelog('error', "Tambah SOP Baru Gagal. " . validation_errors());
    //             flash_err('Tambah SOP Baru Gagal. <ul>' . validation_errors() . '</ul>');
    //             redirect(base_url($this->cname) . '/createsop/'.$post['id']);
    //         }
    //         unset($post['id']);

    //         $sop_name = stringUrl($post['sop_name']);
    //         $nama_app = stringUrl($post['nama_app']);
    //         $nama_fitur = stringUrl($post['nama_fitur']);
    //         $jam = date("h-i-sa");
    //         $six_digit_random_number = mt_rand(10000, 99999);
    //         $post['sop_tgl'] = date("Y-m-d", strtotime($post['sop_tgl']));
    //         $fileName = $post['sop_tgl']."-".$nama_app."-".$nama_fitur."-".$sop_name."-".$jam;
            
           
             
    //         if ( ! write_file(APPPATH."/uploads/sop/$fileName.txt", $post['isi'])){
                 
    //             writelog('error', "Tambah SOP Baru Gagal. Dari databasenya. ");
    //             flash_err('Tambah SOP Baru Gagal. Mohon periksa kembali formulir wajib.');
    //         }else{
               
    //             $post['sop_pdf'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/sop/' . $fileName."."."txt";
    //             $data['sop_id'] = $this->fdb->add($post);
    //             if ($data['sop_id']) {
    //                 writelog('success', "Tambah SOP Baru dengan id {$data['sop_id']} Sukses.");
    //                 flash_succ("Tambah SOP Baru `{$post['sop_name']}` Sukses.");
    //             } else {
    //                 writelog('error', "Tambah SOP Baru Gagal. Dari databasenya. ");
    //                 flash_err('Tambah SOP Baru Gagal. Mohon periksa kembali formulir wajib.');
    //             }
    //             redirect(base_url('data_sop'));
                
    //         }
      

           
    //     }
    // }
   
}
