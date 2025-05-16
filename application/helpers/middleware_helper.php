<?php
function check_login()
{
    $CI =& get_instance();
    if ($CI->session->userdata('is_login') == false) {
        $CI->session->set_flashdata('msg', alert_warning('Silahkan login terlebih dahulu'));
        redirect('auth/form_login');
    } 
}
?>  