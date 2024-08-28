<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$id_transaksi = $_GET['id_transaksi'];
$barangList = $transaksi->getBarang();
$invoice = $transaksi->getInvoiceByTransaksi($id_transaksi);

if(isset($_POST['tambahbarang'])){

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
                                
                            </table>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Harga</h5>
                                <h3>Rp. <?= isset($total_keseluruhan) ? number_format($total_keseluruhan, 0, ',', '.') : '0'; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div><!-- /.wrapper -->