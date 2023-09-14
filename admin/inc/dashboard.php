<?php
if(!@$_SESSION['id_adm']) {
    header("location: ".$base_url."/admin/login.php");
} ?>
<title>Dashboard | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-dashboard fa-fw"></i>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                Selamat datang di halaman admin
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Info
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <a href="<?=$base_url;?>/admin/?page=tambahadmin" class="list-group-item">
                        <i class="fa fa-users fa-fw"></i> Administrator
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_plg = mysqli_query($con, "SELECT id_adm FROM tb_admin");
                        echo mysqli_num_rows($sql_plg); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=user" class="list-group-item">
                        <i class="fa fa-users fa-fw"></i> Pelanggan
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_plg = mysqli_query($con, "SELECT id_user FROM tb_user");
                        echo mysqli_num_rows($sql_plg); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=sopir" class="list-group-item">
                        <i class="fa fa-user fa-fw"></i> Sopir
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_spr = mysqli_query($con, "SELECT id_sopir FROM tb_sopir");
                        echo mysqli_num_rows($sql_spr); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=armada" class="list-group-item">
                        <i class="fa fa-shopping-cart fa-fw"></i> Armada
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_arm = mysqli_query($con, "SELECT id_armd FROM tb_armada");
                        echo mysqli_num_rows($sql_arm); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=jurusan" class="list-group-item">
                        <i class="fa fa-bolt fa-fw"></i> Jurusan
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_jrs = mysqli_query($con, "SELECT id_jrs FROM tb_jurusan");
                        echo mysqli_num_rows($sql_jrs); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=jadwal" class="list-group-item">
                        <i class="fa fa-upload fa-fw"></i> Jadwal
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_jdl = mysqli_query($con, "SELECT id_jdwl FROM tb_jadwal");
                        echo mysqli_num_rows($sql_jdl); ?>
                        </em>
                        </span>
                    </a>
                    <a href="<?=$base_url;?>/admin/?page=booking" class="list-group-item">
                        <i class="fa fa-money fa-fw"></i> Pemesanan
                        <span class="pull-right text-muted small">
                        <em>
                        <?php $sql_book = mysqli_query($con, "SELECT no_booking FROM tb_booking");
                        echo mysqli_num_rows($sql_book); ?>
                        </em>
                        </span>
                    </a>
                </div>
                <!-- /.list-group -->
                <a href="#" class="btn btn-default btn-block">View All</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>