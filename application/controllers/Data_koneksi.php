<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_koneksi extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_data_koneksi', 'fdb');
        $this->cname = 'data_koneksi';
        $this->menu = 'Koneksi';
        $this->fitur = '';
        $this->fitur2 = '';

        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
        $this->active_user_id = get_session('user_id');
    }

    public function index() {
        $this->lists();
    }

    public function action($func = '', $id = 0, $size = "") {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
                if (!empty($id) && !empty($size)) {
                    $this->$func($id, $size);
                } else if (!empty($id)) {
                    $this->$func($id);
                }
                else if( empty($id)){
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
        $data['title'] = 'Koneksi';
        $data['active'] = 'data_koneksi';
        $this->fitur = 'Daftar';
        $data['content'] = 'data_koneksi_list';
        $data['plugins'] = array('datatables2', 'management_koneksi');
       // $data['issue'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function get_app(){
        //$id = $this->input->post('id_app');
        $sql = $this->fdb->get_nama_app();
        echo json_encode($sql);
    }

    public function get_fiturr() {
        $id = $this->input->post('id_app');
        $sql = $this->fdb->get_row_by_app($id);
        //$this->load->view("content/dropdown_list_fitur", $sql);
        echo json_encode($sql);
    }

    public function add() {

        if ($this->input->post()) {
            $aplikasi_from = $this->input->post('aplikasi_from');
            $fitur_from = $this->input->post('fitur_from');
            $jenis_fitur_from = $this->input->post('jenis_fitur_from');
            $ip_from = $this->input->post('ip_from');
            $deskripsi = $this->input->post('deskripsi');

            date_default_timezone_set('Asia/Jakarta');
            $data_apps['tgl_input'] = date('Y-m-d H:i:s', time());
            $data_apps['nama_app'] = $aplikasi_from;
            $data_apps['des_app'] = $deskripsi;
            $cek_apps = $this->fdb->cek_apps($aplikasi_from);
            if($cek_apps > 0)
            {
                $apps = $this->fdb->get_apps($aplikasi_from);
                // foreach ($apps as $key) {
                //     # code...
                //     $id_apps = $key->id_app;
                // }    
                $id_apps = $apps->id_app;        
            }
            else
            {
                $id_apps = $this->fdb->insert_apps($data_apps);
            }
            $data_fitur['id_app'] = $id_apps;
            $data_fitur['tipe_fitur'] = $jenis_fitur_from;
            $data_fitur['nama_fitur'] = $fitur_from;
            $data_fitur['ip_fitur'] = $ip_from;
            $data_fitur['tgl_input'] = date('Y-m-d H:i:s', time());
            $tgl_input = $data_fitur['tgl_input'];
            $id_fitur = $this->fdb->insert_fitur($data_fitur);

            if($jenis_fitur_from != "Database"){
                $apps_to = $this->input->post('aplikasi_to');
                $fitur_to = $this->input->post('fitur_to');
                $jenis_fitur_to = $this->input->post('jenis_fitur_to');
                $ip_to = $this->input->post('ip_to');
                $total = count($apps_to);
                $data_koneksi = "";
                for($i=0; $i<$total; $i++){
                    $data_koneksi.= "('".$id_apps."','".$id_fitur."','".$apps_to[$i]."','".$fitur_to[$i]."','".$jenis_fitur_to[$i]."','".$ip_to[$i]."','".$tgl_input."'),";
                }
                $result = $this->fdb->insert_koneksi($data_koneksi);
            }
            

            

            //$result = $this->fdb->add($data, $data_record);
            if ($result) {
                    writelog('success', "Tambah Koneksi Baru Sukses.");
                    flash_succ("Tambah Koneksi Baru Sukses.");
                } else {
                    writelog('error', "Tambah Koneksi Baru Gagal. Dari databasenya. , {$aplikasi_from}");
                    flash_err("Tambah Koneksi Baru. Mohon periksa kembali formulir wajib.{$this->input->post('aplikasi_to')}  {}");
                }
            
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Koneksi';
        $data['active'] = 'data_issue';
        $this->fitur = 'Add';
        $data['content'] = 'data_koneksi_form';
        $data['plugins'] = array('datatables');
       // $data['issue'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    protected function view($id_app = '', $id_fitur = '') {
        //$id = decode($id);
        $data['title']         = 'Data Koneksi ';
        $data['active']        = 'data_koneksi';
        $this->fitur           = 'Lihat';
        $data['data_koneksi'] = $this->fdb->get_koneksi($id_app, $id_fitur);
        $data['data_fitur'] = $this->fdb->get_fitur($id_app, $id_fitur);
        $data['content'] = 'data_koneksi_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function add_connect($id_app = "", $id_fitur ="")
    {
        //belum selesai
        if ($_POST!=NULL) {

            $post = $this->input->post();
            
            //print_r($_POST); exit();
            date_default_timezone_set('Asia/Jakarta');
            $tgl_input = date('Y-m-d H:i:s', time());

            $total = $post['angka'];
            /*for($i=0; $i<$total; $i++){
                $post['koneksi_ips'][$i] = '';
            }*/

            for($i=0; $i<$total; $i++){
                $nama_apps = $post['koneksi_apps'][$i];
                $nama_apps = $this->fdb->get_nama($nama_apps);
                $nama_apps = $nama_apps->nama_app;

                if(($post["koneksi_fiturs"][$i]!='FTP') && ($post["koneksi_fiturs"][$i]!='Pihak Ketiga'))
                {
                    $nama_fiturs = $post["koneksi_fiturs"][$i];
                    $x_fitur = $this->fdb->get_ip($nama_fiturs);

                    $fitur_ip = $x_fitur->ip_fitur;
                    $fitur_tipe = $x_fitur->tipe_fitur;
                }
                else
                {
                    $fitur_ip = $post['koneksi_ips'][$i];
                    $fitur_tipe = 'Lain-lain';
                }
                
                    //print_r($nama_apps);
                    //print_r($)

                $data['id_koneksi'] = $this->fdb->add(array(
                    'id_app' => $id_app,
                    'id_fitur' => $id_fitur,
                    'konekTo_app' => $nama_apps ,
                    'konekTo_fitur' => $post['koneksi_fiturs'][$i],
                    'konekTo_tipe_fitur' => $fitur_tipe,
                    'konekTo_ip_fitur' => $fitur_ip));
                    $id_koneksi=$data['id_koneksi'];
                    //print_r($data['id_koneksi']);
                }

            
            if ($data['id_koneksi']) {
                    writelog('success', "Tambah Koneksi Baru Sukses.");
                    flash_succ("Tambah  Koneksi Baru Sukses.");
                } else {
                    writelog('error', "Tambah Koneksi Baru Gagal. Dari databasenya. ");
                    flash_err('Tambah Koneksi Baru. Mohon periksa kembali formulir wajib.');
                }
            
            redirect(base_url($this->cname));
        }
        $data['data_fitur'] = $this->fdb->get_fitur($id_app, $id_fitur);
        $data['title'] = 'New Connection';
        $data['active'] = 'data_koneksi';
        $this->fitur = 'Tambah Koneksi';
        $this->fitur2 = '';
        $data['content'] = 'data_koneksi_form';
        $data['plugins'] = array('daterangepicker','koneksi_eksis','popconfirm');

        $this->load->view('template', $data);
    }

    protected function edit_koneksi($id_koneksi = 0)
    {
        if ($this->input->post()) {
            //print_r($_POST);exit;
            date_default_timezone_set('Asia/Jakarta');
            $data['tgl_input'] = date('Y-m-d H:i:s', time());

            $post= $this->input->post();

            $detailya = $this->fdb->detailya($id_koneksi);

            $id_app = $detailya->id_app;
            $id_fitur = $detailya->id_fitur;

            $nama_apps = $post['koneksi_apps'];
            $nama_apps = $this->fdb->get_nama($nama_apps);
            $nama_apps = $nama_apps->nama_app;

            if(($post["koneksi_fiturs"]!='FTP') && ($post["koneksi_fiturs"]!='Pihak Ketiga'))
            {
                $nama_fiturs = $post["koneksi_fiturs"];
                $x_fitur = $this->fdb->get_ip($nama_fiturs);

                $fitur_ip = $x_fitur->ip_fitur;
                $fitur_tipe = $x_fitur->tipe_fitur;
            }
            else
            {
                $fitur_ip = $post['koneksi_ips'];
                $fitur_tipe = 'Lain-lain';
            }

            $result = $this->fdb->update_koneksi($id_koneksi, array(
                    'konekTo_app' => $nama_apps,
                    'konekTo_fitur' => $post['koneksi_fiturs'],
                    'konekTo_tipe_fitur' => $fitur_tipe,
                    'konekTo_ip_fitur' => $fitur_ip));
            
            //$result = $this->fdb->update_koneksi($id_koneksi, $data);
            if ($result > 0) {
                    writelog('success', "Edit Koneksi Sukses.");
                    flash_succ("Edit  Koneksi Sukses.");
                } else {
                    writelog('error', "Edit Koneksi Gagal. Dari databasenya. ");
                    flash_err('Edit Koneksi Gagal. Mohon periksa kembali formulir wajib.');
                }
            
            redirect("/data_koneksi/action/view/".$id_app."/".$id_fitur);
        }
        $data['data_koneksi'] = $this->fdb->get_list_koneksi($id_koneksi);
        $data['title'] = 'Edit Connection';
        $data['active'] = 'data_koneksi';
        $this->fitur = 'Edit Koneksi';
        $this->fitur2 = '';
        $data['content'] = 'data_koneksi_form';
        //$data['kategori'] = $this->fdb->get_all();
        //$data['issue'] = $this->fdb->get_all();
        $data['plugins'] = array('daterangepicker','koneksi_eksis','popconfirm');

        $this->load->view('template', $data);
    }

    public function delete($id_apps = 0, $id_fitur = 0)
    {
        $result = $this->fdb->delete_apps($id_apps, $id_fitur);
        if ($result) {
            writelog('success', "Hapus Koneksi Sukses.");
            flash_succ("Hapus Koneksi  Sukses.");
        } else {
            writelog('error', "Hapus Koneksi  Gagal.");
            flash_succ("Hapus Koneksi  Gagal.");
        }
        redirect("/data_koneksi/action/view/".$id_apps."/".$id_fitur);
    }

    public function delete_koneksi($id_koneksi=0)
    {   
        $detailya = $this->fdb->detailya($id_koneksi);

        $id_app = $detailya->id_app;
        $id_fitur = $detailya->id_fitur;
        $result = $this->fdb->delete_conn($id_koneksi);
        
        if ($result) {
            writelog('success', "Hapus Koneksi Sukses.");
            flash_succ("Hapus Koneksi Sukses.");
        } else {
            writelog('error', "Hapus Koneksi Gagal.");
            flash_succ("Hapus Koneksi Gagal.");
        }
        redirect("/data_koneksi/action/view/".$id_app."/".$id_fitur);   
    }

    public function ajax_list_data_koneksi()
    {
        

        $list = $this->fdb->get_datatables_data_koneksi('(SELECT a.id_app id_app, b.id_fitur id_fitur, a.nama_app nama_app, b.nama_fitur nama_fitur, b.tipe_fitur tipe_fitur, b.ip_fitur ip_fitur FROM dataaplikasi a right join datafitur b on a.id_app=b.id_app) x', array('id_app, id_fitur, nama_app, nama_fitur, tipe_fitur, ip_fitur, total_koneksi'), array('id_app, id_fitur, nama_app, nama_fitur, tipe_fitur, ip_fitur, total_koneksi'), array('x.id_app'=>'asc'));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->nama_app;
            $row[] = $list->nama_fitur;
            $row[] = $list->tipe_fitur;
            $row[] = $list->ip_fitur;
            $row[] = $list->total_koneksi;
            
            if (($this->active_privilege == "superadmin") || ($this->active_privilege == "signer") || ($this->active_privilege == "checker")) {
                
                if(($list->tipe_fitur =="Database") || ($list->tipe_fitur ==""))
                {
                    $row[] = "<td style='text-align:center' width='140px'>
                            <a title='Lihat' href='".base_url().'data_koneksi/action/view/'.$list->id_app.'/'.$list->id_fitur."' class='btn btn-circle btn-sm bg-green'>
                                <i class='fa fa-folder'> Lihat</i>
                            </a>

                        </td>";
                }
                else
                {
                    $row[] = "<td style='text-align:center' width='140px'>
                            <a title='Lihat' href='".base_url().'data_koneksi/action/view/'.$list->id_app.'/'.$list->id_fitur."' class='btn btn-circle btn-sm bg-green'>
                                <i class='fa fa-folder'> Lihat</i>
                            </a>
                            <a title='Add Connection' href='".base_url().'data_koneksi/action/add_connect/'.$list->id_app.'/'.$list->id_fitur."' class='btn btn-circle btn-sm bg-orange'>
                                <i class='fa fa-plus'> Tambah</i>
                            </a>

                        </td>";
                }
               

             }
             elseif( $this->active_privilege== "maker") { 
                    $row[] = "<td style='text-align:center' width='140px'>
                                <a title='Lihat' href='".base_url().'data_koneksi/action/view/'.$list->id_app.'/'.$list->id_fitur."' class='btn btn-circle btn-sm bg-green'>
                                    <i class='fa fa-folder'> Lihat</i>
                                </a>

                            </td>";
               }
            $data[] = $row;
        }
          
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->fdb->count_all_data_koneksi('(SELECT a.id_app id_app, b.id_fitur id_fitur, a.nama_app nama_app, b.nama_fitur nama_fitur, b.tipe_fitur tipe_fitur, b.ip_fitur ip_fitur FROM dataaplikasi a right join datafitur b on a.id_app=b.id_app) x', array('id_app, id_fitur, nama_app, nama_fitur, ip_fitur, total_koneksi'), array('id_app, id_fitur, nama_app, nama_fitur, tipe_fitur, ip_fitur, total_koneksi'), array('x.id_app'=>'asc')),
                        "recordsFiltered" => $this->fdb->count_filtered_data_koneksi('(SELECT a.id_app id_app, b.id_fitur id_fitur, a.nama_app nama_app, b.nama_fitur nama_fitur, b.tipe_fitur tipe_fitur, b.ip_fitur ip_fitur FROM dataaplikasi a right join datafitur b on a.id_app=b.id_app) x', array('id_app, id_fitur, nama_app, nama_fitur, ip_fitur, total_koneksi'), array('id_app, id_fitur, nama_app, nama_fitur, tipe_fitur, ip_fitur, total_koneksi'), array('x.id_app'=>'asc')),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}