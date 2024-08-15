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
                                        <th>Jenis Barang</th>
                                        <th>Harga Satuan</th>
                                        <th>Stok Barang</th>
                                        <th>Supplier Barang</th>
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
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['harga_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['stok_barang']); ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                                            <td>
                                                <?php
                                                $gambarPath = 'asset/img/barang/' . htmlspecialchars($row['gambar']);
                                                if (file_exists($gambarPath)) {
                                                    echo '<img src="' . $gambarPath . '" width=200>';
                                                } else {
                                                    echo 'Gambar tidak ditemukan';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="index.php?page=barang&act=edit&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-info btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm" onclick="hapusData(<?php echo $row['id_barang']; ?>)">Hapus</button>
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

<script>
    function hapusData(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?page=barang&act=hapus&id_barang=' + id;
            }
        });
    }
</script>