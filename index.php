<?php
session_start();


if (isset($_GET['page'])) {
    $halaman_get = $_GET['page'];
} else {
    $halaman_get = "";
}

if (!isset($_SESSION['user'])) {
    if ($halaman_get == "register") {
    } else if ($halaman_get != "login") {
        header('Location: index.php?page=login');
        exit();
    }
} else {
    if ($halaman_get == "login") {
        header('Location: index.php');
        exit();
    }
}


if (isset($_SESSION['user'])) {
    if ($halaman_get == "login" ||  $halaman_get == "register") {
        header('Location: index.php?');
    }
}

switch ($halaman_get) {
    case 'barang':
        $title = "Halaman Barang";
        include('layout/header.php');
        include('page/barang/default.php');
        include('layout/footer.php');
        break;

    case 'jenisbarang':
        $title = "Halaman Jenis Barang";
        include('layout/header.php');
        include('page/jenisbarang/default.php');
        include('layout/footer.php');
        break;

    case 'transaksi':
         $title = "Halaman Transaksi";
         include('layout/header.php');
         include('page/transaksi/default.php');
         include('layout/footer.php');
         break;
    

    case 'member':
        $title = "Halaman Member";
        include('layout/header.php');
        include('page/member/default.php');
        include('layout/footer.php');
        break;
    
    case 'user':
        $title = "Halaman User";
        include('layout/header.php');
        include('page/user/default.php');
        include('layout/footer.php');
        break;

    case 'supplier':
        $title = "Halaman Supplier";
        include('layout/header.php');
        include('page/supplier/default.php');
        include('layout/footer.php');
        break;

    case 'login':
        $title = "Halaman login";
        include('page/user/login.php');
        break;

    case 'logout':
        include('page/user/logout.php');
        break;


    default:
 
        $title = "Halaman Utama";
        include('layout/header.php');
        include('default.php');
        include('layout/footer.php');
        break;
}

?>
