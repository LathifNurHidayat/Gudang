<?php
function format_rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}



function delete_decimal($number)
{
    return rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.');
}


?>