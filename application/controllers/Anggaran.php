<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_anggaran', 'fdb');
        $this->cname = 'anggaran';
        $this->menu = 'Anggaran';
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
        $data['title'] = 'Anggaran';
        $data['active'] = 'anggaran';
        $this->fitur = 'Daftar';
        $data['content'] = 'anggaran/anggaran_list';
        $data['plugins'] = array('datatables','daterangepicker','anggaran');
       
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('nama_anggaran', 'Nama Anggaran', 'required');
            $this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $six_digit_random_number = mt_rand(10000, 99999);            
            $post['id_anggaran'] = date('Ymd').$post['tahun_anggaran'].$six_digit_random_number;
            $add = $this->fdb->add($post);
                 if ($add) {
                    writelog('success', "Tambah data anggaran dengan id {$data['id']} Sukses.");
                    flash_succ("Tambah data anggaran Sukses.");
                } else {
                    writelog('error', "Tambah data anggaran Gagal. Dari databasenya. ");
                    flash_err('Tambah data anggaran Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname));
                
            

        }

        $data['title']   = 'Anggaran';
        $data['active']  = 'anggaran';
        $this->fitur     = 'Tambah';
        $data['content'] = 'anggaran/anggaran_form';
        
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }

    

    protected function edit($id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('nama_anggaran', 'Nama Anggaran', 'required');
            $this->form_validation->set_rules('tahun_anggaran', 'Tahun Anggaran', 'required');
          

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $six_digit_random_number = mt_rand(10000, 99999);            
            $post['id_anggaran'] = date('Ymd').$post['tahun_anggaran'].$six_digit_random_number;
            $add = $this->fdb->update($id,$post);
                 if ($add) {
                    writelog('success', "Tambah data anggaran dengan id {$data['id']} Sukses.");
                    flash_succ("Tambah data anggaran Sukses.");
                } else {
                    writelog('error', "Tambah data anggaran Gagal. Dari databasenya. ");
                    flash_err('Tambah data anggaran Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url($this->cname));
                
            

        }


        $data['title']   = 'Anggaran';
        $data['active']  = 'anggaran';
        $this->fitur     = 'Ubah';
        $data['content'] = 'anggaran/anggaran_form';
        $data['anggaran_detail'] = $this->fdb->get_row($id);
        $data['plugins'] = array('daterangepicker');

        $this->load->view('template', $data);
    }



     public function view($id = '')
    {
        $data['title']         = 'Anggaran';
        $data['active']        = 'Anggaran';
        $this->fitur           = 'Lihat';
        $data['anggaran_detail'] = $this->fdb->get_row($id);
        $data['content'] = 'Anggaran/anggaran_form';
        $data['plugins'] = array('popconfrim');

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

    


   /////////////////////////////////////////////////// datatables /////////////////////////////////////////////////////

    public function ajax_list_anggaran()
    {
        $list = $this->fdb->get_datatables('anggaran', array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran'=>'desc'));
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_anggaran;
            $row[] = $list->tahun_anggaran;

            $row[] = $list->nilai_anggaran;
            

            if($list->sisa !=''){
               $row[] =   $list->sisa;
            }else{
                $row[] =  $list->nilai_anggaran;
            };

           


              $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'anggaran/view/'.$list->id_anggaran."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'> </i>
                                </a>
                                <a title='Edit' href='".base_url().'anggaran/action/edit/'.$list->id_anggaran."' class='btn btn-circle btn-sm bg-orange'>
                                    <i class='fa fa-edit'> </i>
                                </a> 
                                <a title='Delete' data-href='".base_url().'anggaran/action/delete/'.$list->id_anggaran."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
                                    <i class='fa fa-trash'> </i>
                                </a>

                            </td>";
            



               
           
            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fdb->count_all('anggaran', array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran'=>'desc')),
                        "recordsFiltered" => $this->fdb->count_filtered('anggaran', array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran','tahun_anggaran','nama_anggaran','nilai_anggaran','sisa'), array('id_anggaran'=>'asc')),
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
