<?php

class Barang
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
            self::$instance = new Barang($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH BARANG START
    public function add($nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $id_supplier, $gambar)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO barang (nama_barang, id_jenis_barang, harga_barang, stok_barang, id_supplier, gambar) VALUES (:nama_barang, :id_jenis_barang, :harga_barang, :stok_barang, :id_supplier, :gambar)");
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = :id_barang");
            $stmt->execute(array(":id_barang" => $id_barang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION EDIT BARANG START
    public function update($id_barang, $nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $id_supplier, $gambar)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama_barang=:nama_barang, id_jenis_barang=:id_jenis_barang, harga_barang=:harga_barang, stok_barang=:stok_barang, id_supplier=:id_supplier, gambar=:gambar WHERE id_barang=:id_barang");
    
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":gambar", $gambar);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION EDIT TANPA MENGUBAH GAMBAR START
    public function updateWithoutImage($id_barang, $nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama_barang=:nama_barang, id_jenis_barang=:id_jenis_barang, harga_barang=:harga_barang, stok_barang=:stok_barang, id_supplier=:id_supplier WHERE id_barang=:id_barang");
    
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":id_supplier", $id_supplier);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION DELETE BARANG START
    public function delete($id_barang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION GET BARANG BY ID START
    public function getById($id_barang) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(':id_barang', $id_barang, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION GET ALL BARANG WITH INNER JOIN START
    public function getAll()
{
    try {
        $stmt = $this->db->prepare("SELECT barang.*, jenis_barang.nama_jenis_barang, supplier.nama_supplier 
                                    FROM barang
                                    JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.id_jenis_barang
                                    JOIN supplier ON supplier.id_supplier = barang.id_supplier");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}


    // FUNCTION GET ALL JENIS BARANG START
    public function getAllJenisBarang()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_jenis_barang, nama_jenis_barang FROM jenis_barang");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION GET ALL SUPPLIER START
    public function getAllSupplier()
    {
        try {
            $stmt = $this->db->prepare("SELECT id_supplier, nama_supplier FROM supplier");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>
