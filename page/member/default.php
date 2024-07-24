<?php
    include_once "database/koneksi.php";
    include_once "database/koneksi.php";

$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {

    case 'tambah':
        include ('add.php');
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