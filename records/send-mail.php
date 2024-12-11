<?php
include_once "../controllers/UserController.php";
include_once "../controllers/MailController.php"; // Create this controller to manage email sending

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $quizz_name = $_POST['quizz_name'];
    $achievement = $_POST['achievement'];
    $score = $_POST['score'];

    // Fetch user email based on user ID
    $userController = new UserController();
    $user = $userController->getUserById($user_id);
    $userEmail = $user['email'];
    $userName = $user['name'];

    // Initialize EmailController
    $emailController = new MailController();
    $result = $emailController->sendRecordHistoryEmail($userName, $userEmail, $quizz_name, $achievement, $score);

    if ($result) {
        echo "Email sent successfully to $userEmail.";
    } else {
        echo "Failed to send email.";
    }
}
?>


