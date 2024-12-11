<?php

include_once "../includes/db.php";

class Record{

    // Private properties for record attributes
    private $id;
    private $quizz_name;
    private $achievement;
    private $score;
    private $user_id;
    private $playedAt;

    private $con;

    //Constructor
    public function __construct($quizz_name="",$achievement="",$score="",$user_id="",$playedAt=""){
        $this->quizz_name=$quizz_name;
        $this->achievement=$achievement;
        $this->score=$score;
        $this->user_id=$user_id;
        $this->playedAt=$playedAt;
    }

    //getter
    public function getId(){
        return $this->id;
    }

    public function getQuizzName(){
        return $this->quizz_name;
    }

    public function getAchievement(){
        return $this->achievement;
    }

    public function getScore(){
        return $this->score;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getPlayedAt(){
        return $this->playedAt;
    }

    //setter
    public function setId($id){
        $this->id=$id;
    }

    public function setQuizzName($quizz_name){
        $this->quizz_name=$quizz_name;
    }

    public function setAchievement($achievement){
        $this->achievement=$achievement;
    }

    public function setScore($score){
        $this->score=$score;
    }

    public function setUserId($user_id){
        $this->user_id=$user_id;
    }

    public function setPlayedAt($playedAt){
        $this->playedAt=$playedAt;
    }

    public function storeRecord(){

            // Establish the database connection
            $this->con = Database::connect();

            if($this->con){
                try {
                // Insert score into the database
                $sql = "INSERT INTO records (quizz_name, achievement, score, user_id, playedAt) VALUES (:quizz_name, :achievement, :score, :user_id,Now())";
                $statement = $this->con->prepare($sql);

                $statement->bindParam(":quizz_name", $this->quizz_name);
                $statement->bindParam(":achievement",$this->achievement);
                $statement->bindParam(":score",$this->score);
                $statement->bindParam(":user_id",$this->user_id);

                $statement->execute();
                $statement->close();
                return true; // Return success if executed
            } catch (PDOException $e) {
                // Log or handle the error
                error_log("Database Error: " . $e->getMessage());
                return false; // Return failure
            }
        } else {
            return false;
        }
    }

    public function getAllRecord()
    {
        try {
            $this->con = Database::connect();

            if ($this->con) {
                $sql = "SELECT * FROM records where deleted_at is null"; // Removed the incomplete WHERE clause
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

    public function getRecordById($id){
        $this->con=Database::connect();
        $sql="select * from records where id=:id ";
        $statement=$this->con->prepare($sql);
        $statement->bindParam(":id",$id);
        $result=$statement->execute();
        if($result){
            return $statement->fetch();
        }
       return null;
    }

    public function getRecordByUserId($id) {
        try {
            $this->con = Database::connect();
    
            if ($this->con) {
                $sql = "SELECT * FROM records WHERE user_id = :id AND deleted_at IS NULL"; // Corrected SQL query
                $statement = $this->con->prepare($sql);
                $statement->bindParam(":id", $id); // Added ":" before id for bindParam
                $statement->execute();
    
                return $statement->fetchAll();
            } else {
                echo "Database connection failed.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    function deleteRecord($id){
        $today=new DateTime();
        $stringDate=$today->format('Y-m-d H:i:s');
        $this->con=Database::connect();
        //$this->con->setAttribute(PDO::ATTR_ERRORMODE,PDO::ERRORMODE_EXCEPTION);
        //$sql="delete from brands where brand_id=:id";
        $sql="update records set deleted_at=:date where id=:id";
        $statement=$this->con->prepare($sql);
        $statement->bindParam(":id",$id);
        $statement->bindParam(":date",$stringDate);
        $result=$statement->execute();
        return $result;
    }

    function search($data){
        $this->con=Database::connect();
        $sql="select * from records where name like :data AND deleted_at is null";
        $statement=$this->con->prepare($sql);
        $search_data="%".$data."%";
        $statement->bindParam(":data",$search_data);
        $result=$statement->execute();
        if($result){
            return $statement->fetchAll();
        }else{
            return null;
        } 
    }
}

?>