<?php 


function get_notif_vendor()
{
    $CI =& get_instance();
    $CI->load->model('M_data_vendor');
    $CI->load->model('M_helper_notif');
    $lama = $CI->M_data_vendor->get_setting();
    $data = $CI->M_helper_notif->get_notif_vendor($lama->sv_value);
    return $data->total;
}

function get_notif_user()
{
    $CI =& get_instance();
    $CI->load->model('M_helper_notif');
    $data = $CI->M_helper_notif->get_notif_user();
    return $data->total;
}

function get_notif_issue()
{
    $CI =& get_instance();
    $CI->load->model('M_helper_notif');
    $data = $CI->M_helper_notif->get_notif_issue();
    return $data->total;
}