<?php
session_start();
include_once '../includes/db.php';
include_once "../controllers/UserController.php";
include_once "../controllers/MailController.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit;
}

$userController = new UserController();
$mailController = new MailController();

$input = json_decode(file_get_contents('php://input'), true);  // Read JSON data

if (isset($input['old_password']) && isset($input['new_password'])) {
    $old_password = $input['old_password'];
    $new_password = $input['new_password'];
    $user_id = $_SESSION['user_id'];
    $user = $userController->getUserById($user_id);

    if (password_verify($old_password, $user['password'])) {
        if ($userController->isValidPassword($new_password)) {
            $result = $userController->changePassword($user_id, $new_password);
            if ($result) {
                $mailController->passwordChangeMail($_SESSION['user_fullname'], $_SESSION['user_email']);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => "Password can't be changed right now!"]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'New password must contain at least 8 characters, including a number, a lowercase letter, an uppercase letter, and a special symbol.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Old password is incorrect!']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request data!']);
}
?>
