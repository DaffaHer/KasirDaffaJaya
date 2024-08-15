<?php
if (isset($_POST['login'])) {
  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['password']);

  require_once 'database/koneksi.php';
  require_once 'database/class/auth.php';

  $pdo = Koneksi::connect();
  $auth = Auth::getInstance($pdo);
  if ($auth->login($username, $password)) {
    header("Location: app/index.php");
    exit(); // Pastikan untuk berhenti setelah redirect
  } else {
    echo "Terjadi kesalahan saat menyimpan data.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasir Daffa | Login</title>
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
  <!-- iCheck Bootstrap -->
  <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
  <style>
    .login-box {
      max-width: 360px;
      margin: 10% auto; /* Jaga agar tetap di tengah */
    }
  </style>
</head>

<body class="login-page" style="min-height: 466px;">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a class="h1"><b>Kasir</b> Daffa</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Hei, Selamat Datang !</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
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
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </div>
          </div>
        </form>

        <p class="mb-1">
          <a href="#">Lupa kata sandi</a>
        </p>
        <p class="mb-0">
          <a href="index.php?auth=register" class="text-center">Register</a>
        </p>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="asset/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="asset/dist/js/adminlte.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Ambil parameter dari URL
      const urlParams = new URLSearchParams(window.location.search);
      const message = urlParams.get('message');

      // Tampilkan SweetAlert jika parameter message adalah 'sukses'
      if (message === 'sukses') {
        Swal.fire({
          title: 'Berhasil Logout!',
          text: 'Anda telah berhasil keluar dari sesi.',
          icon: 'success',
          confirmButtonText: 'OK',
          didClose: () => {
            // Redirect ke halaman login setelah SweetAlert ditutup
            window.location.href = 'index.php?auth=login';
          }
        });
      }
    });
  </script>

</body>
</html>
