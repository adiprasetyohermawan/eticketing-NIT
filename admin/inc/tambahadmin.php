<title>Tambah Admin | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tambah Admin</h1>
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
								Data Admin
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=tambahadmin&act=add" class="btn btn-xs btn-primary">Tambah</a>
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
									<th>Nama</th>
									<th>username</th>
									<th>password</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_admin = mysqli_query($con, "SELECT * FROM tb_admin") or die ($con->error);
							while($data = mysqli_fetch_array($sql_admin)) { ?>
								<tr>
									<td align="center"><?=$no++; ?>.</td>
									<td><?=$data['nama_adm']; ?></td>
									<td><?=$data['username_adm']; ?></td>
									<td><?=$data['password_adm']; ?></td>
									<?php if ($_SESSION['id_adm'] == 1) { ?>
									<td align="center">
										<a href="<?=$base_url; ?>/admin/?page=tambahadmin&act=edit&id=<?=$data['id_adm']; ?>" class="btn btn-circle btn-warning"><i class="fa fa-pencil"></i></a> 
										<a onclick="return confirm('Yakin akan menghapus data?')" href="<?=$base_url; ?>/admin/?page=tambahadmin&act=del&id=<?=$data['id_adm']; ?>" class="btn btn-circle btn-danger"><i class="fa fa-times"></i></a>
									</td>
								<?php } else { ?>
									<td align="center">
										<a onclick="return confirm('Anda tidak dapa melakukan fungsi itu')" href="<?=$base_url; ?>/admin/?page=tambahadmin" class="btn btn-circle btn-warning"><i class="fa fa-pencil"></i></a> 
										<a onclick="return confirm('Anda tidak dapat menghapus data?')" href="<?=$base_url; ?>/admin/?page=tambahadmin" class="btn btn-circle btn-danger"><i class="fa fa-times"></i></a>
									</td>
								<?php }?>
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
								Tambah Data Admin
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=tambahadmin" class="btn btn-xs btn-warning">Kembali</a>
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
									<label for="namaadm">Nama Admin</label>
									<input type="text" class="form-control" id="namaadm" name="namaadm" placeholder="Nama Admin" required>
								</div>
								<div class="form-group">
									<label for="username_adm">username Admin</label>
									<input type="text" class="form-control" id="username_adm" name="username_adm" placeholder="username" required>
								</div>
								<div class="form-group">
									<label for="password_adm">Password</label>
									<input type="password" class="form-control" id="password_adm" name="password_adm" required>
								</div>
								<div class="form-group">
									<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
								</div>
							</form>
							<?php
							if(@isset($_POST['tambah'])) {
								$namaadm = mysqli_real_escape_string($con, trim($_POST['namaadm']));
								$username_adm = mysqli_real_escape_string($con, trim($_POST['username_adm']));
								$password_adm = mysqli_real_escape_string($con, trim($_POST['password_adm']));
								$md5 = md5($password_adm);
								mysqli_query($con, "INSERT INTO tb_admin VALUES(null, '$namaadm', '$username_adm', '$md5')") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=tambahadmin");
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
								Edit Data Admin
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url; ?>/admin/?page=tambahadmin" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<?php
	            			$sql_admin = mysqli_query($con, "SELECT * FROM tb_admin WHERE id_adm = '$_GET[id]'") or die (mysqli_error());
	            			$data = mysqli_fetch_array($sql_admin);
	            			?>
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="nama_adm">Keberangkatan</label>
									<input type="text" class="form-control" id="nama_adm" name="nama_adm" placeholder="Nama Admin" value="<?=$data['nama_adm']; ?>" required>
								</div>
								<div class="form-group">
									<label for="username_adm">Username Admin</label>
									<input type="text" class="form-control" id="username_adm" name="username_adm" placeholder="username" value="<?=$data['username_adm']; ?>" required>
								</div>
								<div class="form-group">
									<label for="password_adm">Password</label>
									<input type="password" class="form-control" id="password_adm" name="password_adm" value="<?=$data['password_adm']; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if(@isset($_POST['edit'])) {
								$nama_adm = mysqli_real_escape_string($con, trim($_POST['nama_adm']));
								$username_adm = mysqli_real_escape_string($con, trim($_POST['username_adm']));
								$password_adm = mysqli_real_escape_string($con, trim($_POST['password_adm']));
								$md5 = md5($password_adm);
								mysqli_query($con, "UPDATE tb_admin SET nama_adm = '$nama_adm', username_adm = '$username_adm', password_adm = '$md5' WHERE id_adm = '$_GET[id]'") or die (mysqli_error());
								header("location: ".$base_url."/admin/?page=tambahadmin");
							}
							?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
        	} else if(@$_GET['act'] == 'del') {
        		mysqli_query($con, "DELETE FROM tb_admin WHERE id_adm = '$_GET[id]'") or die (mysqli_error());
        		header("location: ".$base_url."/admin/?page=tambahadmin");
        	}	
        	?>
        </div>
        <!-- /.panel -->
    </div>
</div>