<?php
session_start();
include_once '../includes/db.php';
include_once "../controllers/UserController.php";
include_once "../controllers/ProfileImageController.php";
include_once "../controllers/MailController.php";

if (!isset($_SESSION['user_id'])) {
    header('location:../users/login.php');
} else {
    session_write_close();
}
include_once "../layouts/navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:ProfileInfo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background: white">
    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-4" >
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px;">
            <div class="text-center mb-4">
                <h3 class="text-primary">Your Profile</h3>
            </div>

            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_image'])): ?>
                <div class="text-center mb-3">
                    <img src="../users/userImages/<?php echo $_SESSION['user_image']; ?>" alt="Profile Image"
                        class="rounded-circle" style="width: 120px; height: 120px;">
                    <p class="mt-2 mb-0 fw-bold"><?php echo $_SESSION['user_fullname']; ?></p>
                    <small class="text-muted"><?php echo $_SESSION['user_email']; ?></small>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <strong class="ms-4">First Name : </strong>
                        <span class="me-4"> <?php echo $_SESSION['first_name']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong class="ms-4">Last Name : </strong>
                        <span class="me-4"><?php echo $_SESSION['last_name']; ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong class="ms-4">Email : </strong>
                        <span class="me-4"><?php echo $_SESSION['user_email']; ?></span>
                    </li>
                </ul>

                <div class="d-grid gap-2 mt-4">
                    <a href="../users/edit_profile.php" class="btn btn-primary rounded-pill">✏️ Edit Profile</a>
                    <a class="btn btn-success rounded-pill" id="changePasswordBtn">🔑 Change Password</a>

                    <a href="../views/index.php" class="btn btn-secondary mt-1 rounded-pill"><i
                            class="fa-solid fa-house"></i></a>
                </div>

            <?php else: ?>
                <div class="alert alert-warning text-center" role="alert">
                    <strong>No account found!</strong> Please log in.
                </div>
                <div class="d-grid">
                    <a href="../users/login.php" class="btn btn-success">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>



    <?php include_once("../layouts/footer.php"); ?>


</body>
<script>
    document.getElementById('changePasswordBtn').addEventListener('click', function () {
        Swal.fire({
            title: 'Change Password',
            html: `
            <div style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;">
                <span onclick="togglePassword('old_password', this)" style="cursor: pointer;">😎</span>
                <input type="password" id="old_password" class="swal2-input" placeholder="Old Password" style="flex: 1;">  
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <span onclick="togglePassword('new_password', this)" style="cursor: pointer;">😎</span>
                <input type="password" id="new_password" class="swal2-input" placeholder="New Password" style="flex: 1;">
            </div>
        `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            preConfirm: () => {
                const oldPassword = document.getElementById('old_password').value;
                const newPassword = document.getElementById('new_password').value;
                if (!oldPassword || !newPassword) {
                    Swal.showValidationMessage('Please enter both passwords');
                }
                return { oldPassword, newPassword };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = {
                    old_password: result.value.oldPassword,
                    new_password: result.value.newPassword
                };

                fetch('change_password.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Success!', 'Your password has been changed.', 'success');
                        } else {
                            Swal.fire('Error!', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', 'There was an error processing your request.', 'error');
                    });
            }
        });
    });

    function togglePassword(id, element) {
        const passwordInput = document.getElementById(id);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            element.textContent = "🫣"; 
        } else {
            passwordInput.type = "password";
            element.textContent = "😎"; 
        }
    }


</script>

</html>