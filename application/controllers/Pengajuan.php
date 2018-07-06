<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_pengajuan', 'fdb');
        $this->load->model('m_data_aplikasi', 'fdba');
        $this->load->model('m_data_fitur', 'fdbb');
        $this->load->model('m_data_dok', 'fdbc');
        $this->load->model('m_data_koneksi', 'fdbd');
        $this->cname = 'Pengajuan';
        $this->menu  = 'Pengajuan';
        $this->fitur = '';

        $this->active_user      = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function exis(){
        $id = $this->input->post("id_app");
        $idf = $this->input->post("id_fitur");
        $data = $this->modelexis($idf);
        echo ($data);
    }

    public function modelexis($id){
        $query = $this->db->query("select a.versi_a,a.versi_b,a.versi_c from data_dok a join (SELECT max(id_doc) id_doc FROM data_dok b where b.id_fitur = '".$id."' and b.status='dikonfirmasi') b on a.id_doc = b.id_doc where a.hapus= 0");
        $res="x";
        $row = $query->row();

        if (isset($row)){
            foreach ($query->result_array() as $row) {
                $res=array(
                    'versi_a' => $row['versi_a'],
                    'versi_b' => $row['versi_b'],
                    'versi_c' => $row['versi_c'],
                );
            }
        }
        
        return json_encode($res);
    }

    public function newb(){
        $id = $this->input->post("id_app");
        $data  = $this->fdb->get_max_versi_b($id);

        echo ($data);
    }

    public function newfit(){
        $id = $this->input->post("id_app");
        $data  = $this->fdb->get_max_versi_x($id);

        echo ($data);
    }    

    public function index()
    {
        $this->add();
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

     public function add()
    {
        if ($_POST!=NULL && $_FILES != NULL ) 

        { 
            //print_r($_POST);exit;


            $post = $this->input->post();
            $nilai = $post['hidden'];
            $nilaix = $post['hid'];

            //unset($_FILES['dok_link']);
            //print_r($_FILES); exit();
            /*for($i=0; $i<$nilai; $i++) {
                $tipe_fitur = $post['tipe_fiturs'][$i];
                print_r($tipe_fitur);exit;
            }*/   


            if($this->input->post("myRadios") == "new" ) {
                $this->form_validation->set_rules('nama_apps', 'Nama Aplikasi', 'required');
                $this->form_validation->set_rules('des_app', 'Deskripsi Aplikasi', 'required');
                $this->form_validation->set_rules('no_surat', 'Nomor Surat', 'required');
                $nama_app= $post['nama_apps'];
            }

            else 
            {   
                $this->form_validation->set_rules('id_app', 'ID Aplikasi', 'required'); 
                $this->form_validation->set_rules('no_suratz', 'Nomor Surat', 'required'); 
                $id_app= $post['id_app'];
                $resultnama = $this->fdba->get_nama($id_app);
                $nama_app= $resultnama->nama_app; 
                //print_r($nama_app);exit;
            }

            if($this->input->post("myRadios_2") == "new" ) {

                $this->form_validation->set_rules('nama_fitur[]', 'Nama Fitur', 'required');
                $this->form_validation->set_rules('tipe_fiturs[]', 'Tipe Fitur', 'required');
                $this->form_validation->set_rules('pengembang[]', 'Pengembang', 'required'); 
                $this->form_validation->set_rules('programmer[]', 'Programmer', 'required'); 
                $this->form_validation->set_rules('platform[]', 'Platform', 'required'); 
                $nama_fitur= $post['nama_fitur'];

                for($i=0; $i<$nilai; $i++) {
                    if (empty($_FILES['dok_link']['name'][$i]))
                    {
                        $this->form_validation->set_rules('dok_link[$i]', 'Document Source Code', 'required');
                    }          

                    $this->form_validation->set_error_delimiters('<li>', '</li>');

                    if(($post['tipe_fiturs'][$i] != 'Database') && ($post['tipe_fiturs'][$j] != ''))
                    {
                        for ($j=0; $j <1 ; $j++) { 
                            for ($k=0; $k < $nilaix; $k++) { 
                                $app_name[$k] = $post['nama_app_to'][$i][0][$k];
                                $x=$k+1;
                                $this->form_validation->set_rules('app_name[$k]', 'Koneksi ke Aplikasi ('.$x.')', 'required');
                            }
                        }

                        for($j=0;$j<$nilaix;$j++){
                            for ($k=0; $k <1 ; $k++) { 
                                $nama_fiturs[$j] = $post["nama_fitur_to"][$i][$j][0];
                                $y=$j+1;
                                $this->form_validation->set_rules('nama_fiturs[$j]', 'Koneksi ke Fitur ('.$y.')', 'required');
                            }
                        }   
                    }
                }
                
            }
            else if(($this->input->post("myRadios_2") == "existing") || ($this->input->post("myRadios_2") == "versioning" )) 
            {   
                $this->form_validation->set_rules('id_fitur', 'ID Fitur', 'required'); 
                $id_fitur= $post['id_fitur'];
                $resultnama = $this->fdbb->get_namafit($id_fitur);
                $nama_fitur= $resultnama->nama_fitur;
                $tipe_fitur = $resultnama->tipe_fitur;
            }


            $this->form_validation->set_rules('versi_a', 'Versi Aplikasi', 'required');
            $this->form_validation->set_rules('versi_b', 'Versi Aplikasi', 'required');
            $this->form_validation->set_rules('versi_c', 'Versi Aplikasi', 'required');
            
           
            

            $versi_app = $post['versi_a'] ."_". $post['versi_b'] ."_". $post['versi_c'];
            

            if ($this->form_validation->run() === false) {
                writelog('error', "Pengajuan Data Dokumen Aplikasi Gagal. " . validation_errors());
                flash_err('Pengajuan Data Dokumen Aplikasi Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url("pengajuan/"));
            }

           // $post['tgl_deploy'] = date("Y-m-d", strtotime($post['tgl_deploy']));
            $post['status'] = "belum dikonfirmasi";
            $config['upload_path'] = './uploads/dataapp/'; //buat folder dengan nama uploads di root folder           
            $config['allowed_types'] = 'rar';
            $config['max_size'] = 250000;

            $config2['upload_path'] = './uploads/datahowto/'; //buat folder dengan nama uploads di root folder           
            $config2['allowed_types'] = 'pdf';
            $config2['max_size'] = 25000;
             
           // print_r($_FILES['dok_link']);exit;


            

            if ($this->input->post("myRadios_2") == "new" ) {
                if($this->input->post("myRadios") == "new" ) {                    

                    $ceksemua = $this->fdb->get_all();
                    foreach ($ceksemua as $key) {
                        $availability = $this->fdba->cek_unique_update($post['nama_apps'], $key->id_app);
                    }
                    if ($availability) {
                        flash_err("Pengajuan Aplikasi Baru Gagal. Nama Aplikasi `{$post['nama_apps']}` telah diambil.");
                        redirect(base_url("pengajuan/"));
                    }
                    else{
                   // print_r("tes");
                        $data['id_app'] = $this->fdba->add(array(
                        'nama_app' => $post['nama_apps'] ,
                        'des_app' => $post['des_app'],
                        'jenis_app' => $post['jenis_app'],
                        'status' => $post['status'] ));
                        }
                    $id_app=$data['id_app'];
                }
                
                //$z= 1;
                for($i=0; $i<$nilai; $i++) {

                    $data['id_fitur'] = $this->fdbb->add(array(
                    'id_app' => $id_app,
                    'nama_fitur' => $post['nama_fitur'][$i] ,
                    'des_fitur' => $post['des_fitur'][$i],
                    'tipe_fitur' => $post['tipe_fiturs'][$i],
                    'pengembang' => $post['pengembang'][$i],
                    'programmer' => $post['programmer'][$i],
                    'platform' => $post['platform'][$i],
                    'status' => $post['status']));
                    $id_fitur=$data['id_fitur'];
                    //$x 
                    if ($post['tipe_fiturs'][$i] != "Database")
                    {   
                        for ($j=0; $j <1 ; $j++) { 
                            for ($k=0; $k < $nilaix; $k++) { 
                                
                            $app_name = $post['nama_app_to'][$i][0][$k];

                            $app_name = $this->fdba->get_nama($app_name);
                            //foreach ($app_name as $key) {
                            $app_names[$k] = $app_name->nama_app;
                            }
                        }

                       // print_r($xx); exit;

                        for($j=0;$j<$nilaix;$j++){
                            for ($k=0; $k <1 ; $k++) { 
                                $nama_fiturs = $post["nama_fitur_to"][$i][$j][0];

                                $x_fitur = $this->fdbb->get_ip($nama_fiturs);
                                /*print_r($x_fitur);
                                print_r($nama_fiturs); exit;*/

                                $nama_fiturx[$j] = $post["nama_fitur_to"][$i][$j][0];
                                $fitur_ip[$j] = $x_fitur->ip_fitur;
                                $fitur_tipe[$j] = $x_fitur->tipe_fitur;

                                    if($post['ip_koneksi'][$i][$j][0] == ''){
                                            $ip_fitur_fix[$j] = $fitur_ip[$j];
                                    }
                                    else
                                    {
                                            $ip_fitur_fix[$j] = $post['ip_koneksi'][$i][$j][0];
                                    }

                                    if($fitur_tipe[$j] == NULL){

                                            $fitur_tipe[$j] = 'Lain-lain';
                                    }
                            }
                            

                            $data['id_koneksi'] = $this->fdbd->add(array(
                            'id_app' => $id_app,
                            'id_fitur' => $id_fitur,
                            'konekTo_app' => $app_names[$j],
                            'konekTo_fitur' => $nama_fiturx[$j],
                            'konekTo_tipe_fitur' => $fitur_tipe[$j],
                            'konekTo_ip_fitur' =>  $ip_fitur_fix[$j],                                
                            'status' => $post['status'] ));
                        }
                        
                    }

                    
                    $_FILES['userfile']['name']     = $_FILES['dok_link']['name'][$i];
                    $_FILES['userfile']['type']     = $_FILES['dok_link']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $_FILES['dok_link']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $_FILES['dok_link']['error'][$i];
                    $_FILES['userfile']['size']     = $_FILES['dok_link']['size'][$i];

                    $_FILES['userfile2']['name']     = $_FILES['dok_HowTo']['name'][$i];
                    $_FILES['userfile2']['type']     = $_FILES['dok_HowTo']['type'][$i];
                    $_FILES['userfile2']['tmp_name'] = $_FILES['dok_HowTo']['tmp_name'][$i];
                    $_FILES['userfile2']['error']    = $_FILES['dok_HowTo']['error'][$i];
                    $_FILES['userfile2']['size']     = $_FILES['dok_HowTo']['size'][$i];

                    $nama_fitur = $post['nama_fitur'][$i];
                    $tipe_fitur = $post['tipe_fiturs'][$i];
                    //$nama_app = $post['nama_apps'];

                    $nama_fitur= str_replace (' ','_',$nama_fitur);
                    $nama_app= str_replace (' ','_',$nama_app); 
                    $tipe_fitur = str_replace (' ','_',$tipe_fitur);

                    //print_r($nama_app);exit;
                    $fileName = $nama_app . "_Fitur_".$nama_fitur. "_V_".$versi_app . "(".$tipe_fitur.")";
                    $fileName2 = "How_To_".$nama_app . "_Fitur_".$nama_fitur. "_V_".$versi_app . "(".$tipe_fitur.")";

                    $config['file_name'] = $fileName;
                    $config2['file_name'] = $fileName2;

                    $this->load->library('upload');
                    $this->upload->initialize($config);
                   
                    

                    unset($_FILES['dok_link2']);
                    unset($_FILES['dok_HowTo2']);
                    if(! $this->upload->do_upload()){
                       
                        //$this->fdba->deletex($id_app);
                        $error = array('error' => $this->upload->display_errors());
                        $data = array('upload_data' => $this->upload->data());
                        
                        //echo var_dump($error);exit;

                        }
                    else
                    {
                        $this->upload->initialize($config2);
                        if(! $this->upload->do_upload('userfile2')){
                            $error = array('error' => $this->upload->display_errors('userfile2'));
                            $data2 = array('upload_data' => $this->upload->data('userfile2'));
                        }else{
                             $data2 = array('upload_data' => $this->upload->data('userfile2'));
                        }
                        
                        $data = array('upload_data' => $this->upload->data());
                        if($data)
                        {
                            $post['dok_app'][$i] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/dataapp/' . $fileName.".rar";
                            $post['dok_how'][$i] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/datahowto/' . $fileName2.".pdf";
                            $data['id_doc'] = $this->fdbc->add(array(
                            'id_fitur' => $id_fitur,
                            'versi_a' => $post['versi_a'] ,
                            'versi_b' => $post['versi_b'],
                            'versi_c' => $post['versi_c'],
                            'no_surat' => $post['no_surat'],
                            'status' => $post['status'],
                            'dok_app' => $post['dok_app'][$i],
                            'dok_how' => $post['dok_how'][$i]));
                        }
                    }
                }
                
            }


            else{

                if (empty($_FILES['dok_link2']))
                {
                    $this->form_validation->set_rules('dok_link2', 'Document', 'required');
                }          

                $this->form_validation->set_error_delimiters('<li>', '</li>');

                if(! $this->upload->do_upload('dok_link2')){
                    $error = array('error' => $this->upload->display_errors());
                    $data = array('upload_data' => $this->upload->data('dok_link2'));
                    echo var_dump($error);exit;
                }
                else
                {
                    

                    $nama_fitur= str_replace (' ','_',$nama_fitur);
                    $nama_app= str_replace (' ','_',$nama_app); 
                    $tipe_fitur = str_replace (' ','_',$tipe_fitur); 
                    

                    $fileName = $nama_app . "_Fitur_".$nama_fitur. "_V_".$versi_app . "(".$tipe_fitur.")";
                    $fileName2 = "How_To_". $nama_app . "_Fitur_".$nama_fitur. "_V_".$versi_app . "(".$tipe_fitur.")";

                    $config['file_name'] = $fileName;
                    $config2['file_name'] = $fileName2;

                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    $this->upload->initialize($config2);

                    if(! $this->upload->do_upload('dok_HowTo2')){
                        $error = array('error' => $this->upload->display_errors('dok_HowTo2'));
                        $data2 = array('upload_data' => $this->upload->data('dok_HowTo2'));
                    }else{
                         $data2 = array('upload_data' => $this->upload->data('dok_HowTo2'));
                    }

                    $data = array('upload_data' => $this->upload->data('dok_link2'));
                    if($data)
                    {
                        $post['dok_app'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/dataapp/' . $fileName.".rar";
                        $post['dok_how'] = 'http://' . $_SERVER['SERVER_NAME'].'/portalosd/uploads/datahowto/' . $fileName2.".pdf";
                        $data['id_doc'] = $this->fdbc->add(array(
                        'id_fitur' => $id_fitur,
                        'versi_a' => $post['versi_a'] ,
                        'versi_b' => $post['versi_b'],
                        'versi_c' => $post['versi_c'],
                        'no_surat' => $post['no_suratz'],
                        'status' => $post['status'],
                        'dok_app' => $post['dok_app'],
                        'dok_how' => $post['dok_how'] ));
                    }
                }
            }

            if ($data['id_doc']) {
                    writelog('success', "Pegajuan Dokumen Aplikasi dengan id {$data['id_doc']} Sukses.");
                    flash_succ("Pengajuan Dokumen Aplikasi '{$nama_app}' Versi '{$versi_app}' Sukses.");
                } else {
                    writelog('error', "Pengajuan Dokumen Aplikasi Gagal. Dari databasenya. ");
                    flash_err('Pengajuan Dokumen Aplikasi Gagal. Mohon periksa kembali formulir wajib.');
                }
                redirect(base_url("pengajuan/"));
               
            
        }


        //$data["id_app"]  = $id_app;
        
        $data['title']   = 'Pengajuan';
        $data['active']  = 'Pengajuan';
        $this->aktif     = 'Pengajuan';
        $this->fitur     = 'Tambah';
        $data['nama']  = $this->fdb->get_nama();
        $data['nama_app'] = $this->fdba->get_nama_app();
        //$data['nama_fitur'] = $this->fdbb->get_nama_fitur();
        $data['content'] = 'pengajuan_form';
        
        $data['plugins'] = array('daterangepicker','fitur','wizard');

        $this->load->view('template', $data);
    }

    function haha(){
        $data = $this->fdba->get_nama_app();
        echo json_encode($data);
    }

    public function konfit() {
        $id = $this->input->post('id_app');
        $sql = $this->fdbb->get_row_by_app($id);
        //$this->load->view("content/dropdown_list_fitur", $sql);
        echo json_encode($sql);
    }

    public function getfit() {
        $id = $this->input->post('id_app');
        $sql = $this->fdbb->get_row_by_app($id);
        //$this->load->view("content/dropdown_list_fitur2", $sql);
        echo json_encode($sql);
    }

    public function getapp(){
        //$id = $this->input->post('id_app');
        $sql = $this->fdba->get_nama_app();
        echo json_encode($sql);
    }

    public function getFiturBasedApp(){
        $id_app = $this->input->post("id_app");
        $data["fitur"] = $this->fdbb->get_row_by_apps($id_app);
        $this->load->view("content/list_fitur_by_app", $data);
    }

    public function lists()
    {
        $data['title']   = 'Pengajuan';
        $data['active']  = 'pengajuan';
        $this->fitur     = 'Tambah';
        $this->aktif     = 'Pengajuan';
        $data['content'] = 'konfirmasi_form';
        $data['plugins'] = array('datatables2','wizard');
        $data['projek']  = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    

    protected function delete($id_doc = 0)
    {
        $projek = $this->fdb->get_row($id_doc);
        $result = $this->fdb->delete($id_doc);
        //$versi_app = $post['versi_a'] . $post['versi_b'] . $post['versi_c'];
        if ($result) {
            writelog('success', "Hapus projek id ({$projek->id_doc}) Sukses.");
            flash_succ("Hapus projek id  '{$versi_a}' Sukses.");
        } else {
            writelog('error', "Hapus projek id ({$projek->id_doc}) Gagal.");
            flash_err("Hapus  projek  '{$versi_a}' Gagal.");
        }
        redirect(base_url("data_projek/action/view/". $id_app));
    }

    public function get_allproject(){
        $kode=$this->input->post('kode',TRUE);

        $query=$this->fdb->get_project($kode);
        $json_array = array();
        foreach ($query as $row)
            $json_array[]=$row->nama_project;
        echo json_encode($json_array);      
    }

    


    public function upload_file()
    {
        $data['title']   = 'Pengajuan';
        $data['active']  = 'Pengajuan';
        $this->fitur     = 'Upload';
        $data['content'] = 'data_projek_form_upload';
        $data['plugins'] = array('');

        $this->load->view('template', $data);
    }


    
}
