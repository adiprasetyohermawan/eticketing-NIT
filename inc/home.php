    <!-- /.panel-heading -->
    <div class="panel-body">
        <ul class="timeline">
            <li>
                <div class="timeline-badge info"><i class="fa fa-check"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading" align="center">
                        <h3 class="timeline-title"><b>Murah</b></h3>
                    </div>
                    <div class="timeline-body" align="center">
                        <h5 class="timeline-body">Memberikan harga yang terbaik <br>untuk menyempurnakan kenikmatan perjalanan anda</h5>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-badge warning"><i class="fa fa-thumbs-up"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-heading" align="center">
                        <h3 class="timeline-title"><b>Aman</b></h3>
                    </div>
                    <div class="timeline-body" align="center">
                        <p>Nusantara Indah Travel menggunakan armada yang dirawat secara berkala untuk menghasilkan perfoma terbaik dan supir berkendara secara aman dan cepat</p>
                    </div>
                </div>
            </li>
            <li>
                <div class="timeline-badge danger"><i class="fa fa-check"></i>
                </div>
                <div class="timeline-panel" align="center">
                    <div class="timeline-heading">
                        <h3 class="timeline-title"><b>Cepat</b></h3>
                    </div>
                    <div class="timeline-body">
                        <p>Nusantara Indah Travel menggunakan Jalan tol sebagai jalan yang akan dilalui sehingga dapat mencapai tujuan dengan cepat.</p>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-badge info"><i class="fa fa-save"></i>
                </div>
                <div class="timeline-panel" align="center">
                    <div class="timeline-heading">
                        <h3 class="timeline-title"><b>Ingin Pesan Online ????</b></h3>
                    </div>
                    <div class="timeline-body">
                        <h5><b>KLIK DIBAWAH INI <i class="fa fa-arrow-down"></i></b></h5>
                        <div class="btn-group">
                            <a href="<?=$base_url;?>/?p=infojadwal" type="button" class="btn btn-primary btn-lg">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="timeline-panel" align="center">
                    <div class="timeline-heading">
                        <h3 class="timeline-title"><b>Cara pesan ?</b></h3>
                    </div>
                    <div class="timeline-body">
                        <h5><b>KLIK DIBAWAH INI <i class="fa fa-arrow-down"></i></b></h5>
                        <div class="btn-group">
                            <a href="<?=$base_url;?>/?p=carapesan" type="button" class="btn btn-primary btn-lg">Cara Pesan</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="timeline-inverted">
                <div class="timeline-badge success"><i class="fa fa-thumbs-up"></i>
                </div>
                <div class="timeline-panel" align="center">
                    <div class="timeline-heading">
                        <h3 class="timeline-title"><b>Call Center</b></h3>
                    </div>
                    <div class="timeline-body">
                        <p>(024)76430727 | (024)76430808 | 082136197633</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- /.panel-body -->


<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("slideshow");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }

    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 7000);
    }
</script>