<?php
include "../../setting/+koneksi.php";

$no_booking = @mysqli_real_escape_string($con, $_POST['no_booking']);
?>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama Penumpang</th>
				<th>ID Penumpang<br>(KTP/SIM/ Tgl Lahir)</th>
				<th>Tempat Jemput</th>
				<th>No. Kursi</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		$sql_jadwal = mysqli_query($con, "SELECT * FROM tb_booking_detail WHERE no_booking = '$no_booking'") or die ($con->error);
		while($data = mysqli_fetch_array($sql_jadwal)) { ?>
			<tr>
				<td align="center"><?=$no++; ?>.</td>
				<td><?=$data['nama_penumpang']; ?></td>
				<td><?=$data['noid_penumpang']; ?></td>
				<td><?=$data['tempat_jemput']; ?></td>
				<td align="center"><?=$data['nokursi_penumpang']; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>