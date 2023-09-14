<?php
include "../../setting/+koneksi.php";

$id_user = @mysqli_real_escape_string($con, $_POST['id_user']);
?>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>Nama User</th>
				<th>Jenis Kelamin</th>
				<th>No. Telepon</th>
				<th>Alamat</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = '$id_user'") or die($con->error);
			$data = mysqli_fetch_array($sql_user); ?>
			<tr>
				<td><?=ucwords($data['nama_user']);?></td>
				<td><?=$data['jeniskelamin_user'];?></td>
				<td><?=$data['telp_user'];?></td>
				<td><?=$data['alamat_user'];?></td>
				<td><?=$data['email_user'];?></td>
			</tr>
		</tbody>
	</table>
</div>