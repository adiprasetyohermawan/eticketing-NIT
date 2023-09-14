<div class="row">
    <div class="col-lg-4 col-md-offset-4">
        <div class="panel panel-success">
            <div class="panel-heading text-center" style="padding:20px 0;">
                <h3 class="panel-title">Login Akun e-Ticketing</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <fieldset>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $email = mysqli_real_escape_string($con, trim($_POST['email']));
                            $pass = mysqli_real_escape_string($con, trim($_POST['pass']));
                            $md5 = md5($pass);
                            $sql_login = mysqli_query($con, "SELECT * FROM tb_user WHERE email_user = '$email' AND password_user = '$md5'") or die($con->error);
                            if (mysqli_num_rows($sql_login) > 0) {
                                $data = mysqli_fetch_array($sql_login);
                                $_SESSION['id_user'] = $data['id_user'];
                                $_SESSION['email_user'] = $data['email_user'];
                                $_SESSION['nama_user'] = $data['nama_user'];
                                if (@$_GET['id_jdwl'] != "") {
                                    header("location: " . $base_url . "?p=infojadwal");
                                } else {
                                    header("location: " . $base_url);
                                }
                            } else {
                                echo '<div class="alert alert-danger alert-dismissable">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                Login gagal! Username / password salah
	                            </div>';
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input class="form-control" placeholder="Password" name="pass" type="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                        </div>
                        <div class="clearfix"></div>
                        Belum punya akun? Silahkan <a href="<?= $base_url; ?>/?p=register" class="btn btn-warning btn-xs">Register</a>
                        <div class="clearfix"></div>
                        Lupa password? Silahkan <a href="<?= $base_url; ?>/?p=lupa" class="btn btn-warning btn-xs">Lupa</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>