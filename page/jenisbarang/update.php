<?php 

if (empty($_GET['id_jenis_barang'])) {
    echo "<script> window.location.href = 'index.php?page=jenisbarang' </script>";
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];

if (isset($_POST['simpan'])) {

    $id_jenis_barang = $_POST['id_jenis_barang'];
    $nama_jenis_barang = $_POST['nama_jenis_barang'];

    try {
        $pdo = koneksi::connect();
        $sql = "UPDATE jenis_barang SET nama_jenis_barang=? WHERE id_jenis_barang=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nama_jenis_barang, $id_jenis_barang));
        koneksi::disconnect();

        echo "<script> window.location.href = 'index.php?page=jenisbarang' </script>";
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        $pdo = koneksi::connect();
        $sql = "SELECT * FROM jenis_barang WHERE id_jenis_barang = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_jenis_barang));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            echo "<script> window.location.href = 'index.php?page=jenisbarang' </script>";
            exit();
        }

        $nama_jenis_barang = $data['nama_jenis_barang'];
        koneksi::disconnect();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jenis Barang</title>
    
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">

</head>
<body>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container mt-5">
                <div class="mb-4">
                    <h3>Edit Jenis Barang</h3>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Nama Jenis Barang</label>
                        <input name="nama_jenis_barang" type="text" class="form-control" placeholder="Nama Jenis Barang" required value="<?php echo htmlspecialchars($nama_jenis_barang); ?>">
                    </div>
                    <input type="hidden" name="id_jenis_barang" value="<?php echo htmlspecialchars($id_jenis_barang); ?>">
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        <a href="index.php?page=jenisbarang" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="asset/dist/js/adminlte.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
