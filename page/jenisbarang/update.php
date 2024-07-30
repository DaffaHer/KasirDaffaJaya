<?php
if (empty($_GET['id_jenis_barang'])) {
    header("Location: index.php?page=jenisbarang");
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];
$pdo = koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);

    if ($jenis_barang->update($id_jenis_barang, $nama_jenis_barang)) {
        header("Location: index.php?page=jenisbarang");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $jenis_barang->getID($id_jenis_barang);

    if (!$data) {
        header("Location: index.php?page=jenisbarang");
        exit();
    }

    $nama_jenis_barang = htmlspecialchars($data['nama_jenis_barang']);

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
            <div class="container mt-2">
                <div class="mb-4">
                    <h3>Edit Jenis Barang</h3>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label> Jenis Barang</label>
                        <input name="nama_jenis_barang" type="text" class="form-control" placeholder="Jenis Barang" required value="<?php echo htmlspecialchars($nama_jenis_barang); ?>">
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
