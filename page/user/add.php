<?php

$pdo = Koneksi::connect();
$user = User::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = htmlspecialchars($_POST['role']);

    $result = $user->add($nama, $username, $email, $password, $role);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=user';</script>";
    } else {
        echo "Terjadi kesalahan saat menambahkan data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Tambah User</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Nama User</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" placeholder="Isi Username" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Masukkan Email Anda" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group col-md-6">
                            <label>Role</label>
                            <select class="form-control selectric" name="role" required>
                                <option value="kasir">kasir</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>

                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=user" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
        <script src="asset/dist/js/adminlte.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
