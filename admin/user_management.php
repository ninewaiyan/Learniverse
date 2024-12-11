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
    <title>User Management</title>
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
                 btn-lg text-center shadow-lg w-100 rounded">User Management</h2>
                <!-- <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <form action="" method="post" class="d-flex ">
                            <input type="text" class="form-control  custom-input me-2 mb-2" id="searchButton" placeholder="Search ..." name="query" value="<?php if ($query != '') echo $query ?>">
                            <button class="btn btn-outline-success rounded  mb-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div> -->


                <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Enable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $count = 1;
                        foreach ($users as $user) {

                            echo '
						<tr>
								<td>' . $count++ . '</td>
								<td>' . $user["firstname"] . '</td>
								<td>' . $user["lastname"] . '</td>
								<td>' . $user["email"] . '</td>
								<td>';
                            echo $user["enable"] ? '<h5 class="text-success">Yes</h5>' : '<h5 class="text-danger">No</h5>';
                            echo '</td>
								<td>';
                            // echo $user['enable']?'<a href="adminpanel.php?mode=DISABLE&user_id='.$user['id'].'" class="btn btn-outline-danger">disable</a>':
                            // '<a href="adminpanel.php?mode=ENABLE&user_id='.$user['id'].'"class="btn btn-outline-success">enable</a>';
                            echo '<a href="#" id="toggle-' . $user['id'] . '" onclick="toggleUser(' . $user['id'] . ', \'' . ($user['enable'] ? 'DISABLE' : 'ENABLE') . '\'); return false;" class="' . ($user['enable'] ? 'btn btn-outline-danger' : 'btn btn-outline-success') . '">' . ($user['enable'] ? 'Disable' : 'Enable') . '</a>';
                            echo '</td>
							</tr>';
                        }

                        ?>
                    </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Enable</th>
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

        $(document).ready(function() {
            $('#user_table').DataTable(); // Initialize DataTable
        });

    </script>

    
<div class="container-fluid">
<?php
    include_once("../layouts/footer.php");
    ?>

</div>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>


</body>

</html>

