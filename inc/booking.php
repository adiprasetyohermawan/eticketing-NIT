<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Ticket Booking</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<?php
		if (@$_GET['act'] == '') { ?>
			<div class="panel panel-default">
				<div class="panel-body">
					Sebelum konfirmasi transfer, silakan transfer uang sesuai nominal total bayar ke salah satu rekening dibawah ini :
					<br>
					<table width="100%">
						<tr>
							<td width="20%"></td>
							<td width="60%" align="center">
								<table class="table table-bordered" style="margin:0; background-color:#eee;">
									<tr>
										<td colspan="2" width="50%" align="center">
											<img src="img/Logo-Bank-BRI.png" width="150px">
										</td>
										<td colspan="2" width="50%" align="center">
											<img src="img/Logo-Bank-BCA.png" width="150px">
										</td>
									</tr>
									<tr>
										<td width="20%" align="right">No. Rekening :</td>
										<td>5951-01-014122-xx-x</td>
										<td width="20%" align="right">No. Rekening :</td>
										<td>5220304xxx</td>
									</tr>
									<tr>
										<td align="right">Atas Nama :</td>
										<td>Nusantara Indah Travel</td>
										<td align="right">Atas Nama :</td>
										<td>Nusantara Indah Travel</td>
									</tr>
								</table>
							</td>
							<td width="20%"></td>
						</tr>
					</table>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Data Pemesanan Ticket
							</div>
						</div>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<style type="text/css">
						.b-x {
							margin: 1px 0;
						}
					</style>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataTables">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nomor Booking</th>
									<th>Jadwal</th>
									<th>Pemesan (Customer)</th>
									<th>Jumlah Penumpang</th>
									<th>Harga Total</th>
									<th>Tanggal Booking</th>
									<th>Status Booking</th>
									<th>Status Bayar</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									$sql_booking = mysqli_query($con, "SELECT * FROM tb_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user WHERE tb_booking.id_user = '$_SESSION[id_user]' ORDER BY no_booking DESC") or die($con->error);
									while ($data = mysqli_fetch_array($sql_booking)) { ?>
									<tr>
										<td align="center"><?= $no++; ?>.</td>
										<td align="center"><?= $data['no_booking']; ?></td>
										<td>
											<?= tgl($data['tgl_berangkat']); ?><br>
											<a id="d_jadwal" class="btn btn-default btn-xs" data-toggle="modal" data-target="#jadwal" data-id="<?= $data['id_jdwl']; ?>">Detail</a>
										</td>
										<td>
											<?= $data['nama_user']; ?><br>
											<a id="d_user" class="btn btn-default btn-xs" data-toggle="modal" data-target="#user" data-id="<?= $data['id_user']; ?>">Detail</a>
										</td>
										<td>
											<?= $data['jumlah_penumpang']; ?> orang<br>
											<a id="d_penumpang" class="btn btn-default btn-xs" data-toggle="modal" data-target="#penumpang" data-id="<?= $data['no_booking']; ?>">Detail</a>
										</td>
										<td>Rp. <?= number_format($data['harga_total'], 2, ",", "."); ?></td>
										<td><?= tgl($data['tgl_booking']); ?></td>
										<td><?= ucfirst($data['status_booking']); ?></td>
										<td><?= ucfirst($data['status_bayar']); ?></td>
										<td align="center">
											<?php
													if ($data['status_bayar'] == 'lunas') { ?>
												<a href="<?= $base_url; ?>/?p=booking&act=detail&id=<?= $data['no_booking']; ?>" class="btn btn-xs btn-default b-x">Detail Bayar</a>
											<?php
													} else if ($data['status_bayar'] == 'pending') { ?>
												<a href="<?= $base_url; ?>/?p=booking&act=detail&id=<?= $data['no_booking']; ?>" class="btn btn-xs btn-default b-x">Detail Bayar</a>
												<a href="<?= $base_url; ?>/?p=booking&act=edit&id=<?= $data['no_booking']; ?>" class="btn btn-xs btn-primary b-x">Edit Konfirmasi Transfer</a>
												<?php
														} else {
															if ($data['status_booking'] == 'aktif') { ?>
													<a href="<?= $base_url; ?>/?p=booking&act=konfirm&id=<?= $data['no_booking']; ?>" class="btn btn-xs btn-success b-x">Konfirmasi Transfer</a>
											<?php
														}
													} ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php
		} else if (@$_GET['act'] == 'konfirm') { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Konfirmasi Pembayaran (Transfer)
							</div>
							<div class="pull-right">
								<a href="<?= $base_url; ?>/?p=booking" class="btn btn-xs btn-warning">Kembali</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="no_booking">No. Booking</label>
									<input type="text" class="form-control" name="no_booking" id="nobooking" value="<?= @$_GET['id']; ?>" readonly required>
								</div>
								<?php
									$id = trim(mysqli_real_escape_string($con, $_GET['id']));
									$sql_booking2 = mysqli_query($con, "SELECT * FROM tb_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user WHERE no_booking = '$id'") or die($con->error);
									$data2 = mysqli_fetch_array($sql_booking2);
									?>
								<div class="form-group">
									<label for="harga_total">Total Bayar</label>
									<input type="text" class="form-control" name="harga_total" id="harga_total" value="<?= $data2['harga_total']; ?>" readonly required>
								</div>
								<div class="form-group">
									<label for="bank_from">dari Bank</label>
									<input type="text" class="form-control" name="bank_from" id="bank_from" placeholder="Tulis bank yang Anda gunakan untuk transfer" required>
								</div>
								<div class="form-group">
									<label for="bank_to">ke Bank</label>
									<select class="form-control" name="bank_to" id="bank_to" required>
										<option value="">...</option>
										<option value="BRI">BRI</option>
										<option value="BCA">BCA</option>
									</select>
								</div>
								<div class="form-group">
									<label for="no_rek">No. Rekening</label>
									<input type="number" class="form-control" name="no_rek" id="no_rek" placeholder="No. Rekening Anda untuk transfer" required>
								</div>
								<div class="form-group">
									<label for="atas_nama">Atas Nama</label>
									<input type="text" class="form-control" name="atas_nama" id="atas_nama" required>
								</div>
								<div class="form-group">
									<label for="nominal">Nominal yang Ditransfer</label>
									<input type="number" class="form-control" name="nominal" id="nominal" required>
								</div>
								<div class="form-group">
									<label for="bukti">Foto / Screenshot Bukti Transaksi</label>
									<input type="file" class="form-control" name="bukti" id="bukti" required>
								</div>
								<div class="form-group pull-right">
									<input type="submit" name="konfirmasi" class="btn btn-success" value="Konfirmasi">
								</div>
							</form>
							<?php
								if (@$_POST['konfirmasi']) {
									$no_booking = mysqli_real_escape_string($con, trim($_POST['no_booking']));
									$harga_total = mysqli_real_escape_string($con, trim($_POST['harga_total']));
									$bank_from = mysqli_real_escape_string($con, trim($_POST['bank_from']));
									$bank_to = mysqli_real_escape_string($con, trim($_POST['bank_to']));
									$no_rek = mysqli_real_escape_string($con, trim($_POST['no_rek']));
									$atas_nama = mysqli_real_escape_string($con, trim($_POST['atas_nama']));
									$nominal = mysqli_real_escape_string($con, trim($_POST['nominal']));

									$temp = explode(".", @$_FILES["bukti"]["name"]);
									$bukti = "transfer-" . round(microtime(true)) . '.' . end($temp);
									$sumber = @$_FILES['bukti']['tmp_name'];
									if ($nominal < ($harga_total)) {
										echo "<script>alert('Transfer tidak boleh dibawah Rp. " . number_format(($harga_total), 2, ",", ".") . "');</script>";
									} else {
										$upload = move_uploaded_file($sumber, "img/bukti_transaksi/" . $bukti);
										if ($upload) {
											mysqli_query($con, "INSERT INTO tb_pembayaran VALUES (null, '$bank_from', '$bank_to', '$no_rek', '$atas_nama', '$nominal', '$bukti', now(), '$no_booking')") or die($con->error);
											mysqli_query($con, "UPDATE tb_booking SET status_bayar = 'pending' WHERE no_booking = '$no_booking'") or die($con->error);
											header("location: " . $base_url . "/?p=booking");
										} else {
											echo "<script>alert('Gagal upload gambar. Coba lagi');</script>";
										}
									}
								}
								?>
						</div>
					</div>
				</div>
			</div>
		<?php
		} else if (@$_GET['act'] == 'edit') { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Konfirmasi Pembayaran (Transfer)
							</div>
							<div class="pull-right">
								<a href="<?= $base_url; ?>/?p=booking" class="btn btn-xs btn-warning">Kembali</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="no_booking">No. Booking</label>
									<input type="text" class="form-control" name="no_booking" id="nobooking" value="<?= @$_GET['id']; ?>" readonly required>
								</div>
								<?php
									$id = trim(mysqli_real_escape_string($con, $_GET['id']));
									$sql_booking2 = mysqli_query($con, "SELECT * FROM tb_pembayaran JOIN tb_booking ON tb_pembayaran.no_booking = tb_booking.no_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user WHERE tb_pembayaran.no_booking = '$id'") or die($con->error);
									$data2 = mysqli_fetch_array($sql_booking2);
									?>
								<div class="form-group">
									<label for="harga_total">Total Bayar</label>
									<input type="text" class="form-control" name="harga_total" id="harga_total" value="<?= $data2['harga_total']; ?>" readonly required>
								</div>
								<div class="form-group">
									<label for="bank_from">dari Bank</label>
									<input type="text" class="form-control" name="bank_from" id="bank_from" value="<?= $data2['dari_bank']; ?>" placeholder="Tulis bank yang Anda gunakan untuk transfer" required>
								</div>
								<div class="form-group">
									<label for="bank_to">ke Bank</label>
									<select class="form-control" name="bank_to" id="bank_to" required>
										<option value="BRI">BRI</option>
										<option value="BCA" <?= $data2['ke_bank'] == 'BCA' ? 'selected' : ''; ?>>BCA</option>
									</select>
								</div>
								<div class="form-group">
									<label for="no_rek">No. Rekening</label>
									<input type="number" class="form-control" name="no_rek" id="no_rek" value="<?= $data2['no_rek']; ?>" placeholder="No. Rekening Anda untuk transfer" required>
								</div>
								<div class="form-group">
									<label for="atas_nama">Atas Nama</label>
									<input type="text" class="form-control" name="atas_nama" id="atas_nama" value="<?= $data2['atas_nama']; ?>" required>
								</div>
								<div class="form-group">
									<label for="nominal">Nominal yang Ditransfer</label>
									<input type="number" class="form-control" name="nominal" id="nominal" value="<?= $data2['nominal_transfer']; ?>" required>
								</div>
								<div class="form-group">
									<label for="bukti">Foto / Screenshot Bukti Transaksi</label>
									<div style="margin-bottom: 10px;">
										<img src="img/bukti_transaksi/<?= $data2['gambar_bukti']; ?>" style="width:200px; border:1px solid #ddd;">
									</div>
									<input type="file" class="form-control" name="bukti" id="bukti">
								</div>
								<div class="form-group pull-right">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
								if (@$_POST['edit']) {
									$no_booking = mysqli_real_escape_string($con, trim($_POST['no_booking']));
									$harga_total = mysqli_real_escape_string($con, trim($_POST['harga_total']));
									$bank_from = mysqli_real_escape_string($con, trim($_POST['bank_from']));
									$bank_to = mysqli_real_escape_string($con, trim($_POST['bank_to']));
									$no_rek = mysqli_real_escape_string($con, trim($_POST['no_rek']));
									$atas_nama = mysqli_real_escape_string($con, trim($_POST['atas_nama']));
									$nominal = mysqli_real_escape_string($con, trim($_POST['nominal']));

									if (@$_FILES['bukti']['name'] != '') {
										$temp = explode(".", @$_FILES["bukti"]["name"]);
										$bukti = "transfer-" . round(microtime(true)) . '.' . end($temp);
										$sumber = @$_FILES['bukti']['tmp_name'];
										if ($nominal < ($harga_total)) {
											echo "<script>alert('Transfer tidak boleh dibawah Rp. " . number_format(($harga_total), 2, ",", ".") . "');</script>";
										} else {
											$sql_pembayaran = mysqli_query($con, "SELECT * FROM tb_pembayaran WHERE no_booking = '$no_booking'") or die($con->error);
											$data_pembayaran = mysqli_fetch_array($sql_pembayaran);
											unlink("img/bukti_transaksi/" . $data_pembayaran['gambar_bukti']);
											$upload = move_uploaded_file($sumber, "img/bukti_transaksi/" . $bukti);
											if ($upload) {
												mysqli_query($con, "UPDATE tb_pembayaran SET dari_bank = '$bank_from', ke_bank = '$bank_to', no_rek = '$no_rek', atas_nama = '$atas_nama', nominal_transfer = '$nominal', gambar_bukti = '$bukti', tgl_konfirm = now() WHERE no_booking = '$no_booking'") or die($con->error);
												header("location: " . $base_url . "/?p=booking");
											} else {
												echo "<script>alert('Gagal upload gambar. Coba lagi');</script>";
											}
										}
									} else {
										mysqli_query($con, "UPDATE tb_pembayaran SET dari_bank = '$bank_from', ke_bank = '$bank_to', no_rek = '$no_rek', atas_nama = '$atas_nama', nominal_transfer = '$nominal', tgl_konfirm = now() WHERE no_booking = '$no_booking'") or die($con->error);
										header("location: " . $base_url . "/?p=booking");
									}
								}
								?>
						</div>
					</div>
				</div>
			</div>
		<?php
		} else if (@$_GET['act'] == 'detail') { ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Detail Pembayaran
							</div>
							<div class="pull-right">
								<a href="<?= $base_url; ?>/?p=booking" class="btn btn-xs btn-warning">Kembali</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">

					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="no_booking">No. Booking</label>
								<input type="text" class="form-control" name="no_booking" id="nobooking" value="<?= @$_GET['id']; ?>" readonly required>
							</div>
							<?php
								$id = trim(mysqli_real_escape_string($con, $_GET['id']));
								$sql_booking2 = mysqli_query($con, "SELECT * FROM tb_pembayaran JOIN tb_booking ON tb_pembayaran.no_booking = tb_booking.no_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user WHERE tb_pembayaran.no_booking = '$id'") or die($con->error);
								$data2 = mysqli_fetch_array($sql_booking2);
								?>
							<div class="form-group">
								<label for="harga_total">Total Bayar</label>
								<input type="text" class="form-control" id="harga_total" value="Rp. <?= number_format($data2['harga_total'], 2, ",", "."); ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="bank_from">dari Bank</label>
								<input type="text" class="form-control" id="bank_from" value="<?= $data2['dari_bank']; ?>" placeholder="Tulis bank yang Anda gunakan untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="bank_to">ke Bank</label>
								<input type="text" class="form-control" id="bank_from" value="<?= $data2['ke_bank']; ?>" placeholder="Tulis bank yang Anda gunakan untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="no_rek">No. Rekening</label>
								<input type="number" class="form-control" id="no_rek" value="<?= $data2['no_rek']; ?>" placeholder="No. Rekening Anda untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="atas_nama">Atas Nama</label>
								<input type="text" class="form-control" id="atas_nama" value="<?= $data2['atas_nama']; ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="nominal">Nominal yang Ditransfer</label>
								<input type="text" class="form-control" id="nominal" value="Rp. <?= number_format($data2['nominal_transfer'], 2, ",", "."); ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="bukti">Foto / Screenshot Bukti Transaksi</label>
								<div>
									<img src="img/bukti_transaksi/<?= $data2['gambar_bukti']; ?>" style="width:200px; border:1px solid #ddd;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		} ?>
	</div>
</div>
<script type="text/javascript">
	$(document).on("click", "#d_jadwal", function() {
		var id_jdwl = $(this).data('id');
		$.ajax({
			url: "admin/inc/detail_jadwal.php",
			type: "POST",
			data: "id_jdwl=" + id_jdwl + "&page=jadwal",
			success: function(data) {
				$("#tabel_detailjadwal").html(data);
			}
		})
	});

	$(document).on("click", "#d_user", function() {
		var id_user = $(this).data('id');
		$.ajax({
			url: "admin/inc/detail_pemesan.php",
			type: "POST",
			data: "id_user=" + id_user,
			success: function(data) {
				$("#tabel_detailuser").html(data);
			}
		})
	});

	$(document).on("click", "#d_penumpang", function() {
		var no_booking = $(this).data('id');
		$.ajax({
			url: "admin/inc/detail_penumpang.php",
			type: "POST",
			data: "no_booking=" + no_booking,
			success: function(data) {
				$("#tabel_detailpenumpang").html(data);
			}
		})
	});
</script>

<div id="jadwal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detail Jadwal</h4>
			</div>
			<div class="modal-body">
				<div id="tabel_detailjadwal"></div>
			</div>
		</div>
	</div>
</div>

<div id="user" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detail Pemesan (Customer)</h4>
			</div>
			<div class="modal-body">
				<div id="tabel_detailuser"></div>
			</div>
		</div>
	</div>
</div>

<div id="penumpang" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Detail Penumpang</h4>
			</div>
			<div class="modal-body">
				<div id="tabel_detailpenumpang"></div>
			</div>
		</div>
	</div>
</div>