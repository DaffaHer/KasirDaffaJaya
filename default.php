<?php
$pdo = koneksi::connect();

$sqlBarang ='SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlah_barang = $resultBarang->fetchColumn();

$sqlJenisBarang ='SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlMember ='SELECT COUNT(*) FROM member';
$resultMember = $pdo->query($sqlMember);
$jumlah_member = $resultMember->fetchColumn();

$sqlSupplier ='SELECT COUNT(*) FROM supplier';
$resultSupplier = $pdo->query($sqlSupplier);
$jumlah_supplier = $resultSupplier->fetchColumn();

$sqlUser ='SELECT COUNT(*) FROM user';
$resultUser = $pdo->query($sqlUser);
$jumlah_user = $resultUser->fetchColumn();

?>

<!-- Content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                   <h3>Barang</h3>
                                   <h1> <?= $jumlah_barang ?> </h1>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="index.php?page=barang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                        <div class="small-box bg-info">
                                <div class="inner">
                                   <h3> Jenis Barang </h3>
                                   <h1> <?= $jumlah_jenis_barang ?> </h1>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="index.php?page=jenisbarang" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                        <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Member</h3>
                                    <h1> <?= $jumlah_member ?> </h1>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="index.php?page=member" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                        <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Supplier</h3>
                                    <h1> <?= $jumlah_supplier ?> </h1>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-soup-can"></i>
                                </div>
                                <a href="index.php?page=supplier" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-6">
                        <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>User</h3>
                                    <h1> <?= $jumlah_user ?> </h1>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios-world"></i>
                                </div>
                                <a href="index.php?page=user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
        <!-- Content -->
