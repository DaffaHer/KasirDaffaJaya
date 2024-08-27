<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$invoice = $_GET['invoice'];


if (isset($_POST['tambahbarang'])) {

    $invoice = htmlspecialchars($_POST['invoice']);

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
                        <h4>Detail Transaksi : <?= $invoice ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama-barang">Nama Barang</label>
                                    <select class="form-control" id="nama-barang">
                                        <option value="barang1">Barang 1</option>
                                        <option value="barang2">Barang 2</option>
                                        <option value="barang3">Barang 3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah-produk">Jumlah Produk</label>
                                    <input type="number" class="form-control" id="jumlah-produk" placeholder="Masukkan jumlah">
                                </div>
                                <button class="btn btn-primary btn-block">Tambah Produk</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body table-responsive">
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
                                    <tbody>
                                    <!-- Data produk ditambahkan di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5>Total Harga</h5>
                                <h3>Rp. <?php echo isset($total_keseluruhan) ? number_format($total_keseluruhan, 0, ',', '.') : '0'; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
</div><!-- /.wrapper -->