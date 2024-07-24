<?php 

if (empty($_GET['id_barang'])) {
    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
}

$id_barang = $_GET['id_barang'];

if (isset($_POST['simpan'])) {

    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $stok_barang = $_POST['stok_barang'];

    $pdo = koneksi::connect();
    $sql = "UPDATE barang SET nama_barang=?, harga_barang=?, stok_barang=? WHERE id_barang=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_barang, $harga_barang, $stok_barang, $id_barang));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM barang WHERE id_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_barang));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=barang' </script> ";
        exit();
    }

    $nama_barang = $data['nama_barang'];
    $harga_barang = $data['harga_barang'];
    $stok_barang = $data['stok_barang'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>

    <!-- Rapikan Tabel Teks -->
    <div class="content-wrapper">
     <div class="content-header">
        
            <div class="container mt-5">
            <div class="mb-4">
            <h3>Edit Barang</h3>
                </div>
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required value="<?php echo htmlspecialchars($nama_barang); ?>">
                </div>
             <div class="form-group">
                <label>Harga Satuan</label>
                <input name="harga_barang" type="text" class="form-control" placeholder="Harga Barang" required value="<?php echo htmlspecialchars($harga_barang); ?>">
                </div>
            <div class="form-group">
                <label>Stok Barang</label>
                <input name="stok_barang" type="text" class="form-control" placeholder="Stok Barang" required value="<?php echo htmlspecialchars($stok_barang); ?>">
                </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-warning">Kembali</a>
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
