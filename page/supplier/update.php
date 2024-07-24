<?php 

if (empty($_GET['id_supplier'])) {
    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
    exit();
}

$id_supplier = $_GET['id_supplier'];

if (isset($_POST['simpan'])) {

    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier= $_POST['alamat_supplier'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];

    $pdo = koneksi::connect();
    $sql = "UPDATE supplier SET nama_supplier=?, alamat_supplier=?, no_telp=?, no_rekening=? WHERE id_supplier=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_supplier, $alamat_supplier, $no_telp, $no_rekening, $id_supplier));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM supplier WHERE id_supplier = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_supplier));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
        exit();
    }

    $nama_supplier = $data['nama_supplier'];
    $alamat_supplier = $data['alamat_supplier'];
    $no_telp = $data['no_telp'];
    $no_rekening = $data['no_rekening'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>

    <!-- Rapikan Tabel Teks -->
    <div class="content-wrapper">
     <div class="content-header">
        
            <div class="container mt-5">
            <div class="mb-4">
            <h3>Edit Supplier</h3>
                </div>
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input name="nama_supplier" type="text" class="form-control" placeholder="Nama Supplier" required value="<?php echo htmlspecialchars($nama_supplier); ?>">
                </div>
             <div class="form-group">
                <label>Alamat Supplier</label>
                <input name="alamat_supplier" type="text" class="form-control" placeholder="Alamat" required value="<?php echo htmlspecialchars($alamat_supplier); ?>">
                </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telp" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_telp); ?>">
                </div>
            <div class="form-group">
                <label>No Rekening</label>
                <input name="no_rekening" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_rekening); ?>">
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
