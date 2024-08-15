<?php
if (empty($_GET['id_barang'])) header("Location: index.php");

$id_barang = $_GET['id_barang'];

$pdo = koneksi::connect();
$barang = barang::getInstance($pdo);


$barangInfo = $barang->getID($id_barang);
$namaFileGambar = $barangInfo['gambar']; 


$result = $barang->delete($id_barang);

if ($result) {
    $pathToFile = "asset/img/barang/" . $namaFileGambar;
    if (file_exists($pathToFile)) {
        unlink($pathToFile);
    }

    echo "<script>window.location.href = 'index.php?page=barang';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

koneksi::disconnect();
?>


