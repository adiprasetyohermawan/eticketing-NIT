<style type="text/css">
	.khusus {
		margin-bottom: 0;
	}
</style>
<?php
if (@$_GET['hal'] == 'info') { ?>

	<div class="panel panel-success">
		<div class="panel-heading">
			Info Reservasi Travel
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<?php
					$sql_jadwal2 = mysqli_query($con, "SELECT * FROM tb_jadwal JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs WHERE id_jdwl = '$_GET[id_jdwl]'") or die($con->error);
					$data = mysqli_fetch_array($sql_jadwal2);
					?>
				<table class="table khusus">
					<tr>
						<td width="25%" style="border-top: 0;">Jenis Armada</td>
						<td width="4%" style="border-top: 0;">:</td>
						<td style="border-top: 0;"><?= $data['jenis_armd']; ?></td>
					</tr>
					<tr>
						<td>Jumlah Kursi</td>
						<td>:</td>
						<td><?= $data['jumlahkursi_armd']; ?></td>
					</tr>
					<tr>
						<td>Kota Asal</td>
						<td>:</td>
						<td><?= $data['keberangkatan_jrs']; ?></td>
					</tr>
					<tr>
						<td>Kota Tujuan</td>
						<td>:</td>
						<td><?= $data['tujuan_jrs']; ?></td>
					</tr>
					<tr>
						<td>Berangkat</td>
						<td>:</td>
						<td><?= indonesian_date($data['tgl_berangkat']); ?> (Pkl. <?= $data['waktu_jrs']; ?>)</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel-heading">
			Info Lain
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table khusus">
					<tr>
						<td width="25%" style="border-top: 0;">Harga Tiket</td>
						<td width="4%" style="border-top: 0;">:</td>
						<td style="border-top: 0;">Rp. <?= number_format($data['harga_tiket'], 2, ",", "."); ?></td>
					</tr>
					<tr>
						<td>Jumlah Penumpang</td>
						<td>:</td>
						<td><?= @$_GET['p2']; ?></td>
					</tr>
					<tr>
						<td>Harga Total</td>
						<td>:</td>
						<td>Rp. <?= number_format($data['harga_tiket'] * @$_GET['p2'], 2, ",", "."); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel-heading">
			Ketentuan Pembayaran
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table khusus">
					<tr>
						<td width="30%" style="border-top: 0;"><small style="color: #f00;">Reservasi dapat dilakukan 1x24 jam sebelum armada berangkat</small></td>
					</tr>
					<tr>
						<td><small style="color: #f00;">Harga dan ketersediaan tempat duduk sewaktu waktu dapat berubah</small></td>
					</tr>
					<tr>
						<td>
							<form action="?p=pesan&hal=book" method="post">
								<input type="hidden" name="id_jdwl" value="<?= @$_GET['id_jdwl']; ?>">
								<input type="hidden" name="jml_p" value="<?= @$_GET['p2']; ?>">
								<input type="hidden" name="harga_total" value="<?= $data['harga_tiket'] * @$_GET['p2']; ?>">
								<div class="checkbox">
									<label>
										<input type="checkbox" value="1" required> <small style="color: #999;">Dengan ini saya setuju dan mematuhi persyaratan dan ketentuan Reservasi dari RamaSakti Travel, termasuk pembayaran dan mematuhi semua aturan dan pembatasan mengenai ketersediaan tarif atau jasa.</small>
									</label>
								</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<button class="btn btn-success">Lanjutkan</button>
	<div class="btn btn-warning">
		<a href="?p=infojadwal">Batal</a>
	</div>
	</form>
<?php
} else if (@$_GET['hal'] == 'book') { ?>
	<div class="panel panel-success">
		<div class="panel-heading">
			Info Perjalanan
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<?php
					$sql_jadwal2 = mysqli_query($con, "SELECT * FROM tb_jadwal JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs WHERE id_jdwl = '$_POST[id_jdwl]'") or die($con->error);
					$data = mysqli_fetch_array($sql_jadwal2);
					?>
				<table class="table khusus">
					<tr>
						<td width="25%" style="border-top: 0;">Jenis Armada</td>
						<td width="4%" style="border-top: 0;">:</td>
						<td style="border-top: 0;"><?= $data['jenis_armd'] . " (" . $data['nopol_armd'] . ")"; ?></td>
					</tr>
					<tr>
						<td>Jumlah Kursi</td>
						<td>:</td>
						<td><?= $data['jumlahkursi_armd']; ?></td>
					</tr>
					<tr>
						<td>Kota Asal</td>
						<td>:</td>
						<td><?= $data['keberangkatan_jrs']; ?></td>
					</tr>
					<tr>
						<td>Kota Tujuan</td>
						<td>:</td>
						<td><?= $data['tujuan_jrs']; ?></td>
					</tr>
					<tr>
						<td>Berangkat</td>
						<td>:</td>
						<td><?= indonesian_date($data['tgl_berangkat']); ?> (Pkl. <?= $data['waktu_jrs']; ?>)</td>
					</tr>
					<tr>
						<td>Jumlah Penumpang</td>
						<td>:</td>
						<td><?= $_POST['jml_p']; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel-heading">
			<b>Denah Kursi | Armada Nusantara Indah Travel
		</div>
		<div class="panel-body">
			<div class="col-lg-7" align="center">
				<img src="img/denah.png" width="200px">
			</div>
			<div style="padding-top: 50px; ">
				<h2 align="center"><b>KETERANGAN</b></h2>
				<h4><b>P</b> adalah supir </h4>
				<h4><b>D</b> adalah pintu </h4>
				<h5 style="color: red"><i>*Gambar disebelah kiri hanya menunjukan denah kursi </i></h5>
				<h5 style="color: red"><i>*Untuk memilih nomor kursi dapat langsung memilih dari opsi yang disediakan di bawah</i></h5>
				<h5 style="color: red"><i>*Bila di dalam pilihan tidak ada nomor kursi berarti nomor kursi tersebut telah dibeli atau di pesan orang lain</i></h5>	
			</div>
		</div>

		<!-- Desain Awal Wawan -->
		<!-- <div class="panel-heading">
			Denah Tempat Duduk
		</div> -->
		<!-- <div class="panel-body">
			<div id='div-select-seat' class="card-content">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-sm-7">
						<div class="seat-choices">
							<div class="row">
								<div class="col-lg-12">
									<a href="javascript:;" id="kursisatu" class="btn btn-seat seat-free" data-checked="0" data-value="1">1</a>
									<a href="javascript:;" class="btn btn-seat seat-disabled" data-checked="0" data-value="0"></a>
									<a href="javascript:;" class="btn btn-seat seat-disabled" data-checked="0" data-value="0">D</a>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<a href="javascript:;" id="kursidua" class="btn btn-seat seat-free" data-checked="0" data-value="2">2</a>
									<a href="javascript:;" id="kursitiga" class="btn btn-seat seat-free" data-checked="0" data-value="3">3</a>
									<a href="javascript:;" id="kursiempat" class="btn btn-seat seat-free" data-checked="0" data-value="4">4</a>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<a href="javascript:;" class="btn btn-seat seat-disabled" data-checked="0" data-value="0"></a>
									<a href="javascript:;" id="kursilima" class="btn btn-seat seat-free" data-checked="0" data-value="5">5</a>
									<a href="javascript:;" id="kursienam" class="btn btn-seat seat-free" data-checked="0" data-value="6">6</a>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<a href="javascript:;" id="kursitujuh" class="btn btn-seat seat-free" data-checked="0" data-value="7">7</a>
									<a href="javascript:;" id="kursidelapan" class="btn btn-seat seat-free" data-checked="0" data-value="8">8</a>
									<a href="javascript:;" id="kursisembilan" class="btn btn-seat seat-free" data-checked="0" data-value="9">9</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-7 col-md-6 col-sm-5">
						<div class="seat-legend">
							<div class="row">
								<div class="col-lg-12">
									<span>Keterangan</span>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-xs-6">
									<a href="javascript:;" class="btn btn-seat seat-booked">x</a> Terjual
								</div>
								<div class="col-lg-6 col-xs-6">
									<a href="javascript:;" class="btn btn-seat seat-free">x</a> Tersedia
								</div>
								<div class="col-lg-6 col-xs-6">
									<a href="javascript:;" class="btn btn-seat seat-selected">x</a> Terpilih
								</div>
								<div class="col-lg-6 col-xs-6">
									<a href="javascript:;" class="btn btn-seat seat-disabled">x</a> Supir
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div> -->

		<div class="panel-heading">
			Penumpang
		</div>
		<div class="panel-body">
			<form action="" method="POST" autocomplete="off">
				<input type="hidden" name="id_jdwl" value="<?= @$_POST['id_jdwl']; ?>">
				<input type="hidden" name="jml_p" value="<?= @$_POST['jml_p']; ?>">
				<input type="hidden" name="harga_total" value="<?= @$_POST['harga_total']; ?>">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th>Nama *</th>
							<th>Usia >= 17 th nomor ID (KTP/SIM) / Usia < 17 th tgl lahir *</th> <th>Tempat Jemput</th>
							<th>No. Kursi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$sql_kursi = mysqli_query($con, "SELECT * FROM tb_booking_detail JOIN tb_jadwal ON tb_booking_detail.id_jdwl = tb_jadwal.id_jdwl WHERE tb_booking_detail.id_jdwl = '$_POST[id_jdwl]'") or die($con->error);
							if (mysqli_num_rows($sql_kursi) > 0) {
								while ($data_kursi = mysqli_fetch_array($sql_kursi)) {
									$seatbooked[] = $data_kursi['nokursi_penumpang'];
								}
							} else {
								$seatbooked[] = null;
							}
							if ($data['jumlahkursi_armd'] == 8) {
								$seatasli = [1, 2, 3, 4, 5, 6, 7, 8];
							} else if ($data['jumlahkursi_armd'] == 11) {
								$seatasli = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
							} elseif ($data['jumlahkursi_armd'] == 10) {
								$seatasli = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
							} elseif ($data['jumlahkursi_armd'] == 9) {
								$seatasli = [1, 2, 3, 4, 5, 6, 7, 8, 9];
							}

							// echo $data['jumlahkursi_armd'];
							// echo "</br>";
							// echo '<tr>';
							// echo '<td></td>';
							// echo '<td><input type="text" id="jumlah_kursi_armada" name="jumlah_kursi_armada" class="form-control" value="' . $data['jumlahkursi_armd'] . '"></td>';
							// echo '</tr>';

							// print_r($seatbooked);
							// print_r($seatasli);
							// echo '</br>';
							// for ($i = 0; $i < count($seatasli); $i++) {
							// 	// foreach ($seatbooked as $key => $value) {
							// 	// 	echo $value;
							// 	// }
							// 	echo $seatasli[$i];
							// }
							// echo count($seatasli);
							$seattersedia = array_diff($seatasli, $seatbooked);

							$no = 1;
							for ($i = 1; $i <= intval(@$_POST['jml_p']); $i++) {
								echo '<tr>';
								echo '<td align="center">' . $no++ . '.</td>';
								echo '<td><input type="text" name="penumpang[]" class="form-control" required></td>';
								echo '<td><input type="number" name="id[]" class="form-control" required></td>';
								echo '<td><input type="text" name="tempatjemput[]" class="form-control" required></td>';
								echo '<td><select name="nokursi[]" id="nokursi_' . $i . '" class="form-control nokursi" required>';
								echo '<option value=""></option>';
								foreach ($seattersedia as $key => $value) {
									echo '<option value="' . $value . '">' . $value . '</option>';
								}
								echo '</td>';
								echo '</tr>';
							}
							?>
						<!-- <p id="seat">Halo</p> -->
						<!-- <a href="#" onclick="seat()">Klik Aku!</a> -->
					</tbody>
				</table>
				<script type="text/javascript" src="assets/js/jquery-1.10.2.js"></script>
				<script type="text/javascript">
					var kursi = [];
					$('.nokursi').change(function() {
						var A = $(this).val();
						var ada = false;
						$("select").not(this).each(function() {
							var B = $(this).val();
							if (A && B && B == A) ada = true;
						})
						if (ada) {
							alert("No. Kursi ini sudah dipilih");
							$(this).val('')
						}
					})

					function seat() {
						console.log('work');
						<?php
							// print_r($seatasli);
							// echo "document.getElementById('seat').innerHTML = 'print_r($seatbooked)';";
							// for ($i = 0; $i < count($seatasli); $i++) {
							//   echo $seatasli[$i];
							// }
							?>
					}

					$(document).ready(function() {
						var jumlahpesanan = '<?php echo $_POST['jml_p'] ?>';
						// console.log(jumlahpesanan);
						// for (i = 1; i <= jumlahpesanan; i++) {

						var flag = 0;

						// untuk nokursi_1
						$('#nokursi_1').change(function() {
							var nokursi = $('#nokursi_1').val();
							// console.log(nokursi);
							// var flag = 0;

							if (flag == 1) {
								$('#kursisatu').removeClass('seat-selected');
								$('#kursisatu').addClass('seat-free');
								var flag = 0;
							} else if (flag == 2) {
								$('#kursidua').removeClass('seat-selected');
								$('#kursidua').addClass('seat-free');
								var flag = 0;
							} else if (flag == 3) {
								$('#kursitiga').removeClass('seat-selected');
								$('#kursitiga').addClass('seat-free');
								var flag = 0;
							} else if (flag == 4) {
								$('#kursiempat').removeClass('seat-selected');
								$('#kursiempat').addClass('seat-free');
								var flag = 0;
							} else if (flag == 5) {
								$('#kursilima').removeClass('seat-selected');
								$('#kursilima').addClass('seat-free');
								var flag = 0;
							} else if (flag == 6) {
								$('#kursienam').removeClass('seat-selected');
								$('#kursienam').addClass('seat-free');
								var flag = 0;
							} else if (flag == 7) {
								$('#kursitujuh').removeClass('seat-selected');
								$('#kursitujuh').addClass('seat-free');
								var flag = 0;
							} else if (flag == 8) {
								$('#kursidelapan').removeClass('seat-selected');
								$('#kursidelapan').addClass('seat-free');
								var flag = 0;
							} else if (flag == 9) {
								$('#kursisembilan').removeClass('seat-selected');
								$('#kursisembilan').addClass('seat-free');
								var flag = 0;
							}

							// document.cookie = "1";
							// var x = document.cookie;
							// console.log(x);
							// alert(x);


							if (nokursi == 1) {
								$('#kursisatu').removeClass('seat-free');
								$('#kursisatu').addClass('seat-selected');
								var flag = 1;
							} else if (nokursi == 2) {
								$('#kursidua').removeClass('seat-free');
								$('#kursidua').addClass('seat-selected');
								var flag = 2;
							} else if (nokursi == 3) {
								$('#kursitiga').removeClass('seat-free');
								$('#kursitiga').addClass('seat-selected');
								var flag = 3;
							} else if (nokursi == 4) {
								$('#kursiempat').removeClass('seat-free');
								$('#kursiempat').addClass('seat-selected');
								var flag = 4;
							} else if (nokursi == 5) {
								$('#kursilima').removeClass('seat-free');
								$('#kursilima').addClass('seat-selected');
								var flag = 5;
							} else if (nokursi == 6) {
								$('#kursienam').removeClass('seat-free');
								$('#kursienam').addClass('seat-selected');
								var flag = 6;
							} else if (nokursi == 7) {
								$('#kursitujuh').removeClass('seat-free');
								$('#kursitujuh').addClass('seat-selected');
								var flag = 7;
							} else if (nokursi == 8) {
								$('#kursidelapan').removeClass('seat-free');
								$('#kursidelapan').addClass('seat-selected');
								var flag = 8;
							} else if (nokursi == 9) {
								$('#kursisembilan').removeClass('seat-free');
								$('#kursisembilan').addClass('seat-selected');
								var flag = 9;
							}
							console.log(flag);
						});

						// untuk nokursi_2
						$('#nokursi_2').change(function() {
							var nokursi = $('#nokursi_2').val();
							console.log(nokursi);
							if (nokursi == 1) {
								$('#kursisatu').removeClass('seat-free');
								$('#kursisatu').addClass('seat-selected');
							} else if (nokursi == 2) {
								$('#kursidua').removeClass('seat-free');
								$('#kursidua').addClass('seat-selected');
							} else if (nokursi == 3) {
								$('#kursitiga').removeClass('seat-free');
								$('#kursitiga').addClass('seat-selected');
							} else if (nokursi == 4) {
								$('#kursiempat').removeClass('seat-free');
								$('#kursiempat').addClass('seat-selected');
							} else if (nokursi == 5) {
								$('#kursilima').removeClass('seat-free');
								$('#kursilima').addClass('seat-selected');
							} else if (nokursi == 6) {
								$('#kursienam').removeClass('seat-free');
								$('#kursienam').addClass('seat-selected');
							} else if (nokursi == 7) {
								$('#kursitujuh').removeClass('seat-free');
								$('#kursitujuh').addClass('seat-selected');
							} else if (nokursi == 8) {
								$('#kursidelapan').removeClass('seat-free');
								$('#kursidelapan').addClass('seat-selected');
							} else {
								$('#kursisembilan').removeClass('seat-free');
								$('#kursisembilan').addClass('seat-selected');
							}
						});

						// }
					});
				</script>
		</div>
		<div class="panel-heading">
			Data Pemesan
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<?php
					$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = '$_SESSION[id_user]'") or die($con->error);
					$data = mysqli_fetch_array($sql_user);
					?>
				<table class="table khusus">
					<tr>
						<td width="25%" style="border-top: 0;">Nama</td>
						<td width="4%" style="border-top: 0;">:</td>
						<td style="border-top: 0;"><?= $data['nama_user']; ?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td><?= $data['jeniskelamin_user']; ?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?= $data['alamat_user']; ?></td>
					</tr>
					<tr>
						<td>Telepon</td>
						<td>:</td>
						<td><?= $data['telp_user']; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><?= $data['email_user']; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<input type="submit" name="next" class="btn btn-success" value="Lanjutkan">
	</form>



<?php
	if (@$_POST['next']) {
		/* kode otomatis start */
		$sql_kode = mysqli_query($con, "SELECT MAX(no_booking) as kode FROM tb_booking") or die($con->error);
		$datakode = mysqli_fetch_array($sql_kode);
		if ($datakode) {
			$nilaikode = substr($datakode['kode'], 3);
			$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$hasilkode = "BO-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
		} else {
			$hasilkode = "BO-001";
		}
		/* kode otomatis end */
		mysqli_query($con, "INSERT INTO tb_booking VALUES ('$hasilkode', '$_POST[id_jdwl]', '$_SESSION[id_user]', '$_POST[jml_p]', '$_POST[harga_total]', now(), 'aktif', 'belum dibayar')") or die($con->error);
		header("location: " . $base_url . "?p=booking");
		for ($x = 0; $x < count($_POST['penumpang']); $x++) {
			mysqli_query($con, "INSERT INTO tb_booking_detail VALUES (null, '" . $_POST['penumpang'][$x] . "', '" . $_POST['id'][$x] . "', '" . $_POST['tempatjemput'][$x] . "', '" . $_POST['nokursi'][$x] . "', '$hasilkode', '$_POST[id_jdwl]')") or die($con->error);
		}
	}
} ?>