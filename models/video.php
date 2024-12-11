<?php
include_once "../includes/db.php";

class Video
{
    // Private properties for video attributes
    private $id;
    private $title;
    private $url;
    private $createdAt;
    private $user_id;

    private $con;

    // Constructor to initialize the video object
    public function __construct($title = "", $url = "", $user_id = "")
    {
        $this->title = $title;
        $this->url = $url;
        $this->user_id = $user_id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getAllVideo()
    {
        $this->con = Database::connect();
        $sql = "select * from kidtubes Where deletedAt is NULL";
        $statement = $this->con->prepare($sql);
        $result = $statement->execute();
        if ($result) {
            return $statement->fetchAll();
        } else {
            return null;
        }
    }

    // Method to create a new video entry
    public function createVideo()
    {
        try {
            // Establish the database connection
            $this->con = Database::connect();
            if ($this->con) {
                // Prepare the SQL query to insert video details
                $sql = "INSERT INTO kidtubes (title, url, createdAt, user_id)
                        VALUES (:title, :url, NOW(), :user_id)";

                $statement = $this->con->prepare($sql);

                // Bind parameters
                $statement->bindParam(":title", $this->title);
                $statement->bindParam(":url", $this->url);
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

    // Method to get a video by its ID
    public function getVideoById($video_id)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM kidtubes WHERE id = :video_id";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":video_id", $video_id, PDO::PARAM_INT);
                $statement->execute();

                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Method to retrieve all videos for a specific user
    public function getVideosByUserId($user_id)
    {
        try {
            $this->con = Database::connect();
            if ($this->con) {
                $sql = "SELECT * FROM kidtubes WHERE user_id = :user_id ORDER BY createdAt DESC";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $statement->execute();

                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Method to delete a video by its ID
    public function deleteVideo($id)
    {
        $result = false;
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "UPDATE kidtubes SET deletedAt= NOW() WHERE id = :id ";
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

    public function editVideo($id, $title)
    {
        $result = false;
        try {
            $this->con = Database::connect();
            if ($this->con) {
                $sql = "UPDATE kidtubes SET title= :title WHERE id = :id ";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->bindParam(":title", $title, PDO::PARAM_STR);

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
