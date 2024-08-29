<?php
include_once "database/class/transaksi.php";
include_once "database/class/member.php";
include_once "database/class/barang.php";

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$member = Member::getInstance($pdo);
$barang = Barang::getInstance($pdo);

$kodeNota = $transaksi->generateKodeNota();
$memberUmum = $member->getUmum();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaksi</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="index.php?page=transaksi&act=laporan" class="btn btn-info">
                        Laporan Penjualan
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <!-- Form Input -->
                <div class="col-lg-4">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Informasi Transaksi</h5>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="form-group">
                            <label for="kasir">Kasir</label>
                            <input type="text" name="kasir" class="form-control" value="<?= $_SESSION['user']['nama'] ?>" id="kasir" data-kasirid="<?= $_SESSION['user']['id_user'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="member">Member</label>
                            <select name="member" id="id_member" class="form-control">
                                <option value="<?= $memberUmum ?>">Umum</option>
                                <?php foreach ($member->getAll() as $row): ?>
                                    <?php if ($row['nama'] != 'Umum'): ?>
                                        <option value="<?= $row['id_member'] ?>"><?= htmlspecialchars($row['nama']) ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                </div>

                <!-- Form Input Barang -->
                <div class="col-lg-4">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Detail Barang</h5>
                        <div class="form-group">
                            <label for="barang">Barang</label>
                            <select name="barang" id="barang" class="form-control">
                                <option value="">-Nama Barang-</option>
                                <?php foreach ($barang->getAll() as $row): ?>
                                    <option data-harga_barang="<?= $row['harga_barang'] ?>" value="<?= $row['id_barang'] ?>"><?= $row['nama_barang'] ?> - Rp. <?= $row['harga_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">Qty</label>
                            <input type="number" name="qty" class="form-control" id="qty">
                        </div>
                        <button id="btnTambahBarang" class="btn btn-info">Tambahkan</button>
                    </div>
                </div>

                <!-- Tabel dan Detail Transaksi -->
                <div class="col-lg-4">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Subtotal dan Invoice</h5>
                        <div class="text-right">
                            <p>Invoice: <b><?= $kodeNota ?></b></p>
                            <h3 class="display-4" id="subtotalDisplay"><b>0</b></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Barang -->
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Detail Transaksi -->
            <div class="row mt-2">
                <!-- Subtotal dan Diskon -->
                <div class="col-lg-3">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Detail Transaksi</h5>
                        <div class="form-group">
                            <label for="subtotal">Subtotal</label>
                            <input type="number" name="subtotal" class="form-control" id="subtotal" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_diskon">Diskon</label>
                            <input type="number" name="total_diskon" class="form-control" id="total_diskon">
                        </div>
                        <div class="form-group">
                            <label for="ppn">PPN %</label>
                            <input type="number" name="ppn" class="form-control" id="ppn">
                        </div>
                    </div>
                </div>

                <!-- Total dan Tunai -->
                <div class="col-lg-3">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Pembayaran</h5>
                        <div class="form-group">
                            <label for="total_transaksi">Total Transaksi</label>
                            <input type="number" name="total_transaksi" class="form-control" id="total_transaksi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nominal_tunai">Nominal</label>
                            <input type="number" oninput="hitungTotal()" name="nominal_tunai" class="form-control" id="nominal_tunai">
                        </div>
                        <div class="form-group">
                            <label for="kembalian">Kembalian</label>
                            <input type="number" name="kembalian" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>
                </div>

                <!-- Pesan dan Tombol -->
                <div class="col-lg-3">
                    <div class="card card-outline card-warning p-3">
                        <h5 class="card-title">Pesan</h5>
                        <div class="form-group">
                            <label for="pesan">Pesan</label>
                            <textarea name="pesan" id="pesan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <button class="btn btn-danger mb-2 col-12" id="btnBatalkan">Batalkan</button>
                        <button class="btn btn-primary col-12" id="btnProses">Proses</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    document.getElementById('btnTambahBarang').addEventListener('click', function(event) {
        event.preventDefault();

        var barangSelect = document.getElementById('barang');
        var selectedBarangText = barangSelect.options[barangSelect.selectedIndex].text.split(' - ')[0];
        var selectedBarangValue = barangSelect.value;
        var selectedBarangHarga = barangSelect.options[barangSelect.selectedIndex].dataset.harga_barang;
        var qty = document.getElementById('qty').value;

        if (selectedBarangValue === "" || qty === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Barang dan quantity harus diisi.',
                confirmButtonText: 'OK'
            });
            return;
        }

        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var existingRow = null;
        for (var i = 0, row; row = table.rows[i]; i++) {
            if (row.cells[1].dataset.barangId === selectedBarangValue) {
                existingRow = row;
                break;
            }
        }

        if (existingRow) {
            var newQty = parseInt(existingRow.cells[3].innerText) + parseInt(qty);
            existingRow.cells[3].innerText = newQty;
            existingRow.cells[4].innerText = calculateTotal(selectedBarangHarga, newQty);
        } else {
            var total = calculateTotal(selectedBarangHarga, qty);
            var newRow = table.insertRow();
            newRow.innerHTML = `
                <td>${table.rows.length + 1}</td>
                <td data-barang-id="${selectedBarangValue}">${selectedBarangText}</td>
                <td>Rp. ${selectedBarangHarga}</td>
                <td>${qty}</td>
                <td>Rp. ${total}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm btnEditQty">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm btnHapusBarang">Hapus</button>
                </td>
            `;
        }

        attachTableHandlers();

        barangSelect.value = "";
        document.getElementById('qty').value = "";
        hitungTotal();
    });

    function calculateTotal(harga_barang, qty) {
        return harga_barang * qty;
    }

    function hitungTotal() {
        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var subtotal = 0;

        for (var i = 0, row; row = table.rows[i]; i++) {
            var total = parseInt(row.cells[4].innerText.replace('Rp. ', '').replace(/,/g, ''));
            subtotal += total;
        }

        var total_diskon = document.getElementById('total_diskon').value ? parseInt(document.getElementById('total_diskon').value) : 0;
        var subtotalAfterDiskon = subtotal - total_diskon;
        var ppn = document.getElementById('ppn').value ? parseInt(document.getElementById('ppn').value) : 0;
        var ppnValue = (ppn / 100) * subtotalAfterDiskon;
        var totalTransaksi = subtotalAfterDiskon + ppnValue;

        document.getElementById('subtotal').value = subtotal;
        document.getElementById('total_transaksi').value = totalTransaksi;

        // Update nilai yang ditampilkan pada layar
        document.getElementById('subtotalDisplay').innerText = `Rp. ${subtotal.toLocaleString()}`;

        let nominal_tunai = document.getElementById('nominal_tunai').value;

        let kembalian = nominal_tunai - totalTransaksi;
        document.getElementById('kembalian').value = kembalian;

        document.getElementById('kembalianDisplay').innerText = `Rp. ${kembalian.toLocaleString()}`;
    }

    function attachTableHandlers() {
        document.querySelectorAll('.btnHapusBarang').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('tr').remove();
                hitungTotal();
            });
        });

        document.querySelectorAll('.btnEditQty').forEach(function(button) {
            button.addEventListener('click', function() {
                var row = this.closest('tr');
                var currentQty = row.cells[3].innerText;
                document.getElementById('barang').value = row.cells[1].dataset.barangId;
                document.getElementById('qty').value = currentQty;
                row.remove();
                hitungTotal();
            });
        });
    }

    document.getElementById('total_diskon').addEventListener('input', hitungTotal);
    document.getElementById('ppn').addEventListener('input', hitungTotal);

    document.getElementById('btnProses').addEventListener('click', function(event) {
        event.preventDefault();

        let kembalian = document.getElementById('kembalian').value;

        if (kembalian < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Transaksi Gagal',
                text: 'Uang anda tidak cukup.',
                confirmButtonText: 'OK'
            });
            return;
        }

        const kasirElem = document.getElementById('kasir');
        const totalTransaksiElem = document.getElementById('total_transaksi');
        const totalDiskonElem = document.getElementById('total_diskon');
        const nominalTunaiElem = document.getElementById('nominal_tunai');
        const ppnElem = document.getElementById('ppn');
        const kembalianElem = document.getElementById('kembalian');
        const tanggalElem = document.getElementById('tanggal');
        const pesanElem = document.getElementById('pesan');
        const idMemberElem = document.getElementById('id_member');
        const subtotalElem = document.getElementById('subtotal');

        const transaksi = {
            id_user: kasirElem.dataset.kasirid,
            total_transaksi: totalTransaksiElem.value,
            total_diskon: totalDiskonElem.value,
            nominal_tunai: nominalTunaiElem.value,
            ppn: ppnElem.value,
            kembalian: kembalianElem.value,
            tanggal: tanggalElem.value,
            invoice: "<?= htmlspecialchars($kodeNota) ?>",
            pesan: pesanElem.value,
            id_member: idMemberElem.value,
            subtotal: subtotalElem.value
        };

        const transaksiDetails = [];
        const tableRows = document.querySelectorAll('#myTable tbody tr');
        tableRows.forEach(row => {
            const detail = {
                id_barang: row.cells[1].dataset.barangId,
                qty: row.cells[3].innerText,
                harga_barang: row.cells[2].innerText.replace('Rp. ', '').replace(/\./g, ''),
                subtotal: row.cells[4].innerText.replace('Rp. ', '').replace(/\./g, '')
            };
            transaksiDetails.push(detail);
        });

        const data = {
            transaksi: transaksi,
            transaksiDetails: transaksiDetails
        };

        fetch('page/transaksi/tambah.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Transaksi berhasil disimpan!',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal menyimpan transaksi: ' + result.message,
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan',
                    text: 'Terjadi kesalahan pada server.',
                    confirmButtonText: 'OK'
                });
            });
    });

    document.getElementById('btnBatalkan').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin membatalkan transaksi?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, batalkan',
            cancelButtonText: 'Tidak'
        }).then(result => {
            if (result.isConfirmed) {
                location.reload();
            }
        });
    });
</script>