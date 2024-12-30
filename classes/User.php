<?php
class User
{


    private $conn;
    private $table = 'users';
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // register function
    public function  register($username, $email, $password)
    {

        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";

        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // login function
    public function login($email, $password)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user && password_verify($password, $user->password)) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            $_SESSION['user_id'] = $user->id;

            return true;
        }
        return false;
    }

    // check if user is logged in
    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
}
