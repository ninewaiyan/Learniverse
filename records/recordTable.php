<?php
session_start();
include_once "../includes/db.php";
include_once("../controllers/UserController.php");
include_once("../controllers/RecordController.php");

if (!isset($_SESSION['user_id'])) {
    header('location:../users/login.php');
} else {
    session_write_close();
}

include_once("../layouts/navbar.php");

$recordController = new RecordController();
$id=$_SESSION['user_id'];

$records = $recordController->getRecordByUserId($id);
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
    <title>Record Table</title>
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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-12 px-4 mt-3">
                <h2 class="btn btn-secondary
                 btn-lg text-center shadow-lg w-100 rounded">Record History</h2>

                <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Achievement</th>
                        <th>Score</th>                       
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $count = 1;
                        foreach ($records as $record) {
                            echo "<tr id=".$record['id'].">";
                            echo "<td style='text-align: center;'>".$count++."</td>";
                            echo "<td>".$record['playedAt']."</td>";
                            echo "<td>".$record['quizz_name']."</td>";
                            echo "<td>".$record['achievement']."</td>";
                            echo "<td>".$record['score']."</td>";
                            echo "<td style='text-align: center;'><a class='btn btn-danger mx-2' href='delete-record.php?id=".$record['id']."'>Delete</a></td>";
                            echo "</tr>";				
                        }

                        ?>
                    </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th>Achievement</th>
                        <th>Score</th>                       
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            </main>
        </div>
    </div>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script>
        const emailHandler=$(document).ready(function() {
            $('#user_table').DataTable(); // Initialize DataTable

            // Email button click handler
            $('.btnEmail').on('click', function() {
                const userId = $(this).data('user_id');
                const quizzName = $(this).data('quizz-name');
                const achievement = $(this).data('achievement');
                const score = $(this).data('score');

                $.ajax({
                    url: 'send-email.php',
                    type: 'POST',
                    data: {
                        user_id: userId,
                        quizz_name: quizzName,
                        achievement: achievement,
                        score: score
                    },
                    success: function(response) {
                        alert(response); // Show a success or error message
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('An error occurred while sending the email.');
                    }
                });
            });
        });

    </script>

    

    
<div class="container-fluid">
<?php
    include_once("../layouts/footer.php");
?>

</div>

</body>

</html>

