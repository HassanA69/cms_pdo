<?php

class Article
{


    private $conn;
    private $table = 'articles';
    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->getConnection();
    }


    public function get_Excerpt($content, $length = 150)
    {
        if (strlen($content) >=  $length) {

            return substr($content, 0, $length) . "...";
        }

        return $content;
    }




    // get all articles
    public function get_all()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    // get articles by id from database
    public function get_by_id($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $articles = $stmt->fetch(PDO::FETCH_OBJ);

        if ($articles) return $articles;

        return false;
    }

    // get owners
    public function get_owner($id)
    {
        $query = "SELECT 
                    articles.id,
                    articles.image,
                    articles.title,
                    articles.content,
                    articles.created_at,
                    users.username AS author,
                    users.email AS author_email
                    FROM " . $this->table . " 
                    JOIN users ON articles.user_id = users.id
                    WHERE articles.id = :id  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $articles = $stmt->fetch(PDO::FETCH_OBJ);

        if ($articles) return $articles;

        return false;
    }



    // get articles by userID
    public function get_by_user_id($user_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id  ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    // format date 
    public function format_date($date)
    {
        return date('m-j-Y', strtotime($date));
    }
}
