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
$userController = new UserController();
$profileImageController = new ProfileImageController();
$mailController = new MailController();

$message = "";
$error = "";
$isError = false;

$firstname = "";
$lastname = "";
$email = "";
$user_id = $_SESSION['user_id'];
$old_image = $_SESSION['user_image'];
$old_email = $_SESSION['user_email'];


if (isset($_POST['submit'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $filename = $_FILES['new_image']['name'];
    $filetype = $_FILES['new_image']['type'];
    $filesize = $_FILES['new_image']['size'];
    $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
    $tmpFile = $_FILES["new_image"]["tmp_name"];

    $emailExist = $userController->emailCheck($email);
    $checkEmail = $old_email != $email;

    if ($emailExist && $checkEmail) {
        $error = "😒Updated Email Already exist!!";
        $isError = true;
    } else {

        if ($_FILES['new_image']['error'] != 0) {

            $result = $userController->updateProfile($user_id, $firstname, $lastname, $email, $old_image);
            if ($result) {

                $_SESSION['first_name'] = $firstname;
                $_SESSION['last_name'] = $lastname;
                $_SESSION['user_fullname'] = $firstname . ' ' . $lastname;
                if ($checkEmail) {

                    $name = $firstname . " " . $lastname;
                    $mailController->emailChangeMail($name, $old_email, $email);
                }
                $_SESSION['user_email'] = $email;
                $_SESSION['user_image'] = $old_image;

                $message = "🥳Profile is successfully updated !!";
            } else {
                $error = "😒Update Fail";
                $isError = true;
            }
        } else {

            if ($filesize < 10737418240) {
                $fileinfo = explode(".", $filename);
                $actualType = end($fileinfo);

                if (in_array($actualType, $allowedImageTypes)) {

                    $updatedName = time() . $filename;

                    $result1 = $profileImageController->saveOldprofileImage($old_image, $user_id);
                    $result2 = $userController->updateProfile($user_id, $firstname, $lastname, $email, $updatedName);

                    if ($result1 && $result2) {

                        move_uploaded_file($tmpFile, 'userImages/' . $updatedName);
                        $_SESSION['first_name'] = $firstname;
                        $_SESSION['last_name'] = $lastname;
                        $_SESSION['user_fullname'] = $firstname . ' ' . $lastname;
                        if ($checkEmail) {
                            $name = $firstname . " " . $lastname;
                            $mailController->emailChangeMail($name, $old_email, $email);
                        }
                        $_SESSION['user_email'] = $email;
                        $_SESSION['user_image'] = $updatedName;

                        $message = "🥳Profile is successfully updated !!";
                    } else {
                        $error = "😒Update Fail";
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
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse: Edit Profile</title>
    <style>
        /* Profile Image Wrapper */
        .profile-image-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin-left: 35%;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        /* Profile Image */
        .profile-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }

        /* Overlay on hover */
        .profile-image-wrapper .overlay {
            position: absolute;
            top: 0%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            opacity: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        /* Show overlay on hover */
        .profile-image-wrapper:hover .overlay {
            opacity: 1;
        }

        /* Hidden input for file */
        #image-upload {
            display: none;
        }
    </style>
</head>

<body style="background: white">
    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-4">
        <div class="card-login p-4 shadow-lg mb-4" style="width: 100%; max-width: 600px;">
            <div class="text-center mb-6 mt-4">
                <h3 class="text-primary">Edit Profile</h3>

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

                <!-- Profile Image Wrapper -->
                <div class="profile-image-wrapper">
                    <img id="profile-image" src="../users/userImages/<?php echo $_SESSION['user_image']; ?>" alt="Profile Image">
                    <!-- Overlay with Update button -->
                    <div class="overlay" onclick="triggerFileInput()">Update Profile</div>
                </div>

                <p class="mt-2 mb-0"> <?php echo $_SESSION['user_fullname']; ?> </p>
                <small class="text-muted"><?php echo $_SESSION['user_email']; ?></small>
            </div>

            <form method="post" action="" enctype="multipart/form-data">
                <input type="file" id="image-upload" name="new_image" accept="image/*" class="form-control" onchange="previewImage(event)">

                <div class="mb-1">
                    <label for="firstname" class="form-label">Firstname<span class="text-danger">*</span></label>
                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname" value="<?php echo $isError ? $firstname : $_SESSION['first_name']; ?>" required>
                </div>

                <div class="mb-1">
                    <label for="lastname" class="form-label">Lastname<span class="text-danger">*</span></label>
                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname" value="<?php echo $isError ? $lastname : $_SESSION['last_name']; ?>" required>
                </div>

                <div class="mb-1">
                    <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo $isError ? $email : $_SESSION['user_email']; ?>" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success w-100 mt-3 rounded-pill">Update <i class="fa-solid fa-up-right-from-square"></i></button>
            </form>
            <div class="row">
                <a href="profile.php" class="btn btn-secondary w-50 mt-1 rounded-pill"><i class="fa-solid fa-angles-left"></i></a>
                <a href="../views/index.php" class="btn btn-secondary w-50 mt-1 rounded-pill"><i class="fa-solid fa-house"></i></a>
            </div>
        </div>
    </div>

    <?php include_once("../layouts/footer.php"); ?>

    <script>
        // Function to trigger file input when profile image or overlay is clicked
        function triggerFileInput() {
            document.getElementById('image-upload').click();
        }

        // Function to preview the selected image
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-image').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>