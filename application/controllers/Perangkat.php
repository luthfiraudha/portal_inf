<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perangkat extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_perangkat', 'fdb');
        $this->cname = 'perangkat';
        $this->menu = 'Perangkat';
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
        $data['title'] = 'Perangkat';
        $data['active'] = 'data_issue';
        $this->fitur = 'Daftar';
        $data['content'] = 'perangkat/perangkat_list';
        $data['plugins'] = array('datatables','daterangepicker','perangkat');
       
        $this->load->view('template', $data);
    }

    public function add() {

        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('nama_divisi', '', 'required');
            $this->form_validation->set_rules('nama', '', 'required');
            $this->form_validation->set_rules('pn', '', 'required');
            $this->form_validation->set_rules('jabatan', '', 'required');
            $this->form_validation->set_rules('permohonan_perangkat', '', 'required');
            $this->form_validation->set_rules('alasan_penggunaan', 'Alasan Penggunaan', 'required');
            $this->form_validation->set_rules('baru_replacement', 'Baru / Replacement', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Perangkat', 'required');
            $this->form_validation->set_rules('merek', 'Merek Perangkat', 'required');

            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === false) {
                writelog('error', "Tambah Data Baru Gagal. " . validation_errors());
                flash_err('Tambah Data Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }


            $post['nama_divisi'] = 0;
            $post['nama'] = 0;
            $post['pn'] = 0;
            $post['jabatan'] = 0;   
            $post['permohonan_perangkat'] = 0;
            $post['alasan_penggunaan'] = 0;
            $post['baru_replacement'] = 0;
            $post['tahun'] = 0;
            $post['merek'] = 0;
            $data['id'] = $this->fdb->add;
            if ($data['id']) {
                $data['perangkat'] = $this->fdb->get_all($data['id']);
                writelog('success', "Tambah Data Baru dengan id {$data['id']} Sukses.");
                flash_succ("Tambah Data Baru  Sukses.");
            } else {
                writelog('error', "Tambah Data Baru Gagal. Dari databasenya. ");
                flash_err('Tambah Data Baru Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname.'/view/'.$data['id']));

        }

        $data['title']   = 'Perangkat';
        $data['active']  = 'perangkat';
        $this->fitur     = 'Tambah';
        $data['content'] = 'perangkat/perangkat_form';
        
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }

    protected function edit($id = '') {
        if ($this->input->post()) {
            $post = $this->input->post();

            $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required');
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('pn', 'PN', 'required');
            $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
            $this->form_validation->set_rules('permohonan_perangkat', 'Permohonan Perangkat', 'required');
            $this->form_validation->set_rules('alasan_penggunaan', 'Alasan Penggunaan', 'required');
            $this->form_validation->set_rules('baru_replacement', 'Baru / Replacement', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Perangkat', 'required');
            $this->form_validation->set_rules('merek', 'Merek Perangkat', 'required');

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

        $data['title']   = 'Perangkat';
        $data['active']  = 'perangkat';
        $this->fitur     = 'Ubah';
        $data['content'] = 'perangkat/perangkat_form';
        $data['perangkat_detail'] = $this->fdb->get_row($id);
        $data['plugins'] = array('daterangepicker','datatables');

        $this->load->view('template', $data);
    }





     public function view($id = '')
    {
        $data['title']         = 'Perangkat';
        $data['active']        = 'perangkat';
        $this->fitur           = 'Lihat';
        $data['perangkat_detail'] = $this->fdb->get_row($id);
        $data['content'] = 'perangkat/perangkat_form';
        $data['plugins'] = array('popconfirm','datatables');

        $this->load->view('template', $data);
    }

    protected function delete($id = 0) {
        $perangkat = $this->fdb->get_row($id);
        $result = $this->fdb->delete($id);
        if ($result) {
            writelog('success', "Hapus Ticket id ({$perangkat->id}) Sukses.");
            flash_succ("Hapus Ticket  Sukses.");
        } else {
            writelog('error', "Hapus Ticket id ({$perangkat->id}) Gagal.");
            flash_err("Hapus  Ticket  Gagal.");
        }
        redirect(base_url($this->cname));
    }

    


   /////////////////////////////////////////////////// datatables /////////////////////////////////////////////////////

    public function ajax_list_perangkat()
    {
        $list = $this->fdb->get_datatables('perangkat', array('id','nama_divisi','nama','pn','jabatan','permohonan_perangkat','alasan_penggunaan','baru_replacement','tahun','merek'), array('id'=>'desc'));
        
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_divisi." / ".$list->nama;
            $row[] = $list->pn;

            if($list->smu_status != 0){
                 $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a title='Detail'  >
                                    ".$list->jabatan."
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
                                    ".$list->permohonan_perangkat."
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
                                    ".$list->alasan_penggunaan."
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
                                    ".$list->baru_replacement."
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
                                    ".$list->tahun."
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
                                    ".$list->merek."
                                </a>
                                

                            </td>";
            }else{
                $row[] = " <td style='text-align:center' width='140px'>
                               
                                <a style='color:red;' >
                                    on progress
                                </a>
                                

                            </td>";
            }


              $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'perangkat/view/'.$list->id."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'> </i>
                                </a>
                                <a title='Edit' href='".base_url().'perangkat/action/edit/'.$list->id."' class='btn btn-circle btn-sm bg-orange'>
                                    <i class='fa fa-edit'> </i>
                                </a> 
                                <a title='Delete' data-href='".base_url().'perangkat/action/delete/'.$list->id."' class='btn btn-circle btn-sm bg-red' data-toggle='modal' data-target='.delete-modal'>
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
                        "recordsTotal" => $this->fdb->count_all('perangkat', array('id','nama_divisi','nama','pn','jabatan','permohonan_perangkat','alasan_penggunaan','baru_replacement','tahun','merek'), array('id'=>'asc')),
                        "recordsFiltered" => $this->fdb->count_filtered('perangkat', array('id','nama_divisi','nama','pn','jabatan','permohonan_perangkat','alasan_penggunaan','baru_replacement','tahun','merek'), array('id'=>'asc')),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    
}
