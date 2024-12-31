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


    public function get_Excerpt($content, $length = 100)
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



    // create new article
    public function create($title, $content, $author_id, $created_at, $image)
    {

        $query = "INSERT INTO " . $this->table . " (title, content, user_id, image, created_at) 
                VALUES (:title, :content, :author_id, :image, :created_at) ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title, PDO::PARAM_STR);

        $stmt->bindParam(":content", $content, PDO::PARAM_STR);

        $stmt->bindParam(":author_id", $author_id, PDO::PARAM_INT);

        $stmt->bindParam(":image", $image, PDO::PARAM_STR);

        $stmt->bindParam(":created_at", $created_at, PDO::PARAM_STR);

        return $stmt->execute();
    }


    // delete article with image

    public function  deleteArticleWithImage($id)
    {
        $articles = $this->get_by_id($id);

        if ($articles) {

            if ($articles->id === $_SESSION['user_id']) {

                if (!empty($articles->image) &&  file_exists($articles->image)) {

                    if (!unlink($articles->image)) {
                        return false;
                    }
                }

                $query = "DELETE FROM " . $this->table . " WHERE id = :id";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                return $stmt->execute();
            } else {
                redirect('admin.php');
            }
        }
        return false;
    }


    // update article with image
    public function updateArticle($title, $content, $image) {}
}
