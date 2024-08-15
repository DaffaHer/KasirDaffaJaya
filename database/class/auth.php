<?php

class Auth
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
            self::$instance = new Auth($pdo);
        }
        return self::$instance;
    }

    public function login($username, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data && password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data;
                header('Location: index.php');
                exit();
            } else {
                header('Location: index.php?page=login&message=gagal');
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function register($nama, $username, $email, $password, $role)
    {
        try {
            if ($this->cekUsername($username) || $this->cekEmail($email)) {
                return false;
            }

            $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO user(nama, username, email, password, role) VALUES(:nama, :username, :email, :password, :role)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashPasswd);
            $stmt->bindParam(":role", $role);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == 23000) {
                echo "Email atau Username sudah digunakan!";
                return false;
            } else {
                echo $e->getMessage();
                return false;
            }
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    private function cekUsername($username)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "Username sudah digunakan!";
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function cekEmail($email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "Email sudah digunakan!";
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function logout()
    {
        //hapus Session
        unset($_SESSION['user_session']);
        session_destroy();
        return true;
    }
}
?>
