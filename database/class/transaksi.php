<?php

class Transaksi
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Transaksi($pdo);
        }

        return self::$instance;
    }

    public function addTransaksi($id_kasir, $id_member, $tanggal, $invoice)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transaksi (id_kasir, id_member, tanggal, invoice) VALUES (:id_kasir, :id_member, :tanggal, :invoice)");
            $stmt->bindParam(':id_kasir', $id_kasir);
            $stmt->bindParam(':id_member', $id_member);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':invoice', $invoice);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getTransaksi()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM transaksi JOIN member ON transaksi.id_member = member.id_member");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function hapusTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = :id");
            $stmt->bindParam(":id", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }


// BAGIAN DETAIL TRANSAKSI


    public function getInvoiceByTransaksi($id_transaksi)
    {
        try {
            // Query untuk mengambil nomor invoice berdasarkan ID transaksi
            $stmt = $this->db->prepare("SELECT invoice FROM transaksi WHERE id_transaksi = :id_transaksi LIMIT 1");
            $stmt->bindParam(':id_transaksi', $id_transaksi);
            $stmt->execute();

            // Mengambil hasil query
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Jika hasil ditemukan, kembalikan nomor invoice
            if ($result) {
                return $result['invoice'];
            } else {
                return null; // Jika tidak ditemukan, kembalikan null
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getBarang()
{
    try {
        // Query untuk mengambil semua data barang
        $stmt = $this->db->prepare("SELECT * FROM barang");
        $stmt->execute();

        // Mengembalikan hasil query sebagai array asosiatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
}

public function addDetail($id_transaksi, $id_barang, $qty)
    {
        try {

            // if (!$this->cekJumlahProduk($id_barang, $qty)) {
            //     echo 'Stok Tidak Cukup';
            //     return false;
            // }

            $stmt = $this->db->prepare("INSERT INTO transkasi_detail (id_transaksi, id_barang, qty) VALUE ( :id_transaksi , :id_barang, :qty)");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":qty", $qty);
            $stmt->execute();

            // $this->KurangiStok($id_barang, $qty);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTransaksiDetail($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM transkasi_detail, barang WHERE transkasi_detail.id_barang = barang.id_barang AND id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function hargatotal($id_transaksi)
    {
        try {

            $stmt = $this->db->prepare("SELECT SUM(transkasi_detail.qty * barang.harga_barang) as total_harga FROM transkasi_detail JOIN barang ON transkasi_detail.id_barang = barang.id_barang WHERE id_transaksi = :id_transaksi");

            $stmt->bindParam("id_transaksi", $id_transaksi);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
