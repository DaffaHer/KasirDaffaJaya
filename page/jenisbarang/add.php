<?php

$pdo = Koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);


    $result = $jenis_barang->add($nama_jenis_barang);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=jenisbarang';</script>";
    } else {
        echo "Terjadi kesalahan saat menambahkan data.";
    }
}
?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Tambah Jenis Barang</h3>
            </div>

            <form action="" method="post">
                <div class="form-group">
                    <label>Nama Jenis Barang</label>
                    <input name="nama_jenis_barang" type="text" class="form-control" placeholder="Nama Jenis Barang" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=jenisbarang" class="btn btn-secondary">Kembali</a>
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