<?php
include_once "../includes/db.php";

class  Feedback
{
    // Private properties for video attributes
    private $id;
    private $comment;
    private $sentAt;
    private $user_id;

    private $con;

    // Constructor
    public function __construct( $comment="", $user_id="")
    {
        
        $this->comment = $comment;
        $this->user_id = $user_id;

        
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getSentAt()
    {
        return $this->sentAt;
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

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function createFeedback()
    {
        try {
            // Establish the database connection
            $this->con = Database::connect();

            if ($this->con) {
                // Prepare the SQL query for inserting user details
                $sql = "INSERT INTO feedbacks (comment,sentAt,user_id)
                VALUES (:comment, NOW(), :user_id)";
        

                $statement = $this->con->prepare($sql);

                // Bind parameters using the object's properties
                $statement->bindParam(":comment", $this->comment);
                $statement->bindParam(":user_id", $this->user_id);
            

                // Execute the query
                $result = $statement->execute();

                return $result;
            } else {
                echo "Database connection is not successful.";
            }
        } catch (PDOException $e) {
            // Catch and display any errors
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllFeedBack()
    {
        $this->con = Database::connect();
        $sql = "select * from feedbacks Where deletedAt is NULL";
        $statement = $this->con->prepare($sql);
        $result = $statement->execute();
        if ($result) {
            return $statement->fetchAll();
        } else {
            return null;
        }
    }

}
?>
