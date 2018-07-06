<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Reminder_issue extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
       
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_issue', 'fdb');
        $this->load->model('m_kategori_issue', 'k_fdb');
        $this->cname = 'reminder_issue';
        $this->menu  = 'Ticket Reminder';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
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
        $data['title']   = 'Checklist Ticket';
        $data['active']  = 'reminder_issue';
        $this->fitur     = 'Daftar Reminder';
        $data['content'] = 'reminder_issue_list';
        $data['plugins'] = array('daterangepicker','datatables','kategori_suggest','ticket_source');
        $data['issue']  = $this->fdb->get_reminder();
        $this->load->view('template', $data);
    }


    protected function view_0($id = '')
    {
        $data['title']         = 'Checklist Ticket';
        $data['active']        = 'data_issue';
        $this->fitur           = 'Lihat Reminder';
        $this->fitur2          = 'Jawaban Reminder';
        $data['content'] = 'reminder_issue_form';
        $data['plugins'] = array('datatables');
        $data['issue_detail'] = $this->fdb->get_row($id);
        $data['issue_answer'] = $this->fdb->get_answer($id);
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
        $data['title']         = 'Ticket';
        $data['active']        = 'data_issue';
        $this->fitur           = 'Lihat Reminder';
        $this->fitur2          = 'Jawaban Reminder';
        $data['content'] = 'reminder_issue_form';
        $data['plugins'] = array('datatables');
        $data['issue_detail'] = $this->fdb->get_row($id);
        $data['issue_answer'] = $this->fdb->get_answer($id);
        $this->load->view('template', $data);
    }

    protected function correct_answer($id=''){
       if($this->input->post()){
            $post   = $this->input->post();
   
            $issue = $this->fdb->get_reminder_answer($id);
              $jum2 = 0;
              $jum1 = 0;

          
            $answer_id = array();
            $i=0;
            foreach ($issue as $key) {
                $answer_id[$i] = $key->id;
                $i++;
            }
           
            $benar = array_intersect($post['id'], $answer_id);
            $salah = array_diff($answer_id, $post['id']);
          
            foreach ($benar as $key) {
                $data['correct'] = "tepat";
                $this->fdb->update_answer($key,$data);
                $jum2++;
            }

            foreach ($salah as $key) {
                $data['correct'] = "tidak tepat";
                $this->fdb->update_answer($key,$data);
                $jum1++;
            }
            


            if ($jum1 > 0 && $jum2 == 0) {
             writelog('success', "Correct id {$issue_id} Sukses.");
             flash_succ("Correct issue Sukses. Namun belum ada jawaban tepat");
             } elseif($jum2 > 0) {
                $data2['status']='selesai';
                $data2['pinned']=0;
                $this->fdb->update($id,$data2);
                writelog('success', "Correct id {$issue_id} Sukses.");
                flash_succ("Correct issue Sukses. Sudah ada jawaban tepat");
            }else{
               writelog('warning', "Ubah issue id {$issue_id} Gagal. Tidak ada data yang berubah.");
               flash_err("Ubah Issue Gagal. Tidak ada data yang berubah.");
            }
                
             redirect(base_url($this->cname));
         }else{
            writelog('warning', "Ubah issue id {$issue_id} Gagal. belum ada data answer atau tidak ada data yang dipilih.");
            flash_warn("Ubah Issue Gagal. Belum ada data answer atau tidak ada data yang dipilih.");
            redirect(base_url($this->cname));
         }
    }

    
    protected function add_answer($issue_id = '')
    {
        if ($this->input->post()) {
            $post      = $this->input->post();
            $post['record_id'] = $issue_id;
            $post['correct']           = "belum dikoreksi";
            unset($post['user_nama']);


            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah jawaban dengan issue user {$user_id} Gagal. " . validation_errors());
                flash_err("Tambah jawaban dengan issue user `{$post['user_id']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/add_answer/' . $issue_id));
            }


            $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:m:s", strtotime($post['jam']));
            unset($post['tgl']);
            unset($post['jam']);
            $post['tgl_sol'] = $stringtgl;
            $data['answer_id'] = $this->fdb->add_answer($post);

           if ($data['answer_id']) {
                writelog('success', "Tambah Jawaban Baru dengan id {$data['answer_id']} Sukses.");
                flash_succ("Tambah  Jawaban Baru `{$post['answer']}` Sukses.");
            } else {
                writelog('error', "Tambah Jawaban Baru Gagal. Dari databasenya. ");
                flash_err('Tambah Jawaban Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname. '/action/view/' . $issue_id));
        }

        $data['title']         = 'Data Answer';
        $data['active']        = 'data_issue';
        $this->fitur2          = 'Tambah Jawaban';
        $data['issue_id']      = $issue_id;
        $data['answer_detail'] = $this->fdb->get_row($issue_id);
        $data['content']       = 'data_answer_form';
        $data['plugins']       = array('popconfirm','daterangepicker','ticket_source');

        $this->load->view('template', $data);
    }


    protected function view_answer($answer_id = '')
    {
        $data['title']         = 'Data Answer';
        $data['active']        = 'data_issue';
        $this->fitur2          = 'Lihat Jawaban Reminder';
        $data['content']       = 'Reminder_answer_form';
        $data['plugins']       = array();
        $data['answer_detail'] = $this->fdb->get_answer_row($answer_id);
        $this->load->view('template', $data);
    }

    

    public function ajax_answer(){
        $id = $this->input->post('id');
        $data['answer_detail'] = $this->fdb->get_reminder_answer($id);
        $data['issue_detail'] = $this->fdb->get_row($id);
        $this->load->view('content/content_modal_correct', $data);
        
    }

  protected function edit_answer($answer_id = '') {

        if ($this->input->post()) {
            $post = $this->input->post();
            $answer_id = $post['answer_id'];
            unset($post['user_nama']);


            $this->form_validation->set_rules('user_id', 'Nama', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Ubah Jawaban dengan issue user {$user_id} Gagal. " . validation_errors());
                flash_err("Ubah Jawaban dengan issue user `{$post['user_id']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/add_answer/' . $issue_id));
            }


            
            $stringtgl = date("Y-m-d", strtotime($post['tgl']))." ".date("H:m:s", strtotime($post['jam']));
            unset($post['tgl']);
            unset($post['jam']);
            $post['tgl_sol'] = $stringtgl;

            $result = $this->fdb->update_answer($answer_id, $post);

            if ($result === false) {
                writelog('success', "Ubah Jawaban dengan id {$data['answer_id']} Sukses.");
                flash_succ("Ubah Jawaban `{$post['answer']}` Sukses.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Jawaban id {$answer_id} Sukses.");
                    flash_succ("Ubah Jawaban '{$post['issue_id']}' Sukses.");
                } else {
                    writelog('warning', "Ubah Jawaban id {$answer_id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah Jawaban Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname . '/action/view/' . $post['issue_id']));
        }

        $data['title'] = 'Ticket Problem Answer';
        $data['active'] = 'data_issue';
        $this->fitur2 = 'Ubah Jawaban';
        $data['answer_detail'] = $this->fdb->get_answer_row($answer_id);
        $data['content'] = 'data_answer_form';
        $data['plugins'] = array('popconfirm','daterangepicker','ticket_source');

        $this->load->view('template', $data);
    }

    protected function delete_answer($answer_id = 0) {
        $answer = $this->fdb->get_answer_row($answer_id);
        $result = $this->fdb->delete_answer($answer_id);
        if ($result) {
            writelog('success', "Hapus Jawaban id ({$answer->answer_id}) Sukses.");
            flash_succ("Hapus jawaban  '{$answer->answer_id}' Sukses.");
        } else {
            writelog('error', "Hapus Jawaban id ({$answer->answer_id}) Gagal.");
            flash_err("Hapus  Jawaban '{$answer->answer_id}' Gagal.");
        }
        redirect(base_url($this->cname . '/action/view/' . $answer->issue_id));
    }

    






}
