<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        //$this->load->view('welcome_message');

        $z=1;
        for ($i=5;$i>=1;$i--){
            for($j=5;$j>=$i;$j--){ //spasi
                echo "$z";
            }
            
            for($k=1;$k<=$i;$k++){ //bintang
                echo "*";
            }
            for ($l=1;$l<=$i-1;$l++){
                echo "*";
            }
             for($j=4;$j>=$i-1;$j--){ //spasi
                echo "$z";
            }
            echo "<br>";
            $z++;
        } 
        
        
        for ($i=1;$i<=5;$i++){
            for($j=4;$j>=$i;$j--){ //spasi
                echo "&nbsp&nbsp";
            }
            for($k=1;$k<=$i;$k++){ //bintang
                echo "*";
            }
            for ($l=1;$l<=$i-1;$l++){
                echo "*";
            }
            echo "<br>";
        }
        
        $x = "12345";
         
        echo encode($x);
        $y = encode($x);
        echo "<br>";
        echo decode($y);
        $t = decode($y);
        echo "<br>";
        echo encode($t);
        
        
       
 

    }

}
