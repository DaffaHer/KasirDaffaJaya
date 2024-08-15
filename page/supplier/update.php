<?php
if (empty($_GET['id_supplier'])) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$id_supplier = $_GET['id_supplier'];
$pdo = koneksi::connect();
$supplier = Supplier::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_supplier = htmlspecialchars($_POST['nama_supplier']);
    $alamat_supplier = htmlspecialchars($_POST['alamat_supplier']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $no_rekening = htmlspecialchars($_POST['no_rekening']);

    if ($supplier->update($id_supplier, $nama_supplier, $alamat_supplier, $no_telp, $no_rekening)) {
        echo "<script>window.location.href = 'index.php?page=supplier'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $supplier->getID($id_supplier);

    if (!$data) {
        echo "<script>window.location.href = 'index.php?page=supplier'</script>";
        exit();
    }

    $nama_supplier = htmlspecialchars($data['nama_supplier']);
    $alamat_supplier = htmlspecialchars($data['alamat_supplier']);
    $no_telp = htmlspecialchars($data['no_telp']);
    $no_rekening = htmlspecialchars($data['no_rekening']);
}
?>
    <!-- Rapikan Tabel Teks -->
    <div class="content-wrapper">
     <div class="content-header">
        
            <div class="container mt-2">
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
                <input name="no_rekening" type="text" class="form-control" placeholder="No Rekening" required value="<?php echo htmlspecialchars($no_rekening); ?>">
                </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                <a href="index.php" class="btn btn-warning">Kembali</a>
                </div>

                </form>
            </div>
        </div>
    </div>
