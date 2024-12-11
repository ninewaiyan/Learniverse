<?php
include_once "../includes/db.php";

class  ProfileImage
{

    private $id;

    private $image;

    private $user_id;

    private $con;

    // Constructor
    public function __construct( $image="", $user_id="")
    {
        
        $this->image = $image;
        $this->user_id = $user_id;

        
    }


    // Getter for id
    public function getId()
    {
        return $this->id;
    }

    // Setter for id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter for image
    public function getImage()
    {
        return $this->image;
    }

    // Setter for image
    public function setImage($image)
    {
        $this->image = $image;
    }

    // Getter for user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    // Setter for user_id
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function addOldProlfileImage()
    {
        try {
            // Establish the database connection
            $this->con = Database::connect();

            if ($this->con) {
                // Prepare the SQL query for inserting user details
                $sql = "INSERT INTO profileimages (image,user_id)
                VALUES (:image,:user_id)";
        

                $statement = $this->con->prepare($sql);

                // Bind parameters using the object's properties
                $statement->bindParam(":image", $this->image);
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




}