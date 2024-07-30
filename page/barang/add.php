<?php
if (isset($_POST['simpan'])) {
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $stok_barang = htmlspecialchars($_POST['stok_barang']);
    $harga_barang = htmlspecialchars($_POST['harga_barang']);
    $supplier = htmlspecialchars($_POST['supplier']);

    $image = $_FILES["gambar"]["name"];
    $tmpname = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];

    if ($error === UPLOAD_ERR_OK) {
        $newfilename = uniqid() . "." . pathinfo($image, PATHINFO_EXTENSION);
        if (move_uploaded_file($tmpname, 'uploads/' . $newfilename)) {
 
            $pdo = Koneksi::connect();
            $barang = Barang::getInstance($pdo);
            if ($barang->add($nama_barang, $jenis_barang, $harga_barang, $stok_barang, $supplier, $newfilename)) {
                echo "<script>window.location.href = 'index.php?page=barang'</script>";
            } else {
                echo "Terjadi kesalahan saat menyimpan data.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>

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
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required>
            </div>
            
            <div class="form-group">
                        <label>Jenis Barang</label>
                        <select name="jenis_barang" id="" class="form-control">
                            <option value="">Pilih Jenis</option>
                            <?php
                            $pdo = Koneksi::connect();
                            $barang = Barang::getInstance($pdo);
                            ?>
                            <?php foreach ($barang->getAllJenisbarang() as $jenis) : ?>
                                <option value="<?= $jenis['id_jenis_barang'] ?>">
                                    <?= $jenis['nama_jenis_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label>Supplier Barang</label>
                        <select name="supplier" id="" class="form-control">
                            <option value="">Pilih Supplier</option>
                            <?php
                            $pdo = Koneksi::connect();
                            $barang = Barang::getInstance($pdo);
                            ?>
                            <?php foreach ($barang->getAllSupplier() as $suppliers) : ?>
                                <option value="<?= $suppliers['id_supplier'] ?>">
                                    <?= $suppliers['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            

            <div class="form-group">
                <label>Harga Satuan</label>
                <input name="harga_barang" type="text" class="form-control" placeholder="Harga Satuan" required>
            </div>

            <div class="form-group">
                <label>Stok Barang</label>
                <input name="stok_barang" type="text" class="form-control" placeholder="Stok Barang" required>
            </div>
                    
            <div class="form-group">
                <label>Gambar Barang</label>
                <input name="gambar" type="file" class="form-control" placeholder="gambar" required>
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
