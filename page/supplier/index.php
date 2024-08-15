<?php
if ($_SESSION['user']['role'] == "kasir") {
    echo "<script>window.location.href = 'index.php'</script>";
}
?>
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
                                    $dataSupplier = $supplier->getAll();
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
                                                <button class="btn btn-danger btn-sm" onclick="hapusData(<?php echo $row['id_supplier']; ?>)">Hapus</button>
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
                window.location.href = 'index.php?page=supplier&act=hapus&id_supplier=' + id;
            }
        });
    }
</script>