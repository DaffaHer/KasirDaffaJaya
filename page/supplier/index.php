<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Supplier</title>
    <!-- Link AdminLte-Css -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?page=supplier&act=tambah" class="btn btn-primary float-right">Tambah Supplier</a>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Table -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Supplier</h3>
                    </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>No Rekening</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                             <?php

                            $pdo = Koneksi::connect();
                            $supplier = Supplier::getInstance($pdo);
                            $dataSupplier= $supplier->getAll();
                            $no = 1;
                 
                                foreach ($dataSupplier as $row) {
                            ?>  
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat_supplier']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_rekening']); ?></td>
                                    <td>
                                    <a href="index.php?page=supplier&act=edit&id_supplier=<?php echo $row['id_supplier'] ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="index.php?page=supplier&act=hapus&id_supplier=<?php echo $row['id_supplier'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>   
                                </tr>
                            <?php
                                }
                                 koneksi::disconnect();
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


    <!-- AdminLTE JS -->
    <script src="asset/dist/js/adminlte.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>
