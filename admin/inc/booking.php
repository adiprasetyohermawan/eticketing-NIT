<title>Booking | Admin e-Ticketing</title>
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
        if(@$_GET['act'] == '') { ?>
	        <div class="panel panel-default">
	            <div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Data Pemesanan Ticket
							</div>
			                <!-- <div class="pull-right">
								<a href="" class="btn btn-xs btn-primary">Tambah</a>
			                </div> -->
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<style type="text/css">
	            	.b-x { margin: 1px 0; }
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
							<?php $no = 1;
							$sql_armada = mysqli_query($con, "SELECT * FROM tb_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user ORDER BY no_booking DESC") or die ($con->error);
							while($data = mysqli_fetch_array($sql_armada)) { ?>
								<tr>
									<td align="center"><?=$no++; ?>.</td>
									<td align="center"><?=$data['no_booking']; ?></td>
									<td>
										<?=tgl($data['tgl_berangkat']); ?><br>
										<a id="d_jadwal" class="btn btn-default btn-xs" data-toggle="modal" data-target="#jadwal" data-id="<?=$data['id_jdwl']; ?>">Detail</a>
									</td>
									<td>
										<?=$data['nama_user']; ?><br>
										<a id="d_user" class="btn btn-default btn-xs" data-toggle="modal" data-target="#user" data-id="<?=$data['id_user']; ?>">Detail</a>
									</td>
									<td>
										<?=$data['jumlah_penumpang']; ?>  orang<br>
										<a id="d_penumpang" class="btn btn-default btn-xs" data-toggle="modal" data-target="#penumpang" data-id="<?=$data['no_booking']; ?>">Detail</a>
									</td>
									<td>Rp. <?=number_format($data['harga_total'], 2, ",", "."); ?></td>
									<td><?=tgl($data['tgl_booking']); ?></td>
									<td><?=ucfirst($data['status_booking']); ?></td>
									<td>
										<?=ucfirst($data['status_bayar']); ?>
										<?php
										if($data['status_bayar'] == 'lunas' || $data['status_bayar'] == 'pending') { ?>
											<br><a href="<?=$base_url; ?>/admin/?page=booking&act=detail&id=<?=$data['no_booking']; ?>" class="btn btn-xs btn-default b-x">Detail Bayar</a>
										<?php
										} ?>
									</td>
									<td align="center">
										<?php
										if($data['status_bayar'] == 'lunas' || $data['status_bayar'] == 'pending') { ?>
											<a href="<?=$base_url; ?>/admin/?page=booking&act=e.s.konfirm&id=<?=$data['no_booking']; ?>" class="btn btn-xs btn-<?=$data['status_bayar'] == 'pending' ? 'warning' : 'default'; ?> b-x">Edit Status Konfirmasi</a><br>
										<?php } ?>
										<a href="<?=$base_url; ?>/admin/?page=booking&act=e.s.booking&id=<?=$data['no_booking']; ?>" class="btn btn-xs btn-<?=$data['status_booking'] == 'aktif' ? 'info' : 'default'; ?> b-x">Edit Status Booking</a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
	            </div>
	            <!-- /.panel-body -->
	        </div>
	        <!-- /.panel -->
        <?php
        } else if(@$_GET['act'] == 'detail') { ?>
	    	<div class="panel panel-default">
            	<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Detail Pembayaran
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=booking" class="btn btn-xs btn-warning">Kembali</a>
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
								<input type="text" class="form-control" name="no_booking" id="nobooking" value="<?=@$_GET['id']; ?>" readonly required>
							</div>
							<?php
							$id = trim(mysqli_real_escape_string($con, $_GET['id']));
							$sql_booking2 = mysqli_query($con, "SELECT * FROM tb_pembayaran JOIN tb_booking ON tb_pembayaran.no_booking = tb_booking.no_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl JOIN tb_user ON tb_booking.id_user = tb_user.id_user WHERE tb_pembayaran.no_booking = '$id'") or die ($con->error);
							$data2 = mysqli_fetch_array($sql_booking2);
							?>
							<div class="form-group">
								<label for="harga_total">Total Bayar</label>
								<input type="text" class="form-control" id="harga_total" value="Rp. <?=number_format($data2['harga_total'], 2, ",", "."); ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="bank_from">dari Bank</label>
								<input type="text" class="form-control" id="bank_from" value="<?=$data2['dari_bank']; ?>" placeholder="Tulis bank yang Anda gunakan untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="bank_to">ke Bank</label>
								<input type="text" class="form-control" id="bank_from" value="<?=$data2['ke_bank']; ?>" placeholder="Tulis bank yang Anda gunakan untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="no_rek">No. Rekening</label>
								<input type="number" class="form-control" id="no_rek" value="<?=$data2['no_rek']; ?>" placeholder="No. Rekening Anda untuk transfer" readonly required>
							</div>
							<div class="form-group">
								<label for="atas_nama">Atas Nama</label>
								<input type="text" class="form-control" id="atas_nama" value="<?=$data2['atas_nama']; ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="nominal">Nominal yang Ditransfer</label>
								<input type="text" class="form-control" id="nominal" value="Rp. <?=number_format($data2['nominal_transfer'], 2, ",", "."); ?>" readonly required>
							</div>
							<div class="form-group">
								<label for="bukti">Foto / Screenshot Bukti Transaksi</label>
								<div>
									<a href="../img/bukti_transaksi/<?=$data2['gambar_bukti']?>" target="_blank"><img src="../img/bukti_transaksi/<?=$data2['gambar_bukti']?>" style="width:200px; border:0px solid #ddd;"></a>
								</div>
							</div>
						</div>
					</div>
	            </div>
	        </div>
        <?php
        } else if(@$_GET['act'] == 'e.s.konfirm') { ?>
        	<div class="panel panel-default">
            	<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Edit Status Konfirmasi Bayar
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=booking" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">

	            	<div class="row">
	            		<div class="col-lg-6">
			            	<form action="" method="post">
			            		<?php
								$id = trim(mysqli_real_escape_string($con, $_GET['id']));
								$sql_booking = mysqli_query($con, "SELECT * FROM tb_booking WHERE no_booking = '$id'") or die ($con->error);
								$data = mysqli_fetch_array($sql_booking);
								?>
								<div class="form-group">
									<label for="status_bayar">Status Bayar</label>
									<select class="form-control" name="status_bayar" id="status_bayar" required>
										<option value="pending">Pending</option>
										<option value="lunas" <?=$data['status_bayar'] == 'lunas' ? 'selected' : ''; ?>>Lunas</option>
										<!-- <option value="belum dibayar" <?=$data['status_bayar'] == 'belum dibayar' ? 'selected' : ''; ?>>Belum Bayar</option> -->
									</select>
								</div>
								<div class="form-group pull-right">
									<input type="submit" name="save" class="btn btn-success" value="Save">
								</div>
							</form>
							<?php
							if(@$_POST['save']) {
								$no_booking = mysqli_real_escape_string($con, trim($_GET['id']));
								$status_bayar = mysqli_real_escape_string($con, trim($_POST['status_bayar']));

								mysqli_query($con, "UPDATE tb_booking SET status_bayar = '$status_bayar' WHERE no_booking = '$no_booking'") or die ($con->error);
								header("location: ".$base_url."/admin/?page=booking");
							}
							?>
			            </div>
					</div>
	            </div>
	        </div>
        <?php
        } else if(@$_GET['act'] == 'e.s.booking') { ?>
        	<div class="panel panel-default">
            	<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Edit Status Booking
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=booking" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
			            	<form action="" method="post">
			            		<?php
								$id = trim(mysqli_real_escape_string($con, $_GET['id']));
								$sql_booking = mysqli_query($con, "SELECT * FROM tb_booking WHERE no_booking = '$id'") or die ($con->error);
								$data = mysqli_fetch_array($sql_booking);
								?>
								<div class="form-group">
									<label for="status_booking">Status Booking (Perjalanan)</label>
									<select class="form-control" name="status_booking" id="status_booking" required>
										<option value="aktif">Aktif</option>
										<option value="selesai" <?=$data['status_booking'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
										<option value="cancel" <?=$data['status_booking'] == 'cancel' ? 'selected' : ''; ?>>Cancel</option>
									</select>
								</div>
								<div class="form-group pull-right">
									<input type="submit" name="save" class="btn btn-success" value="Save">
								</div>
							</form>
							<?php
							if(@$_POST['save']) {
								$no_booking = mysqli_real_escape_string($con, trim($_GET['id']));
								$status_booking = mysqli_real_escape_string($con, trim($_POST['status_booking']));

								mysqli_query($con, "UPDATE tb_booking SET status_booking = '$status_booking' WHERE no_booking = '$no_booking'") or die ($con->error);
								header("location: ".$base_url."/admin/?page=booking");
							}
							?>
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
     	url : "inc/detail_jadwal.php",
     	type : "POST",
     	data : "id_jdwl="+id_jdwl+"&page=jadwal",
     	success : function(data) {
     		$("#tabel_detailjadwal").html(data);
     	}
	})
});

$(document).on("click", "#d_user", function() {
	var id_user = $(this).data('id');
	$.ajax({
     	url : "inc/detail_pemesan.php",
     	type : "POST",
     	data : "id_user="+id_user,
     	success : function(data) {
     		$("#tabel_detailuser").html(data);
     	}
	})
});

$(document).on("click", "#d_penumpang", function() {
	var no_booking = $(this).data('id');
	$.ajax({
     	url : "inc/detail_penumpang.php",
     	type : "POST",
     	data : "no_booking="+no_booking,
     	success : function(data) {
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
				<h4 class="modal-title">Detail Pemesan (User)</h4>
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