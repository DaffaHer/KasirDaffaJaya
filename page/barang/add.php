<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- AdminLte CSS -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>

<body>
<div class="content-wrapper">
    <div class="content-header">
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Barang</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required>
            </div>
            <div class="form-group">
                <label>Harga Satuan</label>
                <input name="stok_barang" type="text" class="form-control" placeholder="Harga Satuan" required>
            </div>
            <div class="form-group">
                <label>Stok Barang</label>
                <input name="harga_barang" type="text" class="form-control" placeholder="Stok Barang" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
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

<?php

if(isset($_POST['simpan'])){

    $nama_barang = $_POST['nama_barang'];
    $stok_barang = $_POST['harga_barang'];
    $harga_barang = $_POST['stok_barang'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO barang (nama_barang,harga_barang,stok_barang) VALUES (?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_barang,$harga_barang,$stok_barang));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
}
?>
