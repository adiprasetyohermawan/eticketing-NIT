<?php require "setting/+koneksi.php"; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>e-Ticketing Nusantara Indah Travel</title>
	<!-- Core CSS - Include with every p -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?= $base_url; ?>/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
	<!-- Own CSS -->
	<!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
	<!-- <link rel="stylesheet" href="assets/css/responsive.css"> -->
	<!-- SB Admin CSS - Include with every p -->
	<link href="assets/css/sb-admin2.css" rel="stylesheet">
	<link href="assets/css/plugins/timeline/timeline.css" rel="stylesheet">
  <link type="text/css" href="assets/css/Home.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/logo.png" >


</head>

<!-- <body style="padding-top: 15px; padding-bottom: 15px; background-color: #f8f8f8; background-image: url('img/view of city 4.jpg'); background-repeat: no-repeat; background-size: cover;"> -->

<body style="padding-top: 15px; padding-bottom: 15px; background-color: #f8f8f8;">
	<script src="assets/js/jquery-1.10.2.js"></script>

	<div class="container">
		<div style="box-shadow:0 0 10px;">
			<!-- <div class="jumbotron" style="margin-bottom:0px; padding-top:15px; padding-bottom:15px; border-radius:0; background-color:#0f3e63; color:#fff; text-shadow:1px 1px 0 #444;"> -->
			<div class="jumbotron" style="margin-bottom:0px; padding-top:15px; padding-bottom:15px; border-radius:0; background-color:#2196F3; color:#fff; text-shadow:1px 1px 0 #444;">
				<h1 style="font-size:50px;">Nusantara Indah Travel</h1>
				<p style="font-size:19px;">Pembelian tiket travel secara online dan mudah</p>
			</div>
			<!-- Static navbar -->
			<nav class="navbar navbar-default" style="margin-bottom: 0px; border-radius: 0;">
				<!-- <div class="container-fluid" style="background-color: lavender;"> -->
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand"><i class="fa fa-ticket"></i></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li <?= @$_GET['p'] == '' ? 'class="active"' : null ?>><a href="<?= $base_url ?>">Home</a></li>
							<li <?= @$_GET['p'] == 'profil' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=profil">Profil Nusanatara Indah Travel</a></li>
							<li <?= @$_GET['p'] == 'carapesan' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=carapesan">Cara Pemesanan</a></li>
							<li <?= @$_GET['p'] == 'infojadwal' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=infojadwal">Info Jadwal & Reservasi</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<?php if (@$_SESSION['id_user']) { ?>
								<li <?= @$_GET['p'] == 'booking' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=booking">My Booking</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account<span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li <?= @$_GET['p'] == 'editProfilUser' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=editProfilUser">Profil Saya</a></li>
										<li <?= @$_GET['p'] == 'editPasswordUser' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=editPasswordUser">Ubah Password</a></li>
									</ul>
								</li>
								<li><a href="<?= $base_url ?>/?p=logout">Logout</a></li>
							<?php
							} else { ?>
								<li <?= @$_GET['p'] == 'login' ? 'class="active"' : null ?>><a href="<?= $base_url ?>/?p=login">Login</a></li>
							<?php
							} ?>
						</ul>
					</div>
					<!--/.nav-collapse -->
				</div>
				<!--/.container-fluid -->
			</nav>


			<!-- <div style="min-height: 410px; padding: 15px; background-color: lightsteelblue"> -->
			<div style="min-height: 410px; padding: 15px;">
				<?php
				if (@$_GET['p'] == '') {
					include "inc/home.php";
				} else if (@$_GET['p'] == 'profil') {
					include "inc/profil.php";
				} else if (@$_GET['p'] == 'carapesan') {
					include "inc/cara_pesan.php";
				} else if (@$_GET['p'] == 'infojadwal') {
					include "inc/info_jadwal.php";
				} else if (@$_GET['p'] == 'pesan') {
					include "inc/pesan.php";
				} else if (@$_GET['p'] == 'login') {
					if (@$_SESSION['id_user']) {
						header("location: " . $base_url);
					} else {
						include "inc/login.php";
					}
				} elseif (@$_GET['p'] == 'lupa') {
					if (@$_SESSION['id_user']) {
						header("location:" . $base_url);
					} else {
						include "inc/lupa.php";
					}
				} else if (@$_GET['p'] == 'register') {
					include "inc/register.php";
				} else if (@$_GET['p'] == 'booking') {
					if (@$_SESSION['id_user']) {
						include "inc/booking.php";
					} else {
						header("location: " . $base_url . "/?p=login");
					}
				} else if (@$_GET['p'] == 'logout') {
					unset($_SESSION['id_user']);
					unset($_SESSION['email_user']);
					header("location: " . $base_url . "/?p=login");
				} else if (@$_GET['p'] == 'editProfilUser') {
					include "inc/edit_profil_user.php";
				} else if (@$_GET['p'] == 'editPasswordUser') {
					include "inc/edit_password_user.php";
				} else {
					echo "Halaman tidak ditemukan";
				}
				?>
			</div>

			<footer class="footer">
				<!-- <div class="container-fluid" style="padding: 15px 0; background-color: #0b1c29; color: #fff;" align="center"> -->
				<div class="container-fluid" style="padding: 15px 0; background-color: #55aef6; color: #fff;" align="center">
					&copy; <?php echo date("Y"); ?> - Nusantara Indah Travel
			</footer>

		</div>
	</div> <!-- /container -->

	<!-- Core Scripts - Include with every p -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- SB Admin Scripts - Include with every p -->
	<script src="assets/js/sb-admin.js"></script>
	<script src="assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

	<script src="<?= $base_url; ?>/assets/js/plugins/dataTables/jquery.dataTables.js"></script>
	<script src="<?= $base_url; ?>/assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script>
		$(document).ready(function() {
			$('#dataTables').dataTable();
		});
	</script>
</body>

</html>