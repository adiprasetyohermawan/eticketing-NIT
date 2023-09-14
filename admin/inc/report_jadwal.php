<title>Laporan Jadwal | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Laporan Jadwal</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- <div class="panel-heading">
                <i class="fa fa-print fa-fw"></i>
            </div> -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tgl">Tanggal Berangkat</label>
                            <input type="date" class="form-control" id="tgl" name="tgl">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_armd">Armada</label>
                            <select class="form-control" name="id_armd" id="id_armd">
                                <option value=""></option>
                                <?php $sql_armd = mysqli_query($con, "SELECT * FROM tb_armada") or die (mysqli_error());
                                while ($data_armd = mysqli_fetch_array($sql_armd)) {
                                    echo '<option value="'.$data_armd['id_armd'].'">'.$data_armd['jenis_armd'].' - ('.$data_armd['nopol_armd'].')</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_sopir">Sopir</label>
                            <select class="form-control" name="id_sopir" id="id_sopir">
                                <option value=""></option>
                                <?php $sql_sopir = mysqli_query($con, "SELECT * FROM tb_sopir") or die (mysqli_error());
                                while ($data_sopir = mysqli_fetch_array($sql_sopir)) {
                                    echo '<option value="'.$data_sopir['id_sopir'].'">'.$data_sopir['nama_sopir'].'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success" onclick="print()">Cetak</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function print() {
    var tgl = $('#tgl').val();
    var id_armd = $('#id_armd').val();
    var id_sopir = $('#id_sopir').val();
    var url = '&d='+tgl+'&arm='+id_armd+'&spr='+id_sopir;
    my = window.open('?page=jadwal_print'+url, '_blank');
}
</script>