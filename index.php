<?php

if(isset($_GET['page']))
{
    $halaman_get = $_GET['page'];
}else{
    $halaman_get = "";
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

    case 'supplier':
        $title = "Halaman Supplier";
        include('layout/header.php');
        include('page/supplier/default.php');
        include('layout/footer.php');
        break;


    default:
 
        $title = "Halaman Utama";
        include('layout/header.php');
        include('default.php');
        include('layout/footer.php');
        break;
}

?>
