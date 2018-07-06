<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_auth', 'fdb');
        $this->cname = 'auth';
        $this->menu = 'Authorization';
        $this->fitur = '';
        $this->active_user = '';
    }

    public function index() {
        
        $this->login();
    }

    private function login() {
		$this->load->library('client_soapad');
        //------------- LOGIN AUTH LOGIC --------------------
        if (cek_auth()) {//helper - kalo session ada isi maka masuk dashboard
            redirect(base_url('Dashboard'));
        } else {

            if ($this->input->post()) {

                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
                $sekarang = unix_to_human(now(), TRUE, 'id');
                if ($this->form_validation->run() == FALSE) {

                    $data['alert']['class'] = 'danger';
                    $data['alert']['message'] = validation_errors();
                    $sekarang = unix_to_human(now(), TRUE, 'id');
                    $log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' alert = ' . $data['alert']['message'];
                    write_file('./log/logattfail.log', $log, 'a');
                } else {

                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $passworden = encode($password);
                    $isLogin = $this->client_soapad->validate($this->setFormatPernr($username),$password);
					$isLogin2 = $this->fdb->cek_user($username,$passworden);
					
					if($isLogin || $isLogin2){
					//echo var_dump($isLogin);die;
						$result = $this->fdb->cek_user2($username);
					
						if ($result) {

							$this->session->set_userdata('portalosd', $result);
							if ($this->session->has_userdata('portalosd')) {
								$log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' ' . $username;
								write_file('./log/logattfail.log', $log, 'a');
								inputlog();
								redirect(base_url('Dashboard'));
							}
						} else {
							$log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' unama = ' . $username . ' && pass = ' . $password;
							write_file('./log/logattfail.log', $log, 'a');
							$data['alert']['class'] = 'danger';
							$data['alert']['message'] = 'Username / Password is wrong or User not Activated.';
						}
					
					}else{
					
						$log = "\r\n[" . $sekarang . '] ' . $this->input->ip_address() . ' unama = ' . $username . ' && pass = ' . $password;
						write_file('./log/logattfail.log', $log, 'a');
						$data['alert']['class'] = 'danger';
						$data['alert']['message'] = 'Username / Password is wrong or User not Activated.';
						
					
					}
                }
            }

            //--------------END LOGIN AUTH LOGIC ----------------
            $data['title'] = 'Login'; //prim1_title
            $data['active'] = ''; //prim3_sidebarmenu
            $data['content'] = ''; //prim5_contentview


            $this->load->view('page/login', $data);
        }
    }

  

    public function logout() {
        //hapus session file saat ini
        $this->session->sess_destroy();
        redirect(base_url($this->cname));
    }
	
	private function setFormatPernr($pernr)
	{
		if(strlen($pernr) < 8)
		{
			$str_nol = '';
			for($i=0; $i<(8 - strlen($pernr)); $i++)
			{
				$str_nol .= '0';
			}
			$pernr = $str_nol . $pernr;
		}

		return $pernr;
	}



    public function test(){



                $aplikasi  = $this->fdb->get_all_app();

                //echo var_dump($data['aplikasi']);die;
                // input misspelled word
                $input = 'tes';

                // array of words to check against
               
               //$words = array('tes 1','lala', 'brinets','bristars','brijamin');
                 $words = array('lala','tesis','set','jukla');
                // foreach ($aplikasi as $key) {
                //     $words[] = $key->nama_app;
                // }
               

                // no shortest distance found, yet
               $shortest = -1;

                // loop through words to find the closest
                foreach ($words as $word) {

                    // calculate the distance between the input word,
                    // and the current word
                    $lev = levenshtein($input, trim($word));



                    $str1len = strlen($input);
                    $str2len = strlen($word);
                    if($str1len > $str2len)
                    {
                    $pct = ($str1len - $lev)/$str1len;
                    }
                    else
                    {
                    $pct = ($str2len - $lev)/$str2len;
                    }
                    $pct = $pct*100;

                   
                   // check for an exact match
                    if ($lev == 0) {

                        // closest word is this one (exact match)
                        $closest = $word;
                        $shortest = 0;

                        // break out of the loop; we've found an exact match
                        break;
                    }





                    // if this distance is less than the next found shortest
                    // distance, OR if a next shortest word has not yet been found
                    if ( ($lev <= $shortest || $shortest < 0) && ($pct>= 75 && $pct<=100)){
                        // set the closest match, and shortest distance
                        $closest  = $word;
                        $shortest = $lev;
                        $pctr = $pct;
                    }else{
                        $closest  = "tidak ketemu";
                        $shortest = $lev;
                        $pctr = $pct;
                    }



                }


                // // loop through words to find the closest
                // foreach ($words as $word) {


                //     similar_text($input, $word, $percent); 
                //     // if($percent == 100){
                //     //     $closest2 = $word;
                //     //     break;
                //     // }

                //     if ($percent >= 60 && $percent <= 99) {
                //         // set the closest match, and shortest distance
                //         $closest2  = $word;
                //     }else{
                //         $closest2 = 'tidak ketemu';
                //     }
                // }

                echo "Input word: $input\n";
                if ($shortest == 0) {
                    echo "Exact match found: $closest\n";
                } else {
                    echo "hasil levenshtein: $closest?\n"." ".$shortest." percent ".$pctr;
                    // echo " Hasil similiar_text:".$closest2." ".$percent;
                }
    }

}
