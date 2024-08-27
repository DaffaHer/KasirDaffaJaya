<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="alert alert-success">
        Transaksi berhasil disimpan!
    </div>
<?php endif; ?>


<?php
$transaksi = Transaksi::getInstance($pdo);
$member = Member::getInstance($pdo);
$memberUmum = $member->getUmum();


if (isset($_POST['submit'])) {
    $id_kasir = $_POST['id_kasir'];
    $id_member = $_POST['id_member'];
    $invoice = $_POST['invoice'];
    $tanggal = $_POST['tanggal'];

    if ($transaksi->addTransaksi($id_kasir, $id_member, $tanggal, $invoice)) {
        echo 'Bisa';
    } else {
        echo 'tidak';
    };
}
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Transaksi</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Form Transaksi -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Transaksi</h3>
                </div>
                <form action="index.php?page=transaksi" method="POST">
                    <div class="card-body">
                        <div class="row">
                            <!-- ID Kasir (Hidden) -->
                            <input type="hidden" name="id_kasir" value="<?php echo $_SESSION['user']['id_user']; ?>">

                            <!-- ID Member -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="member" class="col-sm-3 col-form-label">Member</label>
                                    <div class="col-9">
                                        <select name="id_member" id="member" class="form-control">
                                            <option>-- Member --</option> <!-- Menggunakan value "0" untuk member umum -->
                                            <?php
                                            foreach ($member->getAll() as $row):
                                            ?>
                                                <option value="<?= $row['id_member'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- No Invoice -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="invoice">No Invoice</label>
                                    <input type="text" name="invoice" id="invoice" class="form-control" value="INV<?php echo time(); ?>" readonly>
                                </div>
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary btn-block">
                                <i class="nav-icon fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Barang yang Ditambahkan -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Daftar Transaksi</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Invoice</th>
                                <th>Nama Member</th>
                                <th>Total Poin</th>
                                <th>No telepon</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="transaksi-details">
                            <?php
                            $rows = $transaksi->getTransaksi();
                            foreach ($rows as $row):
                            ?>
                                <tr>
                                    <td><?= $row['id_transaksi'] ?></td>
                                    <td><?= $row['invoice'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['total_poin'] ?></td>
                                    <td><?= $row['no_telp'] ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td>
                                        <a href="index.php?page=transaksi&act=detail&id_transaksi=<?php echo $row['id_transaksi'] ?>" class="btn btn-info btn-sm"><i class="nav-icon fas fa-shopping-basket"></i></a>
                                        <button class="btn btn-danger btn-sm" onclick="hapusData(<?php echo $row['id_transaksi']; ?>)"><i class="nav-icon fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- <script>
    document.getElementById('btnTambah').addEventListener('click', function() {
        // Ambil data dari form
        const memberSelect = document.getElementById('member');
        const selectedOption = memberSelect.options[memberSelect.selectedIndex];
        const namaMember = selectedOption.getAttribute('data-nama');
        const alamat = selectedOption.getAttribute('data-alamat');
        const jenisKelamin = selectedOption.getAttribute('data-jenis_kelamin');
        const totalPoin = selectedOption.getAttribute('data-total_poin');
        const noTelepon = selectedOption.getAttribute('data-no_telepon');

        const noInvoice = document.getElementById('invoice').value;
        const tanggal = document.getElementById('tanggal').value;

        // Tambahkan data ke tabel
        const tableBody = document.getElementById('transaksi-details');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
        <td>${tableBody.rows.length + 1}</td>
        <td>${namaMember}</td>
        <td>${alamat}</td>
        <td>${jenisKelamin}</td>
        <td>${totalPoin}</td>
        <td>${noTelepon}</td>
        <td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>
    `;

        tableBody.appendChild(newRow);
    });

    // Fungsi untuk menghapus baris
    function removeRow(button) {
        button.closest('tr').remove();
    }
</script> -->

<!-- /.content-wrapper -->

<script>
    function hapusData(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?page=transaksi&act=hapus&id_transaksi=' + id;
            }
        });
    }
</script>