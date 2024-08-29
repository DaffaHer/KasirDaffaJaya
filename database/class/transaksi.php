<?php

class Transaksi
{
    private static $instance = null;
    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new self($pdo);
        }
        return self::$instance;
    }

    public function generateKodeNota()
    {
        // Query untuk mendapatkan nomor nota terbesar
        $query = "SELECT MAX(invoice) as kodeTerbesar11 FROM transaksi";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $datanya = $stmt->fetch(PDO::FETCH_ASSOC);
        $kodenota = $datanya['kodeTerbesar11'];

        // Ambil urutan dari nomor nota
        $urutan = (int) substr($kodenota, 9, 3);
        $urutan++;

        // Format tanggal
        $tgl = date("jnyGi");

        // Inisial huruf untuk nomor nota
        $huruf = "BR";

        // Hasil akhir nomor nota
        $kodeCart = $huruf . $tgl . sprintf("%03s", $urutan);

        return $kodeCart;
    }

    public function insertTransaksi($id_user, $id_member, $tanggal, $invoice, $total_transaksi, $total_diskon, $ppn, $kembalian, $nominal_tunai, $subtotal, $pesan)
    {
        $query = "INSERT INTO transaksi (id_user, id_member, tanggal, invoice, total_transaksi, total_diskon, ppn, kembalian, nominal_tunai, subtotal, pesan) VALUES (:id_user, :id_member, :tanggal, :invoice, :total_transaksi, :total_diskon, :ppn, :kembalian, :nominal_tunai, :subtotal, :pesan)";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':id_user' => $id_user,
                ':id_member' => $id_member,
                ':tanggal' => $tanggal,
                ':invoice' => $invoice,
                ':total_transaksi' => $total_transaksi,
                ':total_diskon' => $total_diskon,
                ':ppn' => $ppn,
                ':kembalian' => $kembalian,
                ':nominal_tunai' => $nominal_tunai,
                ':subtotal' => $subtotal,
                ':pesan' => $pesan
            ]);
        
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Tangkap dan tampilkan error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }        

    public function insertTransaksiDetails($id_transaksi, $id_barang, $qty, $harga, $subtotal)
{
    try {
        $query = "INSERT INTO transaksi_details (id_transaksi, id_barang, qty, harga, subtotal) VALUES (:id_transaksi, :id_barang, :qty, :harga, :subtotal)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id_transaksi' => $id_transaksi,
            ':id_barang' => $id_barang,
            ':qty' => $qty,
            ':harga' => $harga,
            ':subtotal' => $subtotal
        ]);
    } catch (PDOException $e) {
        // Tangkap dan tampilkan error
        echo "Error: " . $e->getMessage();
        return false;
    }
}


    public function getLaporanPenjualan()
    {
        $stmt = $this->pdo->prepare("SELECT t.*, m.nama as member, u.nama as kasir FROM transaksi t JOIN member m ON t.id_member = m.id_member JOIN user u ON t.id_user = u.id_user ORDER BY t.tanggal DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function hapusTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM transaksi WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
