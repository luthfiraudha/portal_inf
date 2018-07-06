<?php

function writelog($alert = '', $message = '') {
    $CI = & get_instance();
    $sekarang = unix_to_human(now(), TRUE, 'id');
    $user = get_session('user_pn');
    $tglsekarang = date('d-m-Y');
    $log = "\r\n[" . $sekarang . '] ' . $CI->input->ip_address() . ' user_pn::::: ' . $user . ' <<<_ ' . $message . ' _>>>';
    if ($alert == 'success')
        $filepath = "./log/appsucc[{$tglsekarang}].log";
    elseif ($alert == 'error')
        $filepath = "./log/appfail[{$tglsekarang}].log";
    write_file($filepath, $log, 'a');
    return;
}

function inputlog() {
    $CI = & get_instance();
    if ($CI->agent->is_browser()) {
        $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
    } elseif ($CI->agent->is_robot()) {
        $agent = $CI->agent->robot();
    } elseif ($CI->agent->is_mobile()) {
        $agent = $CI->agent->mobile();
    } else {
        $agent = 'Unidentified User Agent';
    }
    $user = get_session('user_pn');
    $data = array(
        'log_user_pn'=> $user,
        'log_ip' => $_SERVER['REMOTE_ADDR'],
        'log_os' => $CI->agent->platform(),
        'log_browser' => $agent
    );
    $CI->load->model('m_log_login');
    $data['log_id'] = $CI->m_log_login->add($data);

    if(empty($data['log_id'])){
        return FALSE;
    }else{
        return TRUE;
    }
}

?>