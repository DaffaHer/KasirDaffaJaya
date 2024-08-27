<?php

$transaksi = Transaksi::getInstance($pdo);
$id_transaksi = $_GET['id_transaksi'];

if ($id_transaksi) {
    $transaksi->hapusTransaksi($id_transaksi);
    echo "<script>window.location.href = 'index.php?page=transaksi';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}
