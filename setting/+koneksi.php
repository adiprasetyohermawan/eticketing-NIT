<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "travel_nusantara";
$con = mysqli_connect($host, $user, $pass, $db) or die (mysqli_error());

$base_url = "http://".$_SERVER['SERVER_NAME']."/eticketing-edit";

/*-------------------------------*/
session_start();
ob_start();
date_default_timezone_set('Asia/Jakarta');

function indonesian_date($timestamp = '', $date_format = 'l, j F Y') {
    if (trim ($timestamp) == '') {
            $timestamp = time ();
    } elseif (!ctype_digit ($timestamp)) {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date}";
    return $date;
}

function tgl($tgl) {
    $originalDate = $tgl;
    $newDate = date("d/m/Y", strtotime($originalDate));
    return $newDate;
} 
?>