<?php
if (empty($_GET['id_member'])) {
    echo "<script>window.location.href = 'index.php?page=member'</script>";
    exit();
}

$id_member = $_GET['id_member'];
$pdo = koneksi::connect();
$member = Member::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
    $total_poin = htmlspecialchars($_POST['total_poin']);
    $no_telp = htmlspecialchars($_POST['no_telp']);

    if ($member->update($id_member, $nama, $alamat, $jenis_kelamin, $total_poin, $no_telp)) {
        echo "<script>window.location.href = 'index.php?page=member'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $member->getID($id_member);

    if (!$data) {
        echo "<script>window.location.href = 'index.php?page=member'</script>";
        exit();
    }

    $nama = htmlspecialchars($data['nama']);
    $alamat = htmlspecialchars($data['alamat']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $total_poin = htmlspecialchars($data['total_poin']);
    $no_telp = htmlspecialchars($data['no_telp']);
}
?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container mt-2">
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
