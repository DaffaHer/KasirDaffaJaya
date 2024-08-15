<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tabel Member</h1>
                </div>
                <div class="col-sm-6">
                    <a href="index.php?page=member&act=tambah" class="btn btn-primary float-right">Tambah Member</a>
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
                            <h3 class="card-title">Data Member</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>Nama Member</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Total Poin</th>
                                        <th>No Telepon</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    require_once 'database/koneksi.php';
                                    $pdo = Koneksi::connect();
                                    $member = Member::getInstance($pdo);
                                    $dataMember = $member->getAll();
                                    $no = 1;
                                    foreach ($dataMember as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                            <td><?php echo htmlspecialchars($row['total_poin']); ?></td>
                                            <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                                            <td>
                                                <a href="index.php?page=member&act=edit&id_member=<?php echo $row['id_member'] ?>" class="btn btn-info btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm" onclick="hapusData(<?php echo $row['id_member']; ?>)">Hapus</button>
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
                window.location.href = 'index.php?page=member&act=hapus&id_member=' + id;
            }
        });
    }
</script>