<?php 

if (empty($_GET['id_member'])) {
    echo "<script> window.location.href = 'index.php?page=member' </script>";
    exit();
}

$id_member = $_GET['id_member'];

if (isset($_POST['simpan'])) {

    $id_member = $_POST['id_member'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_poin = $_POST['total_poin'];
    $no_telp = $_POST['no_telp'];

    try {
        $pdo = koneksi::connect();
        $sql = "UPDATE member SET nama=?, alamat=?, jenis_kelamin=?, total_poin=?, no_telp=? WHERE id_member=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nama, $alamat, $jenis_kelamin, $total_poin, $no_telp, $id_member));
        koneksi::disconnect();

        echo "<script> window.location.href = 'index.php?page=member' </script>";
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        $pdo = koneksi::connect();
        $sql = "SELECT * FROM member WHERE id_member = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_member));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            echo "<script> window.location.href = 'index.php?page=member' </script>";
            exit();
        }

        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $total_poin = $data['total_poin'];
        $no_telp = $data['no_telp'];
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
    <title>Edit Member</title>
    
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container mt-5">
                <div class="mb-4">
                    <h3>Edit Member</h3>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <input name="nama" type="text" class="form-control" placeholder="Nama Member" required value="<?php echo htmlspecialchars($nama); ?>">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input name="alamat" type="text" class="form-control" placeholder="Alamat Member" required value="<?php echo htmlspecialchars($alamat); ?>">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" <?php if($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                            <option value="Perempuan" <?php if($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Poin</label>
                        <input name="total_poin" type="text" class="form-control" placeholder="Total Poin Member" required value="<?php echo htmlspecialchars($total_poin); ?>">
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input name="no_telp" type="text" class="form-control" placeholder="No Telepon Member" required value="<?php echo htmlspecialchars($no_telp); ?>">
                    </div>
                    <input type="hidden" name="id_member" value="<?php echo htmlspecialchars($id_member); ?>">
                    <div class="form-group">
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        <a href="index.php?page=member" class="btn btn-warning">Kembali</a>
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
