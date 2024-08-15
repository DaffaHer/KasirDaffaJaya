<?php

class User
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
            self::$instance = new User($pdo);
        }

        return self::$instance;
    }

    public function add($nama, $username, $email, $password, $role)
    {
        try {
            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO user (nama, username, email, password, role) VALUES (:nama, :username, :email, :password, :role)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashPasswd);
            $stmt->bindParam(":role", $role);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_user)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->execute(array(":id_user" => $id_user));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id_user, $nama, $username, $email, $role)
    {
        try {
                $stmt = $this->db->prepare("UPDATE user SET nama=:nama, username=:username, email=:email, role=:role WHERE id_user=:id_user");
                $stmt = $this->db->prepare("UPDATE user SET nama=:nama, username=:username, email=:email, role=:role WHERE id_user=:id_user");
        

            $stmt->bindParam(':nama', $nama, PDO::PARAM_STR);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);

        return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete($id_user)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM user WHERE id_user=:id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function confirmPassword($id_user, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT password FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data && password_verify($password, $data['password'])) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id_user, $new_password)
    {
        try {
            $hashPasswd = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("UPDATE user SET password=:password WHERE id_user=:id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":password", $hashPasswd);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
