<?php

    include_once "database/class/user.php";
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

    case 'confirm-password':
        include('confirmpassword.php');
        break;
    case 'change-password':
        include('changepassword.php');
        break;
        
    default:
        include ('index.php');
        break;
}