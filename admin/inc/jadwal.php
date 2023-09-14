<title>Jadwal | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Jadwal</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<?php
if(!@$_SESSION['id_adm']) {
    header("location: ".$base_url."/admin/login.php");
} ?>
<style type="text/css">
.btn-y {
    margin:1px 0;
}
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
	        <?php
	        if(@$_GET['act'] == '') { ?>
	            <div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Data Jadwal
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jadwal&act=add" class="btn btn-xs btn-primary">Tambah</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	                <div class="table-responsive">
						<table class="table table-bordered table-hover table-striped" id="dataTables">
							<thead>
								<tr>
									<th>No.</th>
									<th>Tanggal Berangkat</th>
									<th>Armada</th>
									<th>Jumlah Kursi</th>
									<th>Jurusan</th>
									<th>Sopir</th>
									<th>Harga Tiket</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_jadwal = mysqli_query($con, "SELECT * FROM tb_jadwal INNER JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd INNER JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs INNER JOIN tb_sopir ON tb_jadwal.id_sopir = tb_sopir.id_sopir ORDER BY tgl_berangkat DESC") or die ($con->error);
							while($data = mysqli_fetch_array($sql_jadwal)) { ?>
								<tr>
									<td align="center"><?=$no++; ?>.</td>
									<td><?php echo indonesian_date($data['tgl_berangkat']); ?></td>
									<td><?=$data['jenis_armd']." - (".$data['nopol_armd'].")"; ?></td>
									<td><?=$data['jumlahkursi_armd']; ?></td>
									<td><?=$data['keberangkatan_jrs']." ke ".$data['tujuan_jrs']." (".$data['waktu_jrs'].")"; ?></td>
									<td><?=$data['nama_sopir']; ?></td>
									<td>Rp. <?=number_format($data['harga_tiket'], 2, ",", "."); ?></td>
									<td align="center">
										<a href="<?=$base_url; ?>/admin/?page=jadwal&act=edit&id=<?=$data['id_jdwl']; ?>" class="btn btn-circle btn-warning btn-y"><i class="fa fa-pencil"></i></a> 
										<a onclick="return confirm('Yakin akan menghapus data?')" href="<?=$base_url; ?>/admin/?page=jadwal&act=del&id=<?=$data['id_jdwl']; ?>" class="btn btn-circle btn-danger btn-y"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
	            </div>
	            <!-- /.panel-body -->
            <?php
            } else if(@$_GET['act'] == 'add') { ?>
				<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Tambah Data Jadwal
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jadwal" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="tgl">Tanggal Keberangkatan</label>
									<input type="date" class="form-control" id="tgl" name="tgl" required>
								</div>
								<div class="form-group">
									<label for="id_armd">Armada (Kendaraan)</label>
									<select class="form-control" name="id_armd" required>
										<option value=""></option>
										<?php
										$sql_armd = mysqli_query($con, "SELECT * FROM tb_armada") or die (mysqli_error());
										while ($data_armd = mysqli_fetch_array($sql_armd)) {
											echo '<option value="'.$data_armd['id_armd'].'">'.$data_armd['jenis_armd'].' - ('.$data_armd['nopol_armd'].')</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_jrs">Jurusan</label>
									<select class="form-control" name="id_jrs" required>
										<option value=""></option>
										<?php
										$sql_jrs = mysqli_query($con, "SELECT * FROM tb_jurusan") or die (mysqli_error());
										while ($data_jrs = mysqli_fetch_array($sql_jrs)) {
											echo '<option value="'.$data_jrs['id_jrs'].'">'.$data_jrs['keberangkatan_jrs'].' ke '.$data_jrs['tujuan_jrs'].' - (Pukul '.$data_jrs['waktu_jrs'].')</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_sopir">Sopir</label>
									<select class="form-control" name="id_sopir" required>
										<option value=""></option>
										<?php
										$sql_sopir = mysqli_query($con, "SELECT * FROM tb_sopir") or die (mysqli_error());
										while ($data_sopir = mysqli_fetch_array($sql_sopir)) {
											echo '<option value="'.$data_sopir['id_sopir'].'">'.$data_sopir['nama_sopir'].'</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="harga">Harga Tiket</label>
									<input type="number" class="form-control" id="harga" name="harga" required>
								</div>
								<div class="form-group">
									<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
								</div>
							</form>
							<?php
							if(@isset($_POST['tambah'])) {
								$tgl = mysqli_real_escape_string($con, trim($_POST['tgl']));
								$id_armd = mysqli_real_escape_string($con, trim($_POST['id_armd']));
								$id_jrs = mysqli_real_escape_string($con, trim($_POST['id_jrs']));
								$id_sopir = mysqli_real_escape_string($con, trim($_POST['id_sopir']));
								$harga = mysqli_real_escape_string($con, trim($_POST['harga']));
								mysqli_query($con, "INSERT INTO tb_jadwal VALUES(null, '$tgl', '$id_armd', '$id_jrs', '$id_sopir', '$harga')") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=jadwal");
							}
							?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
        	} else if(@$_GET['act'] == 'edit') { ?>
				<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Edit Data Jadwal
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jadwal" class="btn btn-xs btn-warning">Kembali</a>
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
								$sql_jdwl = mysqli_query($con, "SELECT * FROM tb_jadwal INNER JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd INNER JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs INNER JOIN tb_sopir ON tb_jadwal.id_sopir = tb_sopir.id_sopir WHERE tb_jadwal.id_jdwl = '$_GET[id]'") or die(mysqli_error());
							    $data = mysqli_fetch_array($sql_jdwl);
							    ?>
				                <div class="form-group">
									<label for="tgl">Tanggal Keberangkatan</label>
									<input type="date" class="form-control" id="tgl" name="tgl" value="<?=$data['tgl_berangkat']; ?>" required>
								</div>
								<div class="form-group">
									<label for="id_armd">Armada (Mobil)</label>
									<select class="form-control" name="id_armd" required>
										<?php
										echo '<option value="'.$data['id_armd'].'">'.$data['jenis_armd'].' - ('.$data['nopol_armd'].') *</option>';
										$sql_armd = mysqli_query($con, "SELECT * FROM tb_armada") or die (mysqli_error());
										while ($data_armd = mysqli_fetch_array($sql_armd)) {
											echo '<option value="'.$data_armd['id_armd'].'">'.$data_armd['jenis_armd'].' - ('.$data_armd['nopol_armd'].')</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_jrs">Jurusan</label>
									<select class="form-control" name="id_jrs" required>
										<?php
										echo '<option value="'.$data['id_jrs'].'">'.$data['keberangkatan_jrs'].' ke '.$data['tujuan_jrs'].' - (Pukul '.$data['waktu_jrs'].') *</option>';
										$sql_jrs = mysqli_query($con, "SELECT * FROM tb_jurusan") or die (mysqli_error());
										while ($data_jrs = mysqli_fetch_array($sql_jrs)) {
											echo '<option value="'.$data_jrs['id_jrs'].'">'.$data_jrs['keberangkatan_jrs'].' ke '.$data_jrs['tujuan_jrs'].' - (Pukul '.$data_jrs['waktu_jrs'].')</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="id_sopir">Sopir</label>
									<select class="form-control" name="id_sopir" required>
										<?php
										echo '<option value="'.$data['id_sopir'].'">'.$data['nama_sopir'].' *</option>';
										$sql_sopir = mysqli_query($con, "SELECT * FROM tb_sopir") or die (mysqli_error());
										while ($data_sopir = mysqli_fetch_array($sql_sopir)) {
											echo '<option value="'.$data_sopir['id_sopir'].'">'.$data_sopir['nama_sopir'].'</option>';
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="harga">Harga Tiket</label>
									<input type="number" class="form-control" id="harga" name="harga" value="<?=$data['harga_tiket']; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if(@isset($_POST['edit'])) {
								$tgl = mysqli_real_escape_string($con, trim($_POST['tgl']));
								$id_armd = mysqli_real_escape_string($con, trim($_POST['id_armd']));
								$id_jrs = mysqli_real_escape_string($con, trim($_POST['id_jrs']));
								$id_sopir = mysqli_real_escape_string($con, trim($_POST['id_sopir']));
								$harga = mysqli_real_escape_string($con, trim($_POST['harga']));
								mysqli_query($con, "UPDATE tb_jadwal SET tgl_berangkat = '$tgl', id_armd = '$id_armd', id_jrs = '$id_jrs', id_sopir = '$id_sopir', harga_tiket = '$harga' WHERE id_jdwl = '$_GET[id]'") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=jadwal");
							}
							?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php

        	} else if((@$_GET['act'] == 'del') && ($_SESSION['id_adm'] == 1)) {
        		mysqli_query($con, "DELETE FROM tb_jadwal WHERE id_jdwl = '$_GET[id]'");
        		header("location: ".$base_url."/admin/?page=jadwal");
        	} else {
        		header("location:" .$base_url. "/admin/?page=jadwal");
        		confirm('anda tidak dapat menghaous data');
        	} ?>
        </div>
        <!-- /.panel -->
    </div>
</div>