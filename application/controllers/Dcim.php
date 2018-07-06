<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dcim extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        if (!cek_auth()) {
            flash_err('Login dibutuhkan.');
            redirect(base_url('auth'));
        }

     
        $this->active_user      = get_session('user_nama');
        $this->active_id      = get_session('user_id');
        $this->active_privilege = get_session('user_akses');
    }



    function Redirectto($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }

    public function index()

    {
       
       echo '<script type="text/javascript">
       window.addEventListener("load", 
            function() { 
            window.location.replace("http://172.18.65.19/dcim/index.php/auth/index/'.$this->active_id.'");
        }, true);
      </script>';
        //$this->redirectto('http://localhost/dcim/auth/index/'.$this->active_id, false);

        // redirect (((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http")."://".$_SERVER['HTTP_HOST']."/dcim/auth/index/".$this->active_id);
    }

    

    

}
