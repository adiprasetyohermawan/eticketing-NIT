<?php
if (@$_GET['hal'] == '') { ?>
	<div class="row">
		<div class="col-lg-4 col-md-offset-4">
			<div class="panel panel-warning">
				<div class="panel-heading text-center">
					<h3 class="panel-title">Info Jadwal dan Reservasi</h3>
				</div>
				<div class="panel-body">
					<form action="<?= $base_url ?>/?p=infojadwal&hal=2" method="post">
						<fieldset>
							<div class="form-group">
								<i class="fa fa-calendar fa-lg"></i>
								<label for="tgl">Tanggal Berangkat</label>
								<select class="form-control" name="tgl" id="tgl" required>
									<option value="">...</option>
									<?php
										$begin = new DateTime(date('Y-m-d'));
										$end = new DateTime(date('Y-m-d', strtotime('+1 week')));
										$interval = DateInterval::createFromDateString('1 day');
										$period = new DatePeriod($begin, $interval, $end);
										foreach ($period as $dt)
											echo '<option value="' . $dt->format('Y-m-d') . '">' . indonesian_date($dt->format('Y-m-d')) . '</option>';
										?>
								</select>
								<!-- <input type="date" name="tgl" id="tgl" class="form-control" required> -->
							</div>
							<div class="form-group">
								<i class="fa fa-map-marker fa-lg"></i>
								<label for="kota_asal">Kota Asal</label>
								<select class="form-control" name="kota_asal" id="kota_asal">
									<option value="">...</option>
									<?php
										$sql_jurusan = mysqli_query($con, "SELECT distinct(keberangkatan_jrs) FROM tb_jurusan") or die(mysqli_error());
										while ($jrs = mysqli_fetch_array($sql_jurusan))
											echo '<option value="' . $jrs['keberangkatan_jrs'] . '">' . $jrs['keberangkatan_jrs'] . '</option>';
										?>
								</select>
							</div>
							<div class="form-group">
								<i class="fa fa-map-marker fa-lg"></i>
								<label for="kota_tujuan">Kota Tujuan</label>
								<select class="form-control" name="kota_tujuan" id="kota_tujuan">
									<option value="">...</option>
									<?php
										$sql_jurusan2 = mysqli_query($con, "SELECT distinct(tujuan_jrs) FROM tb_jurusan") or die(mysqli_error());
										while ($jrs = mysqli_fetch_array($sql_jurusan2))
											echo '<option value="' . $jrs['tujuan_jrs'] . '">' . $jrs['tujuan_jrs'] . '</option>';
										?>
								</select>
							</div>
							<div class="form-group">
								<i class="fa fa-male fa-lg"></i>
								<label for="jml_penumpang">Jumlah Penumpang</label>
								<select class="form-control" name="jml_penumpang" id="jml_penumpang" required>
									<option value="">...</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<!-- <option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option> -->


								</select>
							</div>
							<div class="form-group">
								<button type="submit" name="tampilkan" class="btn btn-md btn-success btn-block">Tampilkan</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
} else if (@$_GET['hal'] == 2) {
	$tgl = @mysqli_real_escape_string($con, trim($_POST['tgl']));
	$kota_asal = @mysqli_real_escape_string($con, trim($_POST['kota_asal']));
	$kota_tujuan = @mysqli_real_escape_string($con, trim($_POST['kota_tujuan']));
	?>
	<div class="row">
		<div class="col-lg-6">
			<div class="form-group">
				<!-- Fungsi strtoupper untuk mengkonversi string menjadi kapital -->
				<?= "<b>" . strtoupper($kota_asal) . "</b> - <b>" . strtoupper($kota_tujuan) . "</b><br>" . indonesian_date($tgl) . " | " . @$_POST['jml_penumpang'] . " penumpang"; ?>
			</div>
		</div>
		<div class="col-lg-6 text-right">
			<div class="form-group">
				<a href="?p=infojadwal" class="btn btn-xs btn-warning">Kembali</a>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables">
				<thead>
					<tr>
						<th>No.</th>
						<th>Armada</th>
						<th>Berangkat</th>
						<th>Jurusan</th>
						<th>Harga Tiket</th>
						<th>Tersedia</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no = 1;
						$query_jadwal = "SELECT * FROM tb_jadwal 
				INNER JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd 
				INNER JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs 
				INNER JOIN tb_sopir ON tb_jadwal.id_sopir = tb_sopir.id_sopir 
				WHERE tgl_berangkat = '$tgl' ";
						if ($kota_asal != "") {
							$query_jadwal .= "AND keberangkatan_jrs = '$kota_asal' ";
						}
						if ($kota_tujuan != "") {
							$query_jadwal .= " AND tujuan_jrs = '$kota_tujuan' ";
						}
						$query_jadwal .= "ORDER BY waktu_jrs ASC";
						$sql_jadwal = mysqli_query($con, $query_jadwal) or die($con->error);
						while ($data = mysqli_fetch_array($sql_jadwal)) { ?>
						<tr>
							<td align="center"><?= $no++; ?>.</td>
							<td><?= $data['jenis_armd'] . " - (" . $data['nopol_armd'] . ")"; ?></td>
							<td align="center"><?php $waktu = explode(":", $data['waktu_jrs']); ?>
								<?= "<b>" . $waktu[0] . ":" . $waktu[1] . "</b><br>" . indonesian_date($data['tgl_berangkat']); ?>
							</td>
							<td><?= $data['keberangkatan_jrs'] . " ke " . $data['tujuan_jrs']; ?></td>
							<td>Rp. <?= number_format($data['harga_tiket'], 2, ",", "."); ?></td>
							<td>
								<?php
										$sql_cek_kursi = mysqli_query($con, "SELECT * FROM tb_booking_detail JOIN tb_jadwal ON tb_booking_detail.id_jdwl = tb_jadwal.id_jdwl INNER JOIN tb_booking ON tb_booking_detail.no_booking = tb_booking.no_booking
							WHERE tb_booking_detail.id_jdwl = '$data[id_jdwl]' AND tb_booking.status_bayar = 'lunas' AND tb_booking.status_booking = 'aktif'") or die($con->error);
										$seatdibooking = mysqli_num_rows($sql_cek_kursi);
										$seattersedia = $data['jumlahkursi_armd'] - $seatdibooking;
										echo $seattersedia; ?> kursi
							</td>
							<td align="center">
								<?php
										if ($_POST['jml_penumpang'] > $seattersedia) {
											echo '<a style="cursor:not-allowed;" class="btn btn-xs btn-default btn-bottom">Pesan</a>';
										} else {
											if (@$_SESSION['id_user']) {
												echo '<a href="' . $base_url . '?p=pesan&hal=info&id_jdwl=' . $data['id_jdwl'] . '&p2=' . @$_POST['jml_penumpang'] . '" class="btn btn-xs btn-primary btn-bottom">Pesan</a>';
											} else {
												echo '<a href="' . $base_url . '?p=login&id_jdwl=' . $data['id_jdwl'] . '" class="btn btn-xs btn-primary btn-bottom">Pesan</a>';
											}
										}
										?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php
} ?>