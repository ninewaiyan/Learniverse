<?php
session_start();
include_once "../includes/db.php";
include_once("../controllers/UserController.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('location:../users/login.php');
} else {
    session_write_close();
}

include_once("../layouts/navbar.php");

$userController = new UserController();
$users = $userController->getAllUser();
$result = false;
$query = "";
if (isset($_POST['mode']) && isset($_POST['user_id'])) {
    $mode = $_POST['mode'];

    $user_id = $_POST['user_id'];



    if ($mode == "DISABLE") {
        $result = $userController->setDisable($user_id);
    } else if ($mode == "ENABLE") {
        $result = $userController->setEnable($user_id);
    }
}

// if (isset($_POST['query'])) {
//     $query = $_POST['query'];
//     if ($query != '') {
//         $users = $userController->search($query);
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <title>Learniverse:adminPanel</title>
</head>

<style>
    .custom-input {
        border: 2px solid #28a745;
        /* Green border color */
        border-radius: 5px;
        /* Rounded corners */
    }
</style>

<body style="background: white;">
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h4 class="card-title">Upload a New Video</h4>
                        <p class="card-text p-2">Add exciting new content for kids.</p>
                        <hr>
                        <a href="../kidtubes/create_video.php" class="btn btn-success rounded-pill">Upload Video</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h4 class="card-title">Upload Book </h4>
                        <p class="card-text p-2">Add exciting new content for kids.</p>
                        <hr>
                        <a href="../books/create_book.php" class="btn btn-success rounded-pill">Upload Book</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h4 class="card-title">Show Feedback</h4>
                        <p class="card-text p-2">View the feedback from users.</p>
                        <hr>
                        <a href="../feedbacks/show_feedback.php" class="btn btn-primary rounded-pill">Show Feedback</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-lg">
                    <div class="card-body text-center">
                        <h4 class="card-title">User Management</h4>
                        <p class="card-text p-2">Management User</p>
                        <hr>
                        <a href="user_management.php" class="btn btn-secondary rounded-pill">Show All User</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    </div>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        function toggleUser(userId, mode) {
            $.ajax({
                url: 'adminpanel.php', // The same page or separate PHP file for processing
                type: 'POST',
                data: {
                    user_id: userId,
                    mode: mode
                },
                success: function(response) {
                    // Optionally handle the response here
                    console.log(response);
                    location.reload(); // Refresh the page after success
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while processing your request.');
                }
            });
        }

       

    </script>

    <?php
    include_once("../layouts/footer.php");
    ?>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
</body>

</html>