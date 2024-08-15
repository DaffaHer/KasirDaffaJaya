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

