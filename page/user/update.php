<?php
if (empty($_GET['id_user'])) {
    header("Location: index.php?page=user");
    exit();
}

$id_user = $_GET['id_user'];
$pdo = koneksi::connect();
$user = User::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $role = $_POST['role'];

    if ($user->update($id_user, $nama, $username, $email, $password, $role)) {
        header("Location: index.php?page=user");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $user->getID($id_user);

    if (!$data) {
        header("Location: index.php?page=user");
        exit();
    }

    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data['username']);
    $email = htmlspecialchars($data['email']);
    $password = htmlspecialchars($data['password']);
    $role = htmlspecialchars($data['role']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-2">
            <div class="mb-4">
                <h3>Edit User</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama" required value="<?php echo htmlspecialchars($nama); ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" placeholder="Username" required value="<?php echo htmlspecialchars($username); ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Email" required value="<?php echo htmlspecialchars($email); ?>">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="kasir" <?php if($role == 'kasir') echo 'selected'; ?>>Kasir</option>
                        <option value="admin" <?php if($role == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="superadmin" <?php if($role == 'superadmin') echo 'selected'; ?>>Super Admin</option>
                    </select>
                </div>
                <div class="form-group">
                    <a href="index.php?page=user&act=confirm-password&id_user=<?php echo $id_user; ?>" class="btn btn-info btn-sm">Ganti Password</a>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
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
