<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tabel user</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="index.php?page=user&act=tambah" class="btn btn-primary float-right">Tambah user</a>
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
                                <h3 class="card-title">Data user</h3>
                        </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php

                                $pdo = Koneksi::connect();
                                $user = User::getInstance($pdo);
                                $dataUser= $user->getAll();
                                $no = 1;
                    
                                    foreach ($dataUser as $row) {
                                ?>  
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                                        <td>
                                        <a href="index.php?page=user&act=edit&id_user=<?php echo $row['id_user'] ?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=user&act=hapus&id_user=<?php echo $row['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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