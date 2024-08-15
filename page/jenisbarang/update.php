<?php
if (empty($_GET['id_jenis_barang'])) {
    echo "<script>window.location.href = 'index.php?page=jenisbarang'</script>";
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];
$pdo = koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);

    if ($jenis_barang->update($id_jenis_barang, $nama_jenis_barang)) {
        echo "<script>window.location.href = 'index.php?page=jenisbarang'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $jenis_barang->getID($id_jenis_barang);

    if (!$data) {
        echo "<script>window.location.href = 'index.php?page=jenisbarang'</script>";
        exit();
    }

    $nama_jenis_barang = htmlspecialchars($data['nama_jenis_barang']);

}
?>

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