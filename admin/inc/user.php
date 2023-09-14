<title>Customer | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Customer</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
if(!@$_SESSION['id_adm']) {
    header("location: ".$base_url."/admin/login.php");
} ?>
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
								Data Pelanggan (User)
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
									<th>Nama User</th>
									<th>Jenis Kelamin</th>
									<th>No. Telepon</th>
									<th>Alamat</th>
									<th>Email</th>
									<th>Password</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
							$sql_user = mysqli_query($con, "SELECT * FROM tb_user") or die($con->error);
							while ($data = mysqli_fetch_array($sql_user)) {?>
								<tr>
									<td align="center"><?=$no++;?>.</td>
									<td><?=ucwords($data['nama_user']);?></td>
									<td><?=$data['jeniskelamin_user'];?></td>
									<td><?=$data['telp_user'];?></td>
									<td><?=$data['alamat_user'];?></td>
									<td><?=$data['email_user'];?></td>
									<td><?=$data['password_user'];?></td>
									<td align="center">
										<a href="<?=$base_url;?>/admin/?page=user&act=edit&id=<?=$data['id_user'];?>" class="btn btn-xs btn-info">Edit Email / Password</a>
									</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
	            </div>
	            <!-- /.panel-body -->
        	<?php
			} else if ((@$_GET['act'] == 'edit') && ($_SESSION['id_adm'] == 1)){ ?>
				<div class="panel-heading">
	                <div class="row">
						<div class="col-lg-12">
							<div class="pull-left">
								Edit Data User
							</div>
			                <div class="pull-right">
								<a href="<?=$base_url;?>/admin/?page=user" class="btn btn-xs btn-warning">Kembali</a>
			                </div>
						</div>
	                </div>
	            </div>
	            <!-- /.panel-heading -->
	            <div class="panel-body">
	            	<div class="row">
	            		<div class="col-lg-6">
	            			<?php
							$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = '$_GET[id]'") or die(mysqli_error());
						    $data = mysqli_fetch_array($sql_user);
						    ?>
	            			<form action="" method="post">
				                <div class="form-group">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="E-mail user" value="<?=$data['email_user']; ?>" required>
								</div>
								<div class="form-group">
									<label for="pass">Password</label>
									<input type="text" class="form-control" id="pass" name="pass" placeholder="Password user" value="<?=$data['password_user']; ?>" required>
								</div>
								<div class="form-group">
									<input type="submit" name="edit" class="btn btn-success" value="Edit">
								</div>
							</form>
							<?php
							if (@isset($_POST['edit'])) {
						        $email  = mysqli_real_escape_string($con, trim($_POST['email']));
						        $pass  = mysqli_real_escape_string($con, trim($_POST['pass']));
						        mysqli_query($con, "UPDATE tb_user SET email_user = '$email', password_user = '$pass' WHERE id_user = '$_GET[id]'") or die(mysqli_error());
						        header("location: " . $base_url . "/admin/?page=user");
						    } ?>
						</div>
					</div>
	            </div>
	            <!-- /.panel-body -->
	        <?php
	        } else {
				header("location:" .$base_url. "/admin/?page=user");
	        } ?>
        </div>
        <!-- /.panel -->
    </div>
</div>