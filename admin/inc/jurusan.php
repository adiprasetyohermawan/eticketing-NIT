<title>Jurusan | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Jurusan</h1>
    </div>
    <!-- /.col-lg-12 -->
<?php
if(!@$_SESSION['id_adm']) {
    header("location: ".$base_url."/admin/login.php");
} ?>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
	        <?php
	        if(@$_GET['act'] == '') { ?>
	            <div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Data Jurusan
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jurusan&act=add" class="btn btn-xs btn-primary">Tambah</a>
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
									<th>Kota Keberangkatan</th>
									<th>Kota Tujuan</th>
									<th>Waktu Keberangkatan</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan") or die ($con->error);
							while($data = mysqli_fetch_array($sql_jurusan)) { ?>
								<tr>
									<td align="center"><?=$no++; ?>.</td>
									<td><?=$data['keberangkatan_jrs']; ?></td>
									<td><?=$data['tujuan_jrs']; ?></td>
									<td>Pukul <?=$data['waktu_jrs']; ?> WIB</td>
									<td align="center">
										<a href="<?=$base_url; ?>/admin/?page=jurusan&act=edit&id=<?=$data['id_jrs']; ?>" class="btn btn-circle btn-warning"><i class="fa fa-pencil"></i></a> 
										<a onclick="return confirm('Yakin akan menghapus data?')" href="<?=$base_url; ?>/admin/?page=jurusan&act=del&id=<?=$data['id_jrs']; ?>" class="btn btn-circle btn-danger"><i class="fa fa-times"></i></a>
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
								Tambah Data Jurusan
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jurusan" class="btn btn-xs btn-warning">Kembali</a>
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
									<label for="keberangkatan">Keberangkatan</label>
									<input type="text" class="form-control" id="keberangkatan" name="keberangkatan" placeholder="Kota keberangkatan" required>
								</div>
								<div class="form-group">
									<label for="tujuan">Tujuan</label>
									<input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Kota tujuan" required>
								</div>
								<div class="form-group">
									<label for="waktu">Waktu <small>(AM : 12 malam - 12 siang. PM : 12 siang - 12 malam)</small></label>
									<input type="time" class="form-control" id="waktu" name="waktu" required>
								</div>
								<div class="form-group">
									<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
								</div>
							</form>
							<?php
							if(@isset($_POST['tambah'])) {
								$keberangkatan = mysqli_real_escape_string($con, trim($_POST['keberangkatan']));
								$tujuan = mysqli_real_escape_string($con, trim($_POST['tujuan']));
								$waktu = mysqli_real_escape_string($con, trim($_POST['waktu']));
								mysqli_query($con, "INSERT INTO tb_jurusan VALUES(null, '$keberangkatan', '$tujuan', '$waktu')") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=jurusan");
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
								Edit Data Jurusan
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=jurusan" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<?php
	            			$sql_jurusan = mysqli_query($con, "SELECT * FROM tb_jurusan WHERE id_jrs = '$_GET[id]'") or die (mysqli_error());
	            			$data = mysqli_fetch_array($sql_jurusan);
	            			?>
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="keberangkatan">Keberangkatan</label>
									<input type="text" class="form-control" id="keberangkatan" name="keberangkatan" placeholder="Kota keberangkatan" value="<?=$data['keberangkatan_jrs']; ?>" required>
								</div>
								<div class="form-group">
									<label for="tujuan">Tujuan</label>
									<input type="text" class="form-control" id="tujuan" name="tujuan" placeholder="Kota tujuan" value="<?=$data['tujuan_jrs']; ?>" required>
								</div>
								<div class="form-group">
									<label for="waktu">Waktu <small>(AM : 12 malam - 12 siang. PM : 12 siang - 12 malam)</small></label>
									<input type="time" class="form-control" id="waktu" name="waktu" value="<?=$data['waktu_jrs']; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if(@isset($_POST['edit'])) {
								$keberangkatan = mysqli_real_escape_string($con, trim($_POST['keberangkatan']));
								$tujuan = mysqli_real_escape_string($con, trim($_POST['tujuan']));
								$waktu = mysqli_real_escape_string($con, trim($_POST['waktu']));
								mysqli_query($con, "UPDATE tb_jurusan SET keberangkatan_jrs = '$keberangkatan', tujuan_jrs = '$tujuan', waktu_jrs = '$waktu' WHERE id_jrs = '$_GET[id]'") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=jurusan");
							}
							?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
        	} else if((@$_GET['act'] == 'del') && ($_SESSION['id_adm'] == 1)) {
        		mysqli_query($con, "DELETE FROM tb_jurusan WHERE id_jrs = '$_GET[id]'") or die (mysqli_error());
        		header("location: ".$base_url."/admin/?page=jurusan");
        	} else {
        		header("location:" .$base_url. "/admin/?page=jurusan");
        		confirm('anda tidak dapat menghaous data');
        	}
        	?>
        </div>
        <!-- /.panel -->
    </div>
</div>