<?php
include_once '../includes/db.php';
include_once '../models/user.php';



class UserController
{

    private $user;

    public function __construct()
    {
        $this->user = new User();
    }


    public function emailCheck($email)
    {
    
        // Fetch the user from the database using the provided email
       $result =  $loginUser = $this->user->getUserByEmail($email);
        
       return $result;
    }

    public function isValidPassword($password) {
        // Check if the password is more than 8 characters
        if (strlen($password) <= 8) {
            return false;
        }
        
        // Check if the password contains at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }
    
        // Check if the password contains at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
    
        // Check if the password contains at least one special character
        if (!preg_match('/[\W]/', $password)) {  // \W matches any non-word character (special character)
            return false;
        }
    
        // If all conditions are met, the password is valid
        return true;
    }
    
    
    
    

    public function register($firstname, $lastname, $email,$image,$password)
    {
        $user = new User($firstname, $lastname, $email,$image ,$password);
        $result = $user->createUser();
        return $result;
    }


    public function login($email, $password)
    {
        $result = false;
        $loginUser = $this->user->getUserByEmail($email);
        if ($loginUser) {
            if (password_verify($password, $loginUser['password'])) {
                
                if($this->isEnable($email)){

                    session_start();
                    $_SESSION['first_name'] =  $loginUser['firstname'];
                    $_SESSION['last_name'] = $loginUser['lastname'];
                    $_SESSION['user_fullname'] = $loginUser['firstname'] . ' ' . $loginUser['lastname'];
                    $_SESSION['user_email'] = $loginUser['email'];
                    $_SESSION['user_image'] = $loginUser['image'];
                    $_SESSION['user_role'] = $loginUser['role'];
                    $_SESSION['user_id'] = $loginUser['id'];


                }
                $result = true;

               
            }
        }

        return $result;
    }


    public function isEnable($email)
    {
        $result = false;
        
        // Fetch the user from the database using the provided email
        $loginUser = $this->user->getUserByEmail($email);

        if($loginUser['enable']){
            $result = true;
        }

        return $result;
    }


    public function search($query){
        $user  = new User();
        $user  = $user->getAllUserbySearch($query);
        return $user;
    }
    public function getUserById($id){
        $user = new User();
        $user = $user->getUserByUserId($id);
        return $user;
    }

    public function getAllUser(){
        $user = new User();
        $users = $user->getAllUser();
        return $users;
    }

    public function setEnable($user_id){
        $user = new User();
        $result = $user->setEnable($user_id);
        return $result;
    }

    public function setDisable($user_id){
        $user = new User();
        $result = $user->setDisable($user_id);
        return $result;
    }

    public function updateProfile($id,$firstname,$lastname,$email,$image){
        $user = new User();
        $result = $user->editProfile($id,$firstname,$lastname,$email,$image);
        return $result;
    }

    public function changePassword($id,$new_password){
        $user = new User();
        $result = $user->setNewPassword($id,$new_password);
        return $result;
    }
   
}
?>