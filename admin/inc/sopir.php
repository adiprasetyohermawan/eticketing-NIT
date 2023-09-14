<title>Sopir | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sopir</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
        	<?php
			if (@$_GET['act'] == '') { ?>
	            <div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Data Sopir
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url;?>/admin/?page=sopir&act=add" class="btn btn-xs btn-primary">Tambah</a>
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
									<th>Nama Sopir</th>
									<th>Nomor SIM</th>
									<th>No. Telepon</th>
									<th>Alamat</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_sopir = mysqli_query($con, "SELECT * FROM tb_sopir") or die($con->error);
							while ($data = mysqli_fetch_array($sql_sopir)) {?>
								<tr>
									<td align="center"><?=$no++;?>.</td>
									<td><?=ucwords($data['nama_sopir']);?></td>
									<td><?=$data['nosim_sopir'];?></td>
									<td><?=$data['telp_sopir'];?></td>
									<td><?=$data['alamat_sopir'];?></td>
									<td align="center">
										<a href="<?=$base_url;?>/admin/?page=sopir&act=edit&id=<?=$data['id_sopir'];?>" class="btn btn-circle btn-warning"><i class="fa fa-pencil"></i></a>
										<a onclick="return confirm('Yakin akan menghapus data?')" href="<?=$base_url;?>/admin/?page=sopir&act=del&id=<?=$data['id_sopir'];?>" class="btn btn-circle btn-danger"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
	            </div>
	            <!-- /.panel-body -->
            <?php
			} else if (@$_GET['act'] == 'add') { ?>
				<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Tambah Data Sopir
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url;?>/admin/?page=sopir" class="btn btn-xs btn-warning">Kembali</a>
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
									<label for="nama">Nama Sopir</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap sopir" required>
								</div>
								<div class="form-group">
									<label for="nosim">Nomor SIM Sopir</label>
									<input type="number" class="form-control" id="nosim" name="nosim" placeholder="No. SIM sopir" required>
								</div>
								<div class="form-group">
									<label for="telp">Nomor Telepon Sopir</label>
									<input type="number" class="form-control" id="telp" name="telp" placeholder="Ex. 085789123456" required>
								</div>
								<div class="form-group">
									<label for="alamat">Alamat Sopir</label>
									<textarea class="form-control" id="alamat" name="alamat" required></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
								</div>
							</form>
							<?php
							if (@isset($_POST['tambah'])) {
						        $nama  = mysqli_real_escape_string($con, trim($_POST['nama']));
						        $nosim  = mysqli_real_escape_string($con, trim($_POST['nosim']));
						        $telp = mysqli_real_escape_string($con, trim($_POST['telp']));
						        $alamat  = mysqli_real_escape_string($con, trim($_POST['alamat']));
						        mysqli_query($con, "INSERT INTO tb_sopir VALUES(null, '$nama', '$nosim', '$telp', '$alamat')") or die(mysqli_error());
						        header("location: " . $base_url . "/admin/?page=sopir");
						    } ?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
			} else if (@$_GET['act'] == 'edit') { ?>
				<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Edit Data Sopir
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url;?>/admin/?page=sopir" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<?php
							$sql_sopir = mysqli_query($con, "SELECT * FROM tb_sopir WHERE id_sopir = '$_GET[id]'") or die(mysqli_error());
						    $data = mysqli_fetch_array($sql_sopir);
						    ?>
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="nama">Nama Sopir</label>
									<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap sopir" value="<?=$data['nama_sopir']; ?>" required>
								</div>
								<div class="form-group">
									<label for="nosim">Nomor SIM Sopir</label>
									<input type="number" class="form-control" id="nosim" name="nosim" placeholder="No. SIM sopir" value="<?=$data['nosim_sopir']; ?>" required>
								</div>
								<div class="form-group">
									<label for="telp">Nomor Telepon Sopir</label>
									<input type="number" class="form-control" id="telp" name="telp" placeholder="Ex. 085789123456" value="<?=$data['telp_sopir']; ?>" required>
								</div>
								<div class="form-group">
									<label for="alamat">Alamat Sopir</label>
									<textarea class="form-control" id="alamat" name="alamat" required><?=$data['alamat_sopir']; ?></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if (@isset($_POST['edit'])) {
						        $nama  = mysqli_real_escape_string($con, trim($_POST['nama']));
						        $nosim  = mysqli_real_escape_string($con, trim($_POST['nosim']));
						        $telp = mysqli_real_escape_string($con, trim($_POST['telp']));
						        $alamat  = mysqli_real_escape_string($con, trim($_POST['alamat']));
						        mysqli_query($con, "UPDATE tb_sopir SET nama_sopir = '$nama', nosim_sopir = '$nosim', telp_sopir = '$telp', alamat_sopir = '$alamat' WHERE id_sopir = '$_GET[id]'") or die(mysqli_error());
						        header("location: " . $base_url . "/admin/?page=sopir");
						    } ?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
			} else if (@$_GET['act'] == 'del') {
			    mysqli_query($con, "DELETE FROM tb_sopir WHERE id_sopir = '$_GET[id]'") or die(mysqli_error());
			    header("location: " . $base_url . "/admin/?page=sopir");
			} ?>
        </div>
        <!-- /.panel -->
    </div>
</div>