<title>Laporan Booking | Admin e-Ticketing</title>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Laporan Booking</h1>
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
                            <label for="tgl">Tanggal Booking</label>
                            <input type="date" class="form-control" id="tgl" name="tgl">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
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
    var url = '&d='+tgl;
    my = window.open('?page=booking_print'+url, '_blank');
}
</script>