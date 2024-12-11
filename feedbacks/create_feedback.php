<?php
session_start();
include_once '../includes/db.php';
include_once "../controllers/FeedBackController.php";

$message = "";
$error = "";
$isError = false;

if(!isset($_SESSION['user_id'] ) ) {
    header('location:../users/login.php');
}else{
    session_write_close();
}
include_once("../layouts/navbar.php");

if (isset($_POST['submit'])) {
    
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user_id'];
        $feedbackController = new FeedBackController();
        $result = $feedbackController->createFeedback($comment, $user_id);

        if ($result) {
            $message = "Feedback Successfully submitted!";
        } else {
            $isError = true;
            $error = "Feedback Error";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse Feedback</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="background:whitesmoke;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 border p-4 rounded bg-light shadow-lg">
                <h1 class="text-center">Leave Feedback</h1>
                <p class="text-center">We value your feedback and it helps us improve our services for a better experience!</p>
                
                <?php if ($isError): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if ($message): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="form-group mt-3">
                        <textarea name="comment" class="form-control" rows="5" placeholder="Write your feedback here..." required><?php echo $isError ? htmlspecialchars($comment) : ''; ?></textarea>
                    </div>
                    <div class="text-center">
                        <button name="submit" type="submit" class="btn btn-primary w-50 rounded-pill shadow-lg mt-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include_once "../layouts/footer.php"; ?>
</body>
</html>
