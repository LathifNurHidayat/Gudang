<?php
function format_rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}



function delete_decimal($number)
{
    return rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.');
}


function check_access($id_role, $id_menu){
    $CI = get_instance();

    $where = ['id_role' => $id_role, 'id_menu' =>$id_menu];
    $cek_access = $CI->db->get_where('tb_user_access_menu', $where);

    if($cek_access->num_rows() > 0) return 'checked';
    else return '';
}

?>