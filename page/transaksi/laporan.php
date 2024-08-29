<?php
require_once "database/class/transaksi.php";
require_once "database/koneksi.php";

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);

// Ambil data laporan penjualan yang sudah diurutkan berdasarkan tanggal
$laporan = $transaksi->getLaporanPenjualan();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Penjualan</h1>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container-fluid">
            <!-- Ganti button dengan tag <a> dengan class btn langsung -->
            <a href="index.php?page=transaksi&act=cetak" class="btn btn-danger" target="_blank">PRINT LAPORAN</a>
            <button id="btnTambahTransaksi" class="btn btn-success">Tambah Transaksi</button>

            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice</th>
                                            <th>Tanggal</th>
                                            <th>Total Transaksi</th>
                                            <th>Diskon</th>
                                            <th>Kasir</th>
                                            <th>Member</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($laporan)): ?>
                                            <?php foreach ($laporan as $row => $transaksi): ?>
                                                <tr>
                                                    <td><?= $row + 1 ?></td>
                                                    <td><?= htmlspecialchars($transaksi['invoice']) ?></td>
                                                    <td><?= htmlspecialchars($transaksi['tanggal']) ?></td>
                                                    <td>Rp. <?= number_format($transaksi['total_transaksi'], 0, ',', '.') ?></td>
                                                    <td>Rp. <?= number_format($transaksi['total_diskon'], 0, ',', '.') ?></td>
                                                    <td><?= htmlspecialchars($transaksi['kasir']) ?></td>
                                                    <td><?= htmlspecialchars($transaksi['member']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('btnTambahTransaksi').addEventListener('click', function() {
        window.location.href = 'index.php?page=transaksi&act=tambah';
    });
</script>