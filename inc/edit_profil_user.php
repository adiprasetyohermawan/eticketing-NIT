<div class="row">
    <div class="col-lg-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading text-center" style="padding:20px 0;">
                <h3 class="panel-title">Data Pribadi Anda</h3>
            </div>
            <div class="panel-body">
                <form action="" method="post">
                    <fieldset>

                        <?php
                        $sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = " . $_SESSION['id_user'] . "") or die(mysqli_error());
                        $data = mysqli_fetch_array($sql_user);
                        ?>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input class="form-control" placeholder="Nama Lengkap" name="nama" type="text" value="<?= $data['nama_user']; ?>" autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jk" name="jenis_kelamin" required>
                                <option value="L" <?php if ($data['jeniskelamin_user'] == 'L') {
                                                        echo 'selected';
                                                    } ?>>Laki-laki</option>
                                <option value="P" <?php if ($data['jeniskelamin_user'] == 'P') {
                                                        echo 'selected';
                                                    } ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telepon</label>
                            <input class="form-control" placeholder="No. Telepon" name="telp" type="text" value="<?= $data['telp_user']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" placeholder="Alamat" required><?= $data['alamat_user']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?= $data['email_user']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block">Update</button>
                        </div>


                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $nama = mysqli_real_escape_string($con, trim($_POST['nama']));
                            $jk = mysqli_real_escape_string($con, trim($_POST['jk']));
                            $telp = mysqli_real_escape_string($con, trim($_POST['telp']));
                            $alamat = mysqli_real_escape_string($con, trim($_POST['alamat']));
                            $email = mysqli_real_escape_string($con, trim($_POST['email']));

                            mysqli_query($con, "UPDATE tb_user SET nama_user = '$nama', jeniskelamin_user = '$jk', telp_user = '$telp', alamat_user = '$alamat', email_user = '$email' WHERE id_user = " . $_SESSION['id_user'] . "") or die($con->error);
                            header("location: " . $base_url . "/?p=login");
                        }
                        ?>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>