<title>Cetak Jadwal | RamaSakti Travel</title>
<div class="row">
	<div class="col-12">
		<table class="table table-bordered table-striped" style="font-size: 11px;">
			<thead>
				<tr>
					<th>No.</th>
					<th>Tgl Berangkat</th>
					<th>Armada</th>
					<th>Jumlah Kursi</th>
					<th>Jurusan</th>
					<th>Sopir</th>
					<th>Harga Tiket</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			$query = "SELECT * FROM tb_jadwal
			INNER JOIN tb_armada ON tb_jadwal.id_armd = tb_armada.id_armd
			INNER JOIN tb_jurusan ON tb_jadwal.id_jrs = tb_jurusan.id_jrs
			INNER JOIN tb_sopir ON tb_jadwal.id_sopir = tb_sopir.id_sopir ";
			if(@$_GET['d'] != '') {
				$query .= "WHERE tgl_berangkat = '$_GET[d]' ";
			}
			if(@$_GET['arm'] != '') {
				$query .= "AND tb_jadwal.id_armd = '$_GET[arm]' ";
			}
			if(@$_GET['spr'] != '') {
				$query .= "AND tb_jadwal.id_sopir = '$_GET[spr]'	 ";
			}			
			$query .= "ORDER BY tgl_berangkat DESC";
			$sql_jadwal = mysqli_query($con, $query) or die ($con->error);
			while($data = mysqli_fetch_array($sql_jadwal)) { ?>
				<tr>
					<td align="center"><?=$no++; ?>.</td>
					<td><?php echo tgl($data['tgl_berangkat']); ?></td>
					<td><?=$data['jenis_armd']." - (".$data['nopol_armd'].")"; ?></td>
					<td><?=$data['jumlahkursi_armd']; ?></td>
					<td><?=$data['keberangkatan_jrs']." ke ".$data['tujuan_jrs']."<br>(".$data['waktu_jrs'].")"; ?></td>
					<td><?=$data['nama_sopir']; ?></td>
					<td>Rp. <?=number_format($data['harga_tiket'], 2, ",", "."); ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

 <script type="text/javascript">
 	window.print();
 </script>