<div class="row">
    <div class="col-lg-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="padding:20px 0;">
                <h3 class="panel-title">Registrasi Akun e-Ticketing</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $nama = mysqli_real_escape_string($con, trim($_POST['nama']));
                            $jk = mysqli_real_escape_string($con, trim($_POST['jk']));
                            $telp = mysqli_real_escape_string($con, trim($_POST['telp']));
                            $alamat = mysqli_real_escape_string($con, trim($_POST['alamat']));
                            $email = mysqli_real_escape_string($con, trim($_POST['email']));
                            $pass = mysqli_real_escape_string($con, trim($_POST['pass']));
                            $md5 = md5($pass);
                            $sql_cekemail = mysqli_query($con, "SELECT email_user FROM tb_user WHERE email_user = '$email'") or die(mysqli_error());
                            if (mysqli_num_rows($sql_cekemail) > 0) {
                                echo '<div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    Email ini sudah digunakan oleh user lain!
                                </div>';
                            } else {
                                mysqli_query($con, "INSERT INTO tb_user VALUES (null, '$nama', '$jk', '$telp', '$alamat', '$email', '$md5')") or die($con->error);
                                header("location: " . $base_url . "/?p=login");
                            }
                        }
                        ?>
                        <div class="form-group">
                            <input class="form-control" placeholder="Nama Lengkap" name="nama" type="text" autofocus required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="jk" required>
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="No. Telepon" name="telp" type="text" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" name="email" type="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Password" name="pass" type="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block">Register</button>
                        </div>
                        Jika sudah punya akun silahkan <a href="<?= $base_url; ?>/?p=login" class="btn btn-success btn-xs">Login</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>