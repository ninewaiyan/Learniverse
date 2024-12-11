<?php
include_once "../includes/db.php";

class Book {
    private $id;
    private $title;
    private $description;
    private $image;
    private $file;

    private $user_id;

    private $con;

    // Constructor
    public function __construct( $title="", $description="", $image="", $file="",$user_id="") {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->file = $file;
        $this->user_id = $user_id;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function getFile() {
        return $this->file;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function createBook()
    {
        try {
            // Establish the database connection
            $this->con = Database::connect();
            if ($this->con) {
                // Prepare the SQL query to insert video details
                $sql = "INSERT INTO books (title, description, image,file,createdAt,user_id)
                        VALUES (:title, :description,:image,:file, NOW(),:user_id)";

                $statement = $this->con->prepare($sql);

                // Bind parameters
                $statement->bindParam(":title", $this->title);
                $statement->bindParam(":description", $this->description);
                $statement->bindParam(":image", $this->image);
                $statement->bindParam(":file", $this->file);
                $statement->bindParam(":user_id", $this->user_id, PDO::PARAM_INT);

                // Execute the query
                return $statement->execute();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }

    public function getAllBook()
    {
        $this->con = Database::connect();
        $sql = "select * from books Where deletedAt is NULL";
        $statement = $this->con->prepare($sql);
        $result = $statement->execute();
        if ($result) {
            return $statement->fetchAll();
        } else {
            return null;
        }
    }

    public function getBookById($book_id)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM books WHERE id = :id";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $book_id, PDO::PARAM_INT);
                $statement->execute();

                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteBook($id)
    {
        $result = false;
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "UPDATE books SET deletedAt= NOW() WHERE id = :id ";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $result = $statement->execute();
                return $result;
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function editBook($id,$title, $description)
    {
        $result = false;
        try {
            $this->con = Database::connect();
            if ($this->con) {
                $sql = "UPDATE books SET title= :title , description = :description WHERE id = :id ";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->bindParam(":title", $title, PDO::PARAM_STR);
                $statement->bindParam(":description", $description, PDO::PARAM_STR);

                $result = $statement->execute();
                return $result;
            } else {

                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        return $result;
    }
}
?>