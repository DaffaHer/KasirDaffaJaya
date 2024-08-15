<?php

require_once 'database/koneksi.php';
require_once 'database/class/auth.php';

$pdo = Koneksi::connect();
$user = Auth::getInstance($pdo);

if ($user->isLoggedIn()) {
  header("Location: app/index.php");
}

if (isset($_POST["register"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $role = $_POST["role"];

    $result = $user->register($nama, $username, $email, $password, $role);

    if ($result) {
        echo "<div>
                    <div class='alert alert-success text-center'>
                        <div class='alert-title '>
                        Berhasil Registrasi !! <a href='index.php?page=login'> >>Login<< </a>
                    </div>
          </div>";

    } else {
        echo "Terjadi kesalahan saat melakukan registrasi.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasir Daffa | Registration </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a class="h1"><b>Kasir </b> Daffa</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new User</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="nama" class="form-control" placeholder="Full name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <select class="form-control selectric" name="role" required>
                <option value="#">Role</option>
                <option value="kasir">kasir</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
       </div>
       
          <!-- /.col -->
          <div class="col-4">
          <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="index.php?page=login" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="asset/plugins/jquery/jquery.min.js"></script>

<script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="asset/dist/js/adminlte.min.js"></script>
</body>
</html>
