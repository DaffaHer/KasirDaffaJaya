<?php

$pdo = Koneksi::connect();
$member = Member::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $total_poin = htmlspecialchars($_POST['total_poin']);
    $no_telp = htmlspecialchars($_POST['no_telp']);

    $result = $member->add($nama, $alamat, $jenis_kelamin, $total_poin, $no_telp);

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=member';</script>";
    } else {
        echo "Terjadi kesalahan saat menambahkan data.";
    }
}
?>

<body>
<div class="content-wrapper">
    <div class="content-header">
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Member</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Member</label>
                <input name="nama" type="text" class="form-control" placeholder="Nama Member" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" type="text" class="form-control" placeholder="Alamat" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Total Poin</label>
                <input name="total_poin" type="text" class="form-control" placeholder="Poin" required>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telp" type="text" class="form-control" placeholder="No Telepon" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
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