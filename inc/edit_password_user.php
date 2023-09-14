<?php
$sql_user = mysqli_query($con, "SELECT * FROM tb_user WHERE id_user = " . $_SESSION['id_user'] . "") or die(mysqli_error());
$data = mysqli_fetch_array($sql_user);

// Cek retrieve password lama (md5) dari database berhasil atau tidak
// echo $data['password_user'];
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $password_lama          = mysqli_real_escape_string($con, trim($_POST['currentPassword']));
  $password_baru          = mysqli_real_escape_string($con, trim($_POST['newPassword']));
  $konfirmasi_password    = mysqli_real_escape_string($con, trim($_POST['confirmPassword']));

  $md5_password_lama      = md5($password_lama);

  // Cek masukan password lama (md5) dari user berhasil atau tidak
  // echo $md5_password_lama;

  if ($data['password_user'] == $md5_password_lama) {
    if (strlen($password_baru) >= 5) {
      if ($password_baru == $konfirmasi_password) {
        $md5_password_baru = md5($password_baru);
        $id_user           = $_SESSION['id_user'];


        $update            = mysqli_query($con, "UPDATE tb_user SET password_user='$md5_password_baru' WHERE id_user='$id_user'") or die($con->error);


        if ($update) {
          echo "<div class='alert alert-success alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password berhasil diubah!</div>";
          // header("location: " . $base_url);
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
    echo "<div class='alert alert-danger alert-dismissable'> <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password lama tidak cocok!</div>";
  }
}
?>

<div class="row">
  <div class="col-lg-4 col-md-offset-4">
    <div class="panel panel-primary">
      <div class="panel-heading text-center" style="padding:20px 0;">
        <h3 class="panel-title">Ubah Password</h3>
      </div>
      <div class="panel-body">
        <form name="frmChange" action="" method="post" onSubmit="return validatePassword()">

          <div class="form-group">
            <label for="currentPassword">Password Lama</label>
            <input class="form-control" placeholder="Masukkan password lama Anda" name="currentPassword" type="password" required>
          </div>
          <div class="form-group">
            <label for="newPassword">Password Baru</label>
            <input class="form-control" placeholder="Masukkan password baru" name="newPassword" type="password" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Konfirmasi Password Baru</label>
            <input class="form-control" placeholder="Masukkan lagi password baru" name="confirmPassword" type="password" required>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-warning btn-block" name="submit" id="gantiPassword">Ubah Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>