<title>Armada | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Armada (Mobil)</h1>
    </div>
    <!-- /.col-lg-12 -->
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
								Data Armada
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=armada&act=add" class="btn btn-xs btn-primary">Tambah</a>
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
									<th>Nomor Polisi</th>
									<th>Jenis Armada</th>
									<th>Jumlah Kursi</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_armada = mysqli_query($con, "SELECT * FROM tb_armada") or die ($con->error);
							while($data = mysqli_fetch_array($sql_armada)) { ?>
								<tr>
									<td align="center"><?=$no++; ?>.</td>
									<td><?=$data['nopol_armd']; ?></td>
									<td><?=$data['jenis_armd']; ?></td>
									<td><?=$data['jumlahkursi_armd']; ?></td>
									<td align="center">
										<a href="<?=$base_url; ?>/admin/?page=armada&act=edit&id=<?=$data['id_armd']; ?>" class="btn btn-warning btn-circle"><i class="fa fa-pencil"></i></a> 
										<a onclick="return confirm('Yakin akan menghapus data?')" href="<?=$base_url; ?>/admin/?page=armada&act=del&id=<?=$data['id_armd']; ?>" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></a>
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
								Tambah Data Armada
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=armada" class="btn btn-xs btn-warning">Kembali</a>
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
									<label for="nopol">Nopol Armada</label>
									<input type="text" class="form-control" id="nopol" name="nopol" placeholder="Nomor polisi kendaraan" required>
								</div>
								<div class="form-group">
									<label for="jenis">Jenis Armada</label>
									<input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Armada" required>
								</div>
								<div class="form-group">
									<label for="kursi">Jumlah Kursi</label>
									<input type="number" class="form-control" id="kursi" name="kursi" required>
								</div>
								<div class="form-group">
									<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
								</div>
							</form>
							<?php
							if(@isset($_POST['tambah'])) {
								$nopol = mysqli_real_escape_string($con, trim($_POST['nopol']));
								$jenis = mysqli_real_escape_string($con, trim($_POST['jenis']));
								$kursi = mysqli_real_escape_string($con, trim($_POST['kursi']));
								mysqli_query($con, "INSERT INTO tb_armada VALUES(null, '$nopol', '$jenis', '$kursi')") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=armada");
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
								Edit Data Armada
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=armada" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<?php
	            			$sql_armada = mysqli_query($con, "SELECT * FROM tb_armada WHERE id_armd = '$_GET[id]'") or die (mysqli_error());
	            			$data = mysqli_fetch_array($sql_armada);
	            			?>
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="nopol">Nopol Armada</label>
									<input type="text" class="form-control" id="nopol" name="nopol" placeholder="Nomor polisi kendaraan" value="<?=$data['nopol_armd']; ?>" required>
								</div>
								<div class="form-group">
									<label for="jenis">Jenis Armada</label>
									<input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Armada" value="<?=$data['jenis_armd']; ?>" required>
								</div>
								<div class="form-group">
									<label for="kursi">Jumlah Kursi</label>
									<input type="number" class="form-control" id="kursi" name="kursi" value="<?=$data['jumlahkursi_armd']; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if(@isset($_POST['edit'])) {
								$nopol = mysqli_real_escape_string($con, trim($_POST['nopol']));
								$jenis = mysqli_real_escape_string($con, trim($_POST['jenis']));
								$kursi = mysqli_real_escape_string($con, trim($_POST['kursi']));
								$status = mysqli_real_escape_string($con, trim($_POST['status']));
								mysqli_query($con, "UPDATE tb_armada SET nopol_armd = '$nopol', jenis_armd = '$jenis', jumlahkursi_armd = '$kursi' WHERE id_armd = '$_GET[id]'") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=armada");
							}
							?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
        	} else if(@$_GET['act'] == 'del') {
        		mysqli_query($con, "DELETE FROM tb_armada WHERE id_armd = '$_GET[id]'") or die (mysqli_error());
        		header("location: ".$base_url."/admin/?page=armada");
        	} ?>
        </div>
        <!-- /.panel -->
    </div>
</div>