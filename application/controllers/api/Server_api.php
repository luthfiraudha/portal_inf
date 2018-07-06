<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . 'libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Server_api extends REST_Controller {

    function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('m_data_issue', 'fdb');
        $this->load->model('m_kategori_issue', 'k_fdb');
        $this->load->model('m_mdsc', 'mdsc');
        $this->load->model('m_data_sop', 'sop');
    }


 
    function cek_post(){
        $post['id_eskalasi'] = $this->input->post('id_problem');
        $post['kategori_nama'] = $this->input->post('jenis_problem');
        $post['tgl_input'] = $this->input->post('tgl_problem');
        $post['isi'] = $this->input->post('konten_problem'); 

        $this->response(array('status' => true, 'data'=>$post, 'msg' => 'Data Berhasil disimpan'), 200);
    }

    function addticket_post(){
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

        $post['id'] = $tnum;
        $post['id_eskalasi'] = $this->input->post('id_problem');
        $post['kategori_nama'] = $this->input->post('jenis_problem');
        $post['tgl_input'] = $this->input->post('tgl_problem');
        $post['isi'] = $this->input->post('konten_problem'); 
        $post['isi'] = 'Eskalasi untuk OSD: '.$post['isi'];      
        $post['type'] = 'Problem';
        $post['status'] = "belum dikerjakan";          
        $post['pinned'] =0;
        $cek_kategori = $this->k_fdb->cek_kategori($post['kategori_nama']);


         if (!$cek_kategori) {                
                $post['kategori_nama'] = strtolower($post['kategori_nama']);
                $kategori_id = $this->k_fdb->add($post['kategori_nama']);

                if ($kategori_id) {
                    $post['kategori_id'] = $kategori_id;
                    unset($post['kategori_nama']);
                    $add = $this->fdb->add($post);

                    if ($add) {
                        $this->response(array('status' => true,  'msg' => 'Data Berhasil disimpan'), 200);
                    } else {
                        $this->response(array('status' => false, 'msg' => 'Data tidak berhasil disimpan!!'), 500);
                    }
                } else {

                     $this->response(array('status' => false, 'msg' => 'Data tidak berhasil disimpan!!'), 500);
                }
                $this->response(array('status' => false, 'msg' => 'Data tidak berhasil disimpan!!'), 500);
            } else if ($cek_kategori && $post['kategori_nama'] != '') {
                 
                foreach ($cek_kategori as $key) {
                   $post['kategori_id'] = $key->kategori_id;
                 }
                
                unset($post['kategori_nama']);
                $add = $this->fdb->add($post);
                if ($add) {
                    $this->response(array('status' => true,  'msg' => 'Data Berhasil disimpan'), 200);
                } else {
                    $this->response(array('status' => false, 'msg' => 'Data tidak berhasil disimpan!!'), 500);
                }
            }

    }


    function getstatus_get($id_problem =0){

        $status = $this->fdb->getstatus_row($id_problem);
        if ($id_problem != 0) {
            if ($status) {
                $data['status'] = $status->status;
                $this->response(array('status' => true, 'data' => $data, 'msg' => 'get data berhasil !!'), 200);
            } else {
                $this->response(array('status' => false, 'msg' => 'get data tidak berhasil!!'), 500);
            }
        } else {
            $this->response(array('status' => false, 'msg' => 'get data tidak berhasil!!'), 500);
        }
    }


}
