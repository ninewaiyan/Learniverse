<?php
include_once '../includes/db.php';
include_once '../models/profileImages.php';

class  ProfileImageController
{

    private $profileImage;

    public function __construct()
    {
        $this->profileImage = new ProfileImage();
    }


    public function saveOldprofileImage($image,$user_id){
        $profileImage = new ProfileImage($image,$user_id);
        $result =  $profileImage->addOldProlfileImage();
        return $result;
    }

}