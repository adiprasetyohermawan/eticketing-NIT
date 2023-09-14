<?php
include "../../setting/+koneksi.php";

$id_jdwl = @mysqli_real_escape_string($con, $_POST['id_jdwl']);
?>
<div class="table-responsive">
	<table class="table table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>Berangkat</th>
				<th>Armada</th>
				<th>Kursi</th>
				<th>Jurusan</th>
				<th>Sopir</th>
				<th>Tiket</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$sql_jadwal = mysqli_query($con, "SELECT * FROM tb_jadwal JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs JOIN tb_sopir ON tb_jadwal.id_sopir = tb_sopir.id_sopir WHERE tb_jadwal.id_jdwl = '$id_jdwl'") or die ($con->error);
			$data = mysqli_fetch_array($sql_jadwal); ?>
			<tr>
				<td><?php echo indonesian_date($data['tgl_berangkat']); ?></td>
				<td><?=$data['jenis_armd']." - (".$data['nopol_armd'].")"; ?></td>
				<td><?=$data['jumlahkursi_armd']; ?></td>
				<td><?=$data['keberangkatan_jrs']." ke ".$data['tujuan_jrs']." (".$data['waktu_jrs'].")"; ?></td>
				<td><?=$data['nama_sopir']; ?></td>
				<td>Rp. <?=number_format($data['harga_tiket'], 2, ",", "."); ?> / orang</td>
			</tr>
		</tbody>
	</table>
</div>