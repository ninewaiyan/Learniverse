<?php
include_once "../includes/db.php";

class User
{
    // Private properties
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    private $image;

    private $con;

    // Constructor to initialize the user object
    public function __construct($firstname = "", $lastname = "", $email = "", $image = "", $password = "")
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
    }

    // Getters

    public function getId()
    {
        return $this->id;
    }
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getImage()
    {
        return $this->image;
    }


    public function getPassword()
    {
        return $this->password;
    }

    // Setters

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function createUser()
    {
        try {
            // Establish the database connection
            $this->con = Database::connect();

            if ($this->con) {
                // Prepare the SQL query for inserting user details
                $sql = "INSERT INTO users (firstname, lastname, email, image, password,role,createdAt,enable)
                VALUES (:firstname, :lastname, :email,:image, :password,'user',NOW(),true)";


                $statement = $this->con->prepare($sql);

                // Bind parameters using the object's properties
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":image", $this->image);

                // Hash the password before inserting it into the database
                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
                $statement->bindParam(":password", $hashedPassword);

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

    public function getUserByEmail($email)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM users WHERE email = :email";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":email", $email);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                return $user ? $user : null;
            } else {
                echo "Database connection is not successful.";
                return null;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Method to get a user by their user_id
    public function getUserByUserId($userId)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM users WHERE id = :userId";
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":userId", $userId, PDO::PARAM_INT);
                $statement->execute();

                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllUser()
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM users Where role = 'user'"; // Removed the incomplete WHERE clause
                $statement = $this->con->prepare($sql);
                $statement->execute();

                return $statement->fetchAll();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAllUserbySearch($query)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                // Use the LIKE operator for a partial match (e.g., searching for a name)
                $sql = "SELECT * FROM users WHERE firstname LIKE :query OR lastname LIKE :query OR email LIKE :query";
                $statement = $this->con->prepare($sql);

                // Bind the query parameter with wildcards for partial matches
                $statement->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);

                $statement->execute();

                return $statement->fetchAll();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function editProfile($id, $firstname,$lastname,$email,$image)
    {
        $result = false;
        try {
            $this->con = Database::connect();
            if ($this->con) {
                $sql = "UPDATE users SET firstname = :firstname , lastname = :lastname ,
                email = :email , image = :image WHERE id = :id ";
                
                
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->bindParam(":firstname", $firstname, PDO::PARAM_STR);
                $statement->bindParam(":lastname", $lastname, PDO::PARAM_STR);
                $statement->bindParam(":email", $email, PDO::PARAM_STR);
                $statement->bindParam(":image", $image, PDO::PARAM_STR);

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


    public function setNewPassword($user_id,$password )
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "UPDATE users SET password = :password WHERE id = :userId"; // Removed the incomplete WHERE clause
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":userId", $user_id, PDO::PARAM_INT);
                $statement->bindParam(":password", $hashedPassword, PDO::PARAM_STR);



                return $statement->execute();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function setEnable($userId)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "UPDATE users SET enable = true WHERE id = :userId"; // Removed the incomplete WHERE clause
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":userId", $userId, PDO::PARAM_INT);

                return $statement->execute();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function setDisable($userId)
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "UPDATE users SET enable = false WHERE id = :userId"; // Removed the incomplete WHERE clause
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":userId", $userId, PDO::PARAM_INT);

                return $statement->execute();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
