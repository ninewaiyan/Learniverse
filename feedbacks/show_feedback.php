<?php
include_once("../controllers/FeedBackController.php");
include_once("../controllers/UserController.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('location:../users/login.php');
    exit();
} else {
    session_write_close();
}

include_once("../layouts/navbar.php");
$feedbackController = new FeedBackController();
$feedbacks = $feedbackController->getAllFeedack();

$userController = new UserController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <title>Learniverse:Viewfeedback</title>
</head>

<body style="background: white;">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Feedbacks</h1>
        <div class="table-responsive shadow">

            <table id="feedback_table" class="table table-hover table-bordered " style="width:100%">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">User</th>
                        <th scope="col">Date</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach ($feedbacks as $feedback):
                        $user = $userController->getUserById($feedback['user_id']);
                        $username = $user['firstname'] . " " . $user['lastname'];
                    ?>
                        <tr class="bg-light">
                            <td><?php echo $count++; ?></td>
                            <td><strong><?php echo $username; ?></strong></td>
                            <td><?php echo date("F j/Y g:i:s A", strtotime($feedback['sentAt'])); ?></td>
                            <td><?php echo $feedback['comment']; ?></td>
                            <td>
                                <?php

                                echo '<a href="#" id="toggle-' . $user['id'] . '" onclick="toggleUser(' . $user['id'] . ', \'' . ($user['enable'] ? 'DISABLE' : 'ENABLE') . '\'); return false;" class="' . ($user['enable'] ? 'btn btn-outline-danger' : 'btn btn-outline-success') . '">' . ($user['enable'] ? 'Disable' : 'Enable') . '</a>';


                                ?>


                            </td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th scope="col">No.</th>
                    <th scope="col">User</th>
                    <th scope="col">Date</th>
                    <th scope="col">Feedback</th>
                    <th scope="col">Action</th>
                </tfoot>
            </table>

        </div>
    </div>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        function toggleUser(userId, mode) {
            $.ajax({
                url: '../admin/adminpanel.php', // The same page or separate PHP file for processing
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

        $(document).ready(function() {
            $('#feedback_table').DataTable(); // Initialize DataTable
        });
    </script>

    <?php include_once("../layouts/footer.php"); ?>
</body>

</html>