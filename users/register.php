<?php
include_once "../controllers/UserController.php";
include_once "../controllers/MailController.php";
include_once "../models/mail.php";

$message = "";
$error = "";
$isError = false;

$firstname ="";
$lastname ="";
$email ="";
$image ="";
$password = "";
$confirm_password = "";

if (isset($_POST['submit'])) {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  $userController = new UserController();
  $mailController = new MailController();

  $emailExist = $userController->emailCheck($email);

  if (!$emailExist) {

    if ($password == $confirm_password) {

      $check = $userController->isValidPassword($password);
      if($check){

      $filename = $_FILES['image']['name'];
      $filetype = $_FILES['image']['type'];
      $filesize = $_FILES['image']['size'];
      $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
      $tmpFile = $_FILES["image"]["tmp_name"];

      if ($_FILES['image']['error'] != 0) {

        $error = " Register Fail !!";
        $isError = true;

      } else {

        if ($filesize < 10737418240) {
          $fileinfo = explode(".", $filename);
          $actualType = end($fileinfo);

          if (in_array($actualType, $allowedImageTypes)) {

          $updatedName = time() . $filename;

          $result = $userController->register($firstname, $lastname, $email,$updatedName, $password);

            if ($result) {

              move_uploaded_file($tmpFile, 'userImages/' . $updatedName);
              $message = "🥳Register Successful";
              $name = $firstname." ".$lastname;
              $mailController->registerMail($name,$email);

            } else {
              $error = "😒Register Fail";
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
    
    }else{

      $error = "😒Password must be more than 8 character and contain number,Small Letter, Capital Letter and Special sysmbols";
      $isError = true;
      
    }
      
    } else {
      $error = "😒Passwords do not match.";
      $isError = true;
    }

  } else {
    $error = "Email Already exist!!";
    $isError = true;
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Learniverse:SignUp</title>
</head>

<body style="background: white">

   <?php include_once("../layouts/navbar.php"); ?> 

  <div class="container d-flex justify-content-center align-items-center min-vh-100 mb-4 mt-3">

    <div class="text-center" style="width: 100%; max-width: 600px;">
      <h1 class="text-success">Welcome to Learniverse!</h1>
      <hr>
      <h5>Already have an account?</h5>
      <p>Sign in to your Learniverse account.</p>
      <a href="login.php" class="btn btn-outline-success rounded-pill px-5 mt-5">Sign In Now</a>
    </div>

    <div class="card-login p-4 shadow-lg ms-1" style="width: 100%; max-width: 600px;">
      <h1 class="text-center text-success mb-1">Sign Up</h1>

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

      <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-6">
          <label for="firstname" class="form-label">Firstname<span class="text-danger">*</span></label>
          <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter firstname"
            value="<?php echo $isError ? $firstname : ''; ?>"
            required>
        </div>
        <div class="mb-2">
          <label for="lastname" class="form-label">Lastname<span class="text-danger">*</span></label>
          <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter lastname"
            value="<?php echo $isError ? $lastname : ''; ?>"
            required>
        </div>
        <div class="mb-2">
          <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Email Address"
            value="<?php echo $isError ? $email : ''; ?>"
            required>
        </div>
        <div class="mb-2">
          <label for="image" class="form-label">Upload Image<span class="text-danger">*</span></label>
          <input type="file" id="image" name="image" accept="image/*" class="form-control"
            required>
        </div>
        <div class="mb-2 position-relative">
          <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text toggle-password" onclick="togglePassword('password', this)">😎</span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"
              value="<?php echo $isError ? $password : ''; ?>" ;
              required>
          </div>
        </div>
        <div class="mb-2 position-relative">
          <label for="confirm_password" class="form-label">Confirm Password<span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text toggle-password" onclick="togglePassword('confirm_password', this)">😎</span>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control"
              placeholder="Confirm Password"
              value="<?php echo $isError ? $confirm_password : ''; ?>"
              required>
          </div>
        </div>
        <button type="submit" name="submit" class="btn btn-success w-100 mt-2 rounded-pill">Sign Up</button>
      </form>
    </div>
  </div>

  <?php include_once("../layouts/footer.php"); ?>

  <script>
    function togglePassword(id, element) {
      const passwordInput = document.getElementById(id);
      const toggleIcon = element;

      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.textContent = "🫣";
      } else {
        passwordInput.type = "password";
        toggleIcon.textContent = "😎";
      }
    }
  </script>
</body>

</html>