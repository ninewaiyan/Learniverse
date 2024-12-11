<?php 
session_start();
include_once("../controllers/VideoController.php");


if(!isset($_SESSION['user_id'] ) || $_SESSION['user_role'] != 'admin')
{
    header('location:../users/login.php');
}
$videoController = new VideoController();


if (isset($_GET['mode']) && $_GET['mode']=="DEL") {

$del_id = $_GET['id'];

$result = $videoController->deleteVideoById($del_id);

if($result){
    header("location:kidtube.php");
}else{
    header("location:kidtube.php?del=fail");
}

}

if (isset($_POST['mode']) && $_POST['mode']=="EDIT") {

$edit_id = $_POST['id'];
$title = $_POST['title'];
$isEdit=$videoController->editVideoById($edit_id,$title);
if($isEdit){
     header("location:kidtube.php");
}else{
     header("location:kidtube.php?edit=fail");
}

}






