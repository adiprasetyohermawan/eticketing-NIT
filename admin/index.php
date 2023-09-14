<?php require "../setting/+koneksi.php";
if(!@$_SESSION['id_adm']) {
    header("location: ".$base_url."/admin/login.php");
} ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Core CSS -->
    <link href="<?=$base_url?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$base_url?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$base_url?>/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <!-- SB Admin CSS -->
    <link href="<?=$base_url?>/assets/css/sb-admin2.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0; background-color: #00b300;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse" style="color:#fff;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:#fff; font-weight:bold; text-shadow:1px 1px 0 #444;">Admin e-Ticketing Travel </a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#fff">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Setting</a>
                        <li><a href="<?=$base_url; ?>/admin/?page=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
                        <li <?=@$_GET['page'] == '' ? 'class="active"' : null?>>
                            <a href="<?=$base_url?>/admin"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                        </li>
                        <li <?=@$_GET['page'] == 'user' || @$_GET['page'] == 'armada' ||@$_GET['page'] == 'tambahadmin' || @$_GET['page'] == 'jurusan' || @$_GET['page'] == 'sopir' || @$_GET['page'] == 'jadwal' ? 'class="active"' : null?>>
                            <a href="#"><i class="fa fa-table fa-fw"></i>Data Travel<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li <?=@$_GET['page'] == 'tambahadmin' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=tambahadmin">Tambah Admin</a></li>
                                <li <?=@$_GET['page'] == 'user' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=user">Data Pelanggan</a></li>
                                <li <?=@$_GET['page'] == 'sopir' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=sopir">Data Sopir</a></li>
                                <li <?=@$_GET['page'] == 'armada' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=armada">Data Armada</a></li>
                                <li <?=@$_GET['page'] == 'jurusan' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=jurusan">Data Jurusan</a></li>
                                <li <?=@$_GET['page'] == 'jadwal' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=jadwal">Data Jadwal</a></li>
                            </ul>
                        </li>
                        <li <?=@$_GET['page'] == 'booking' ? 'class="active"' : null?>>
                            <a href="<?=$base_url?>/admin/?page=booking"><i class="fa fa-ticket fa-fw"></i> Data Booking</a>
                        </li>
                        <li <?=@$_GET['page'] == 'booking_report' || @$_GET['page'] == 'jadwal_report' ? 'class="active"' : null?>>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Laporan <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li <?=@$_GET['page'] == 'jadwal_report' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=jadwal_report">Laporan Jadwal</a></li>
                                <li <?=@$_GET['page'] == 'booking_report' ? 'class="active"' : null?>><a href="<?=$base_url?>/admin/?page=booking_report">Laporan Booking</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=$base_url; ?>" target="_blank"><i class="fa fa-eye fa-fw"></i> Lihat Website</a>
                        </li>
                    </ul>
                    <!-- /#side-menu -->
                </div>
            </div>
        </nav>

        <script src="<?=$base_url; ?>/assets/js/jquery-1.10.2.js"></script>
        <div id="page-wrapper" style="background-color: #fff;">
        <?php
        if(@$_GET['page'] == '') {
            include "inc/dashboard.php";
        } else if(@$_GET['page'] == 'user') {
            include "inc/user.php";
        } else if(@$_GET['page'] == 'tambahadmin') {
            include "inc/tambahadmin.php";
        } else if(@$_GET['page'] == 'armada') {
            include "inc/armada.php";
        } else if(@$_GET['page'] == 'jurusan') {
            include "inc/jurusan.php";
        } else if(@$_GET['page'] == 'sopir') {
            include "inc/sopir.php";
        } else if(@$_GET['page'] == 'jadwal') {
            include "inc/jadwal.php";
        } else if(@$_GET['page'] == 'booking') {
            include "inc/booking.php";
        } else if(@$_GET['page'] == 'logout') {
            unset($_SESSION['id_adm']);
            unset($_SESSION['username_adm']);
            header("location: ".$base_url."/admin/login.php");
        } else if(@$_GET['page'] == 'jadwal_report') {
            include "inc/report_jadwal.php";
        } else if(@$_GET['page'] == 'jadwal_print') {
            include "inc/print_jadwal.php";
        } else if(@$_GET['page'] == 'booking_report') {
            include "inc/report_booking.php";
        } else if(@$_GET['page'] == 'booking_print') {
            include "inc/print_booking.php";
        } else {
            echo "Halaman tidak ditemukan";
        }
        ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts -->
    <script src="<?=$base_url?>/assets/js/bootstrap.min.js"></script>
    <!-- SB Admin Scripts -->
    <script src="<?=$base_url?>/assets/js/sb-admin.js"></script>
	<script src="<?=$base_url?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$base_url?>/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?=$base_url?>/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#dataTables').dataTable();
    });
    </script>

</body>
</html>