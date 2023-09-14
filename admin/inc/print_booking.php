<title>Cetak Booking | RamaSakti Travel</title>
<div class="row">
	<div class="col-12">
		<table class="table table-bordered table-striped" style="font-size: 11px;">
			<thead>
				<tr>
                    <th>No.</th>
                    <th>Nomor Booking</th>
                    <th>Jadwal</th>
                    <th>Pemesan (Customer)</th>
                    <th>Jumlah Penumpang</th>
                    <th>Harga Total</th>
                    <th>Tanggal Booking</th>
                    <th>Status Booking</th>
                    <th>Status Bayar</th>
				</tr>
			</thead>
			<tbody>
            <?php $no = 1;
            $query = "SELECT * FROM tb_booking JOIN tb_jadwal ON tb_booking.id_jdwl = tb_jadwal.id_jdwl
            JOIN tb_user ON tb_booking.id_user = tb_user.id_user ";
            if(@$_GET['d'] != '') {
                $query .= "WHERE tgl_booking = '$_GET[d]'";
            }
            $sql_armada = mysqli_query($con, $query) or die ($con->error);
            while($data = mysqli_fetch_array($sql_armada)) { ?>
                <tr>
                    <td align="center"><?=$no++; ?>.</td>
                    <td align="center"><?=$data['no_booking']; ?></td>
                    <td>
                        <?=tgl($data['tgl_berangkat']); ?>
                    </td>
                    <td>
                        <?=$data['nama_user']; ?>
                    </td>
                    <td>
                        <?=$data['jumlah_penumpang']; ?>  orang
                    </td>
                    <td>Rp. <?=number_format($data['harga_total'], 2, ",", "."); ?></td>
                    <td><?=tgl($data['tgl_booking']); ?></td>
                    <td><?=ucfirst($data['status_booking']); ?></td>
                    <td>
                        <?=ucfirst($data['status_bayar']); ?>
                    </td>
                </tr>
            <?php } ?>
			</tbody>
		</table>
	</div>
</div>

 <script type="text/javascript">
 	window.print();
 </script>