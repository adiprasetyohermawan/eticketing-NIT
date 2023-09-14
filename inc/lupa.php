<div class="row">
    <div class="col-lg-4 col-md-offset-4">
        <div class="panel panel-success">
            <div class="panel-heading text-center" style="padding:20px 0;">
                <h3 class="panel-title">Lupa Password</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post" autocomplete="off">
                    <fieldset>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            
                            $email                  = mysqli_real_escape_string($con, trim($_POST['email']));
                            $nama                   = mysqli_real_escape_string($con, trim($_POST['nama']));
                            $telp                   = mysqli_real_escape_string($con, trim($_POST['telp']));
                            $password_baru          = mysqli_real_escape_string($con, trim($_POST['newPassword']));
                            $konfirmasi_password    = mysqli_real_escape_string($con, trim($_POST['confirmPassword']));

                            $sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE email_user = '$email' AND nama_user = '$nama' AND telp_user = '$telp'") or die($con->error);
                            $data = mysqli_fetch_array($sql_user);
                            //Cek retrieve id_user sudah benar
                            // echo $data['id_user'];
                            
                            if ($sql_user->num_rows) {
                              if (strlen($password_baru) >= 5) {
                                if ($password_baru == $konfirmasi_password) {
                                  $md5_password_baru = md5($password_baru);
                                  $id_user           = $data['id_user'];

                                  $update            = mysqli_query($con, "UPDATE tb_user SET password_user='$md5_password_baru' WHERE id_user='$id_user'") or die($con->error);

                                  if ($update) {
                                    echo "<div class='alert alert-success alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password berhasil diubah!</div>";
                                  } else {
                                    echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Gagal mengubah password!</div>";
                                  }
                                } else {
                                  echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Konfirmasi password tidak cocok!</div>";
                                } 
                              } else {
                                echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Minimal password baru adalah 5 karakter!</div>";
                              }
                            } else {
                              echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Data akun yang Anda masukkan salah!</div>";
                            }
                        }
                        ?>
                        <label for="">Data Akun</label>
                        <div class="form-group">
                            <input class="form-control" placeholder="Masukkan e-mail akun Anda" name="email" type="email" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Masukkan nama lengkap akun Anda" name="nama" type="text" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Masukkan no. telepon akun Anda" name="telp" type="text" required>
                        </div>
                        <label for="">Reset Password</label>
                        <div class="form-group">
                            <input class="form-control" placeholder="Masukkan password baru" name="newPassword" type="password" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Masukkan lagi password baru" name="confirmPassword" type="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </div>
                        <div class="clearfix"></div>
                        Sudah ingat password? Silahkan <a href="<?= $base_url; ?>/?p=login" class="btn btn-warning btn-xs">Login</a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>