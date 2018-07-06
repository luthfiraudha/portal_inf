<?php

function succ_msg($param) {
    return '<div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                  ' . $param . '</div>';
}

function warn_msg($param) {
    return '<div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    ' . $param . '</div>';
}

function err_msg($param) {
    return '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                   ' . $param . '</div>';
}

function info_msg($param) {
    return '<div class="alert alert-info alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    ' . $param . '</div>';
}

function flash_succ($msg) {
    $CI = & get_instance();
    $msg = succ_msg($msg);
    $CI->session->set_flashdata('message', $msg);
}

function flash_warn($msg) {
    $CI = & get_instance();
    $msg = warn_msg($msg);
    $CI->session->set_flashdata('message', $msg);
}

function flash_info($msg) {
    $CI = & get_instance();
    $msg = info_msg($msg);
    $CI->session->set_flashdata('message', $msg);
}

function flash_err($msg) {
    $CI = & get_instance();
    $msg = err_msg($msg);
    $CI->session->set_flashdata('message', $msg);
}

function cetak_flash_msg() {
    $CI = & get_instance();
    echo $CI->session->flashdata('message');
}

?>