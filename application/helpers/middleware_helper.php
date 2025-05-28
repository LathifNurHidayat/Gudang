<?php
function middleware_login()
{
    $CI =& get_instance();
    if ($CI->session->userdata('is_login') == false) {
        $CI->session->set_flashdata('msg', alert_warning('Silahkan login terlebih dahulu'));
        redirect('auth/form_login');
    }
}

function middleware_access()
{
    $CI = get_instance();
    $segment = $CI->uri->segment(1);
    $menu = $CI->db->get_where('tb_user_menu', ['menu' => $segment])->row_array();

    $id_role = $CI->session->userdata('id_role');
    $id_menu = $menu['id_menu'];

    $check_access = $CI->db->get_where('tb_user_access_menu', ['id_role' => $id_role, 'id_menu' => $id_menu]);

    if ($check_access->num_rows() < 1) {
        redirect('blocked');
        die;;
    }
}
?>