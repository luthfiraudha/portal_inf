<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Konfigurasi_tape extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_tape', 'fdb');
        //$this->load->model('m_tape_record', 'k_fdb');
        $this->cname = 'Konfigurasi_tape';
        $this->menu = 'Konfigurasi Tape';
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
        $data['title'] = 'Konfigurasi Tape';
        $data['active'] = 'Konfigurasi_tape';
        $this->fitur = 'Form';
        $data['content'] = 'Konfigurasi_tape_form';
        $data['plugins'] = array('daterangepicker','datatables','kategori_suggest');
        //$data['issue'] = $this->fdb->get_daily();

        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();

            if($post['type']!="New Tape"){
                $post['status'] = "belum selesai"; 
              }else{
                $post['status'] = "selesai"; 
                $post['pinned'] =0;
              }
         
            unset($post['user_nama']);
            $this->form_validation->set_rules('user_id', 'Nama', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Issue Baru Gagal. " . validation_errors());
                flash_err('Tambah Issue Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }
            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);

           
            if (!$cek_kategori) {
                
                $kategori_id = $this->k_fdb->add($post['kategori_nama']);

                if ($kategori_id) {
                    $post['kategori_id'] = $kategori_id;

                    unset($post['kategori_nama']);
                    $data['id'] = $this->fdb->add($post);
                    if ($data['id']) {
                        writelog('success', "Tambah Ticket Baru dengan id {$data['id']} Sukses.");
                        flash_succ("Tambah  Ticket Baru `{$data['id']}` Sukses.");
                    } else {
                        writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                        flash_err('Tambah Ticket Baru Gagal. Mohon periksa kembali formulir wajib.');
                    }
                } else {

                    writelog('error', "Tambah Ticket Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                }
            } else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }
                unset($post['kategori_nama']);
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


        $data['title'] = 'Daily';
        $data['active'] = 'data_tape';
        $this->fitur = 'Tambah Tape Baru';
        $this->fitur2 = '';
        $data['content'] = 'data_tape_form';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','kategori_suggest');

        $this->load->view('template', $data);
    }

    protected function edit($id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();
            $id = $post['id'];
            unset($post['user_nama']);
            $this->form_validation->set_rules('user_id', 'Nama', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Issue  id {$id} Gagal. " . validation_errors());
                flash_err("Ubah Issue `{$id}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id));
            }

            $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);

           
            if (!$cek_kategori) {
                
                $kategori_id = $this->k_fdb->add($post['kategori_nama']);


                if ($kategori_id) {
                    $post['kategori_id'] = $kategori_id;

                    unset($post['kategori_nama']);
                    $result = $this->fdb->update($id, $post);

                    if ($result === false) {
                        writelog('error', "Ubah Ticket id {$id} Gagal.");
                        flash_err("Ubah Ticket '{$post['id']}' Gagal. Periksa kembali formulir wajib.");
                    } else {
                        if ($result > 0) {
                            writelog('success', "Ubah Ticket id {$id} Sukses.");
                            flash_succ("Ubah Ticket '{$id}' Sukses.");
                        } else {
                            writelog('warning', "Ubah Ticket id {$id} Gagal. Tidak ada data yang berubah.");
                            flash_warn("Ubah Ticket Gagal. Tidak ada data yang berubah.");
                        }
                    }
                } else {

                    writelog('error', "Ubah Ticket Baru Gagal. Dari databasenya. ");
                    flash_err('Ubah Ticket Gagal. Mohon periksa kembali formulir wajib.');
                }
            }else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
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
        $data['plugins'] = array('popconfirm', 'daterangepicker','kategori_suggest');

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
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';            
        $config['prev_link'] = '«';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '»';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
                // Akhir CSS

        $this->pagination->initialize($config);     
        $offset = $this->input->get('offset');
        $data['issue_answer'] = $this->fdb->data_answer($id,$config['per_page'],$offset);
        $data['title'] = 'Daily';
        $data['active'] = 'daily_issue';
        $this->fitur = 'Lihat';
        $this->fitur2 = 'Jawaban';
        $data['content'] = 'daily_form';
        $data['plugins'] = array();
        $data['issue_detail'] = $this->fdb->get_row($id);
        //$data['issue_answer'] = $this->fdb->get_answer($id);
        $this->load->view('template', $data);
    }

    protected function delete($id = 0) 
    {
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
            flash_succ("Hapus Ticket  '{$issue->id}' Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$issue->id}) Gagal.");
            flash_err("Hapus  Ticket  '{$issue->id}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

   

public function search()
{
         if ($this->input->post()) 
         {
            if($this->input->post('start_date') =="")
            {
                $tanggal ="";
            }else
            {
                 $tanggal = date("Y-m-d", strtotime($this->input->post('tanggal')));
            }
           
            $set_tape = $this->input->post('set_tape');
            $state = $this->input->post('state');
            
            $data['tape'] = $this->fdb->search($start_date,$set_tape,$state);


           if ($data['tape']) 
           {  

                writelog('success', "Data ditemukan");
                //flash_succ("Data Ditemukan");
            } else 
            {
                if ($data['tape'] > 0) 
                {
                    writelog('success', "Data ditemukan");
                  //  flash_succ("Data ditemukan");
                } else 
                {
                    writelog('warning', "Data Tidak Ada");
                    //flash_warn("Data Tidak Ada");
                    redirect(base_url($this->cname));
                }
                redirect(base_url($this->cname));
            }
                $data['title']         = 'Problem / Request Solution';
                $data['active']        = 'data_tape';
                $this->fitur          = 'Cari';
                $data['content']       = 'data_tape_list';
                //$data['kategori']   = $this->k_fdb->get_all();
                $data['plugins']       = array('datatables','daterangepicker','kategori_suggest');
                $this->load->view('template', $data);
        }
}

}