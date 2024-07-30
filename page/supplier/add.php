<?php

$pdo = Koneksi::connect();
$supplier = Supplier::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $alamat_supplier = htmlspecialchars($_POST['alamat_supplier']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_rekening = htmlspecialchars($_POST['no_rekening']);

    $result = $supplier->add($nama_supplier, $alamat_supplier, $no_telp, $no_rekening);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=supplier';</script>";
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
    <title>Tambah Supplier</title>
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
                <h3>Tambah Supplier</h3>
            </div>
            <form action="" method="post">
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input name="nama_supplier" type="text" class="form-control" placeholder="Nama Supplier" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input name="alamat_supplier" type="text" class="form-control" placeholder="Alamat" required>
                </div>
                <div class="form-group">
                    <label>No Telepon</label>
                    <input name="no_telp" type="text" class="form-control" placeholder="No Telepon" required>
                </div>
                <div class="form-group">
                    <label>No Rekening</label>
                    <input name="no_rekening" type="text" class="form-control" placeholder="No Rekening" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
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
