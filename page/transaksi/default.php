<?php
include_once "database/koneksi.php";
include_once "database/class/transaksi.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    
    case 'tambah':
        include 'index.php';
        break;
    case 'hapus':
        include 'delete.php';
        break;
    case 'cetak':
        include 'cetak.php';
        break;
    case 'laporan':
        include 'laporan.php';
        break;
    default:
        include 'laporan.php';
        break;
}
