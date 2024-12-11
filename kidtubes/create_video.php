<?php 
session_start();
include_once '../includes/db.php';
include_once '../models/video.php';
include_once '../controllers/VideoController.php';

if(!isset($_SESSION['user_id'] ) || $_SESSION['user_role'] != 'admin') {
    header('location:../users/login.php');
}else{
    session_write_close();
}

include_once("../layouts/navbar.php");


$message = "";
$error = "";
$isError = false;
$title  = "";

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $filename= $_FILES['video']['name'];
    $filetype=$_FILES['video']['type'];
    $filesize = $_FILES['video']['size'];
    $allowedTypes = ["mp4"];
    $tmpFile = $_FILES["video"]["tmp_name"];
    $videoController = new VideoController();

    if($_FILES['video']['error'] != 0) {
        echo "Error File Upload !!";
    } else {
        if($filesize < 10737418240) {
            $fileinfo = explode(".", $filename);
            $actualType = end($fileinfo);
            
            if(in_array($actualType, $allowedTypes)) {
                $updatedName = time() . $filename;
                $user_id = $_SESSION['user_id'];

                if($user_id != null) {
                    $videoController->Upload($title, $updatedName, $user_id);
                    move_uploaded_file($tmpFile, '../videos/' . $updatedName);
                    $message = "Video is successfully uploaded !!";
                } else {
                    $error = "Upload Fail !!";
                    $isError = true;
                }
            } else {
                $error = "The file type is not allowed !!";
                $isError = true;
            }
        } else {
            $error = "The size exceeds the limit, try again.";
            $isError = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:createVideo</title>
</head>
<body style="background:white;">
<div class="container mt-5">
    <?php if ($isError): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mt-4 text-center text-success">Video Upload</h1>
            <?php if($message != ''):  ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Video Title</label>
                    <input type="text" name="title" id="title" class="form-control shadow-lg" value="<?php echo $isError ? $title : '' ?>" required>
                </div>
 
                <div class="mb-3">
                    <label for="video" class="form-label">Choose the Video</label>
                    <input type="file" name="video" id="video" accept="video/*" class="form-control shadow-lg">
                </div>

                <div class="text-center">
                    <button class="btn btn-success btn-lg w-100 mt-3 rounded-pill mt-3 shadow-lg" name="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once("../layouts/footer.php");
?>
</body>
</html>
