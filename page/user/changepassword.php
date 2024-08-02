<?php
if (empty($_GET['id_user'])) {
    header("Location: index.php?page=user");
    exit();
}

$id_user = $_GET['id_user'];
$pdo = koneksi::connect();
$user = User::getInstance($pdo);

if (isset($_POST['ganti_password'])) {
    $new_password = htmlspecialchars($_POST['new_password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if ($new_password === $confirm_password) {
        if ($user->updatePassword($id_user, $new_password)) {
            echo "<script>alert('Password berhasil diubah'); window.location.href = 'index.php?page=user';</script>";
        } else {
            echo "Terjadi kesalahan saat mengubah password.";
        }
    } else {
        echo "Password baru tidak sesuai dengan konfirmasi password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-2">
            <div class="mb-4">
                <h3>Ganti Password</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input name="new_password" type="password" class="form-control" placeholder="Password Baru" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input name="confirm_password" type="password" class="form-control" placeholder="Konfirmasi Password Baru" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="ganti_password" class="btn btn-success">Ganti Password</button>
                    <a href="index.php?page=user" class="btn btn-warning">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="asset/dist/js/adminlte.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
