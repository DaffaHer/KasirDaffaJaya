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
}
