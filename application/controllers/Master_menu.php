<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

        $this->load->model('m_master_menu', 'fdb');
        $this->load->model('m_master_hak_akses', 'akses_fdb');
        $this->cname = 'master_menu';
        $this->menu = 'Master Menu';
        $this->fitur = '';


        $this->active_user = get_session('user_nama');
        $this->active_privilege = get_session('user_akses');
    }

    public function index() {
        $this->lists();
    }

    public function action($func = '', $id = 0) {
        if (!is_direct()) {
            $trimfunc = trim($func);
            if (!empty($trimfunc)) {
                if (!empty($id))
                    $this->$func($id);
                else if (empty($id))
                    $this->$func();
            }
            else {
                flash_err("Akses ditolak.");
                redirect(base_url($this->cname));
            }
        } else {
            flash_err("Akses ditolak.");
            redirect(base_url($this->cname));
        }
    }

    public function lists() {
        $data['title'] = 'Master Menu';
        $data['active'] = 'master menu';
        $this->fitur = 'Daftar';
        $data['content'] = 'master_menu_list';
        $data['plugins'] = array('datatables');
        $data['menu'] = $this->fdb->get_all();
        $this->load->view('template', $data);
    }

    public function add() {
        
        if ($this->input->post()) {
            $post = $this->input->post();
           
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');

            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Tambah Menu Baru Gagal. " . validation_errors());
                flash_err('Tambah Menu Baru Gagal. <ul>' . validation_errors() . '</ul>');
                redirect(base_url($this->cname) . '/add');
            }

            $post['hak_akses'] = implode('|', $post['hak_akses']);
            $data['id'] = $this->fdb->add($post);
            if ($data['id']) {
                writelog('success', "Tambah Menu Baru dengan id {$data['id']} Sukses.");
                flash_succ("Tambah Menu Baru `{$post['name']}` Sukses.");
            } else {
                writelog('error', "Tambah Menu Gagal. Dari databasenya. ");
                flash_err('Tambah Menu Gagal. Mohon periksa kembali formulir wajib.');
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Master Menu';
        $data['active'] = 'master menu';
        $this->fitur = 'Tambah';
        $data['content'] = 'master_menu_form';
        $data['menu'] = $this->fdb->get_all();
        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['plugins'] = array('popconfrim');

        $this->load->view('template', $data);
    }

    protected function edit($id_menu= '') {
        if ($this->input->post()) {
            $post = $this->input->post();
            $menu_id = $post['id'];

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('link', 'Link', 'required');
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            
            if ($this->form_validation->run() === FALSE) {
                writelog('error', "Ubah Menu id {$id_satuan} Gagal. " . validation_errors());
                flash_err("Ubah Menu `{$post['name']}` Gagal. <ul>" . validation_errors() . '</ul>');
                redirect(base_url($this->cname . '/action/edit/' . $id_menu));
            }

            $availability = $this->fdb->cek_unique_update($post['nama'], $id_menu);
            if ($availability) {
                writelog('error', "Ubah Menu id {$id} Gagal. Nama telah diambil.");
                flash_err("Ubah Menu Gagal. Menu `{$post['name']}` telah diambil. Silakan gunakan nama lain dan link lain.");
                redirect(base_url($this->cname . '/action/edit/' .$id_menu));
            }

            unset($post['id']);
            $post['hak_akses'] = implode('|', $post['hak_akses']);
            $result = $this->fdb->update($id_menu, $post);

            if ($result === FALSE) {
                writelog('error', "Ubah Menu id {$id} Gagal.");
                flash_err("Ubah Menu '{$post['name']}' Gagal. Periksa kembali formulir wajib.");
            } else {
                if ($result > 0) {
                    writelog('success', "Ubah Menu id {$id} Sukses.");
                    flash_succ("Ubah Menu '{$post['name']}' Sukses.");
                } else {
                    writelog('warning', "Ubah Menu id {$id} Gagal. Tidak ada data yang berubah.");
                    flash_warn("Ubah Menu Gagal. Tidak ada data yang berubah.");
                }
            }
            redirect(base_url($this->cname));
        }

        $data['title'] = 'Master Menu';
        $data['active'] = 'master menu';
        $this->fitur = 'Ubah';
        $data['menu_detail'] = $this->fdb->get_row($id_menu);
        $data['menu'] = $this->fdb->get_all();
        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['content'] = 'master_menu_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function view($id_menu = '') {
        $data['title'] = 'Master Menu';
        $data['active'] = 'master menu';
        $this->fitur = 'Lihat';
        $data['menu_detail'] = $this->fdb->get_row($id_menu);
        $data['hak_akses'] = $this->akses_fdb->get_all();
        $data['content'] = 'master_menu_form';
        $data['plugins'] = array('popconfirm');

        $this->load->view('template', $data);
    }

    protected function delete($id_menu = 0) {
        $menu = $this->fdb->get_row($id_menu);
        $result = $this->fdb->delete($id_menu);
        if ($result) {
            writelog('success', "Hapus Menu id ({$menu->id}) {$menu->name} Sukses.");
            flash_succ("Hapus Menu  '{$menu->name}' Sukses.");
        } else {
            writelog('error', "Hapus Menu id ({$menu->id}) {$menu->name} Gagal.");
            flash_err("Hapus Menu '{$menu->name}' Gagal.");
        }
        redirect(base_url($this->cname));
    }

    public function ordermenu(){
        if ($this->input->post()) {
               
            $i = 1;
            $result = array();

            foreach ($_POST['order'] as $value) {
                $data = array(
                   'is_order' => $i
                  
                );

                $result[] = $this->fdb->update($value, $data);
                $i++;
                
            }

            if ($result === FALSE) {
                writelog('error', "save order gagal.");
                flash_err("Save Order menu gagal");
            } else {
                if ($result > 0) {
                    writelog('success', "Save Order menu sukses.");
                    flash_succ("Save Order menu sukses.");
                } else {
                    writelog('error', "save order gagal.");
                    flash_err("Save Order menu gagal");
                }
            }
            redirect(base_url($this->cname."/ordermenu"));
        }


        $data['title'] = 'Order Menu';
        $data['active'] = 'master menu';
        $this->fitur = 'list';
        $data['content'] = 'master_menu_order';
        $data['plugins'] = array('order_menu');
        $data['menu'] = $this->fdb->getordered();
        $this->load->view('template', $data);
    }

}
