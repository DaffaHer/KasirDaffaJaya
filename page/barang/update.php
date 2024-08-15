<?php
if (empty($_GET['id_barang'])) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

$id_barang = $_GET['id_barang'];

$pdo = Koneksi::connect();
$barang = Barang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $harga_barang = htmlspecialchars($_POST['harga_barang']);
    $stok_barang = htmlspecialchars($_POST['stok_barang']);
    $supplier = isset($_POST['supplier']) ? htmlspecialchars($_POST['supplier']) : '';

    if (!empty($_FILES['gambar']['name'])) {
        $extensi = explode(".", $_FILES['gambar']['name']);
        $gambarbarang = "gambar-" . round(microtime(true)) . "." . end($extensi);
        $sumber = $_FILES['gambar']['tmp_name'];
        $upload = move_uploaded_file($sumber, "asset/img/barang/" . $gambarbarang);

        if ($upload) {
            $result = $barang->update($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $supplier, $gambarbarang);
        } else {
            echo "Gagal mengunggah gambar.";
            exit();
        }
    } else {
        $result = $barang->updateWithoutImage($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $supplier);
    }

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=barang'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $barang->getID($id_barang);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

$nama_barang = htmlspecialchars($data['nama_barang']);
$jenis_barang = htmlspecialchars($data['id_jenis_barang']);
$harga_barang = htmlspecialchars($data['harga_barang']);
$stok_barang = htmlspecialchars($data['stok_barang']);
$supplier = htmlspecialchars($data['id_supplier']); 

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-2">
            <div class="mb-4">
                <h3>Edit Barang</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" required>
                </div>

                <div class="form-group">
                    <label>Jenis Barang</label>
                    <select name="jenis_barang" class="form-control">
                        <option value="">Pilih Jenis</option>
                        <?php
                        $jenisBarangList = $barang->getAllJenisBarang();
                        foreach ($jenisBarangList as $jenis) {
                            $selected = $jenis_barang == $jenis['id_jenis_barang'] ? 'selected' : '';
                            echo "<option value='{$jenis['id_jenis_barang']}' $selected>{$jenis['nama_jenis_barang']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Supplier Barang</label>
                    <select name="supplier" class="form-control">
                        <option value="">Pilih Supplier</option>
                        <?php
                        $supplierList = $barang->getAllSupplier();
                        foreach ($supplierList as $supplierItem) {
                            $selected = $supplier == $supplierItem['id_supplier'] ? 'selected' : '';
                            echo "<option value='{$supplierItem['id_supplier']}' $selected>{$supplierItem['nama_supplier']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input name="harga_barang" type="number" class="form-control" placeholder="Harga Satuan" value="<?php echo $harga_barang; ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Stok Barang</label>
                    <input name="stok_barang" type="number" class="form-control" placeholder="Stok Barang" value="<?php echo $stok_barang; ?>" required>
                </div>

                <div class="form-group">
                    <label>Gambar Barang (Kosongkan jika tidak ingin mengganti)</label>
                    <input name="gambar" type="file" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

