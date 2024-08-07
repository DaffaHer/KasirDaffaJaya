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
                header('Location: index.php?');
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
}
