<?php
require "../setting/+koneksi.php";
if (@$_SESSION['username_adm']) {
    header("location: " . $base_url . "/admin/");
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Admin e-Ticketing Travel</title>
        <!-- Core CSS - Include with every page -->
        <link href="<?= $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $base_url; ?>/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- SB Admin CSS - Include with every page -->
        <link href="<?= $base_url; ?>/assets/css/sb-admin.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-primary">
                        <div class="panel-heading text-center" style="padding:20px 0;">
                            <h3 class="panel-title">Login Admin e-Ticketing Travel</h3>
                        </div>
                        <div class="panel-body">
                            <form action="" method="post">
                                <fieldset>
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                        $user = mysqli_real_escape_string($con, trim($_POST['user']));
                                        $pass = mysqli_real_escape_string($con, trim($_POST['pass']));
                                        // $md5 = md5($pass);
                                        $sql_login = mysqli_query($con, "SELECT * FROM tb_admin WHERE username_adm = '$user' AND password_adm = '$pass'") or die(mysqli_error());
                                        if ((mysqli_num_rows($sql_login) > 0) && ($_SESSION['id_adm'] == 1)) {
                                            $data = mysqli_fetch_array($sql_login);
                                            $_SESSION['id_adm'] = $data['id_adm'];
                                            $_SESSION['username_adm'] = $data['username_adm'];
                                            header("location: " . $base_url . "/admin");
                                        } else if ((mysqli_num_rows($sql_login) > 0) && ($_SESSION['id_adm'] != 1)) {
                                            $data = mysqli_fetch_array($sql_login);
                                            $_SESSION['id_adm'] = $data['id_adm'];
                                            $_SESSION['username_adm'] = $data['username_adm'];
                                            header("location: " . $base_url . "/admin");
                                        } else {
                                            echo '<div class="alert alert-danger alert-dismissable">
			                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                                Login gagal! Username / password salah
			                            </div>';
                                        }
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="user" type="text" autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="pass" type="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-outline pull-right">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Scripts - Include with every page -->
        <script src="<?= $base_url; ?>/assets/js/jquery-1.10.2.js"></script>
        <script src="<?= $base_url; ?>/assets/js/bootstrap.min.js"></script>
        <!-- SB Admin Scripts - Include with every page -->
        <script src="<?= $base_url; ?>/assets/js/sb-admin.js"></script>
    </body>

    </html>
<?php
} ?>