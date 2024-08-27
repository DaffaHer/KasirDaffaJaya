<?php
    include_once "database/class/transaksi.php";
    include_once "database/class/member.php";
    include_once "database/koneksi.php";
    
    $act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {

    case 'tambah':
        include ('add.php');
        break;
    case 'detail':
        include ('detail.php');
        break;
    case 'edit':
        include ('update.php');
        break;
    case 'hapus':
        include ('delete.php');
        break;
        
    default:
        include ('index.php');
        break;
}