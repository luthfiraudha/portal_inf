<?php 

function get_session($att='')
{
    $CI =& get_instance();
    $data = $CI->session->userdata('portalosd');
    if(empty($att)) return $data;
    else return $data->$att;
}
//
//function get_periode($param='')
//{
//    $CI =& get_instance();
//    $CI->load->model('M_helper_auth');
//    return $CI->M_helper_auth->get_periode_helper($param);
//}

//fungsi untuk mengecek apakah session masih ada
function cek_auth(){
    $CI =& get_instance();
    $data = $CI->session->userdata('portalosd');
    if(empty($data))
    {
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}
//
//// fungsi untuk mengecek apakah user memiliki hak akses ke fitur pada parameter
//function cek_fitur($nama_fitur){
//    if(cek_auth())
//    {
//        $CI =& get_instance();
//        $CI->load->model('M_helper_auth');
//
//        $data = $CI->session->userdata('portalosd');
//        
//        $allowed = explode('|', $CI->M_helper_auth->get_hak_akses($data->username));
//
//        if(in_array($nama_fitur, $allowed))
//        {
//            return TRUE;
//        }
//        else
//        {
//            return FALSE;
//        }
//    }
//    else
//    {
//        return FALSE;
//    }
//}
//
//function get_fitur($value='')
//{
//    if(cek_auth())
//    {
//        $CI =& get_instance();
//        $CI->load->model('M_helper_auth');
//
//        $data = $CI->session->userdata('rasuna');
//        
//        $fitur = $CI->M_helper_auth->get_hak_akses($data->username);
//
//        if($fitur)return $fitur;
//        else return FALSE;
//    }
//    else
//    {
//        return FALSE;
//    }
//}


?>