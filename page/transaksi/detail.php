<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$id_transaksi = $_GET['id_transaksi'];
$barangList = $transaksi->getBarang();
$invoice = $transaksi->getInvoiceByTransaksi($id_transaksi);

if (isset($_POST['tambahbarang'])) {

    $id_barang = htmlspecialchars($_POST['id_barang']);
    $qty = htmlspecialchars($_POST['qty']);

    $transaksi->addDetail($id_transaksi, $id_barang, $qty);
}
?>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Detail Transaksi -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <h4>Detail Transaksi: <?= $invoice ?></h4> <!-- Menampilkan nomor invoice -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <form method="post">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <div class="form-group">
                                        <label for="nama-barang">Nama Barang</label>
                                        <select class="form-control" id="nama-barang" name="id_barang">
                                            <?php foreach ($barangList as $barang): ?>
                                                <option> -- Barang -- </option>
                                                <option value="<?= $barang['id_barang']; ?>"><?= $barang['nama_barang']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah-produk">Jumlah Produk</label>
                                        <input min="1" type="number" name="qty" placeholder="Masukkan jumlah" required class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="tambahbarang">Tambah Produk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Transaksi</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $rows = $transaksi->getTransaksiDetail($id_transaksi);
                                $i = 1;
                                foreach ($rows as $row) :
                                    $total = $row['qty'] * $row['harga_barang'];
                                ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $i ?></td>
                                        <td class="align-middle">
                                            <img src="asset/img/barang/<?php echo $row["gambar"] ?>" width="100px" alt="gambar">
                                        </td>
                                        <td class="align-middle"><?php echo $row["nama_barang"] ?></td>
                                        <td class="align-middle">Rp. <?php echo number_format($row["harga_barang"]) ?></td>
                                        <td class="align-middle"><?php echo $row["qty"] ?></td>
                                        <td class="align-middle">Rp. <?php echo number_format($total) ?></td>
                                        <td class="align-middle">
                                            <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Apakah Anda Yakin Ingin Menghapus Produk Dari Transaksi?" data-confirm-yes="window.location.href='index.php?page=transaksi&act=delete&id_barang=<?= $row['id_barang'] ?>&id_transaksi=<?= $row['id_transaksi'] ?>'"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $total = $transaksi->hargatotal($id_transaksi);
                                ?>
                                <h5>Total Harga</h5>
                                <h3>Rp. <?= number_format($total["total_harga"]) ?></h3>
                                <?php

            if ($rows == true) {
            ?>
                            </div>
                        </div>
                    </div>
                    <br>
                <!-- <a href="index.php?page=struk&act=pembayaran&id=<?= $id_transaksi ?>"> <button type="submit" style="font-size: 10px;" class="btn btn-primary btn-block" name="">
                        Selesaikan Transaksi
                    </button></a> -->
            <?php } ?>
                </div>
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div><!-- /.wrapper -->