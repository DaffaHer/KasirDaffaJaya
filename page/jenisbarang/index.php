<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Jenis Barang</h1>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?page=jenisbarang&act=tambah" class="btn btn-primary float-right">Tambah Jenis Barang</a>
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
                            <h3 class="card-title">Data Jenis Barang</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Nama Jenis Barang</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $pdo = Koneksi::connect();
                                    $jenis_barang = Jenisbarang::getInstance($pdo);
                                    $dataJenisbarang = $jenis_barang->getAll();
                                    $no = 1;
                                    foreach ($dataJenisbarang as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                                            <td>
                                                <a href="index.php?page=jenisbarang&act=edit&id_jenis_barang=<?php echo $row['id_jenis_barang'] ?>" class="btn btn-info btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm" onclick="hapusData(<?php echo $row['id_jenis_barang']; ?>)">Hapus</button>
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
                window.location.href = 'index.php?page=jenisbarang&act=hapus&id_jenis_barang=' + id;
            }
        });
    }
</script>