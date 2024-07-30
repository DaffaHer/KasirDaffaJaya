<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tabel Barang</title>
    <!-- Link AdminLte-Css -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Barang</h1>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?page=barang&act=tambah" class="btn btn-primary float-right">Tambah Barang</a>
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
                            <h3 class="card-title">Data Barang</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Stok Barang</th>
                                        <th>Gambar Barang</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $pdo = Koneksi::connect();
                                    $barang = Barang::getInstance($pdo);
                                    $dataBarang = $barang->getAll();
                                    $no = 1;

                                    foreach ($dataBarang as $row) {
                                    ?>  
                                        <tr>
                                            <td><?php echo $no++?></td>
                                            <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['harga_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['stok_barang']); ?></td>
                                            <td>
                                            <?php
                                            $gambarPath = 'uploads/' . htmlspecialchars($row['gambar']);
                                            if (file_exists($gambarPath)) {
                                                echo '<img src="' . $gambarPath . '" width=200>';
                                            } else {
                                                echo 'Gambar tidak ditemukan';
                                            }
                                            ?>
                                            </td>
                                            <td>
                                                <a href="index.php?page=barang&act=edit&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-info btn-sm">Edit</a>
                                                <a href="index.php?page=barang&act=hapus&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                            </td>   
                                        </tr>
                                    <?php
                                    }

                                    Koneksi::disconnect();
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
