<?php
include_once "../controllers/UserController.php";
$message = "";
$error = "";
$isError = false;
$email = "";
$password = "";
$userController = new UserController();

if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $isSuccessfull = $userController->login($email, $password);

    if ($isSuccessfull) {
        
        $isEnable = $userController->isEnable($email);

        if ( $isEnable) {
            header("location:../views/index.php");
        } else {
            $error = "😒Your Account is temporarily disable !!";
            $isError = true;

        }
    } else {
        $error = "😒The user credentials were incorrect.";
        $isError = true;
        
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:Signin</title>
</head>

<body style="background: white">
    <?php include_once("../layouts/navbar.php");?>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card-login p-4 shadow-lg mb-4" style="width: 100%; max-width: 600px;">
            <h1 class="text-center text-success mb-4">Sign In</h1>

            <?php if ($isError): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address<span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email Address"
                        value="<?php echo $isError ? $email : "" ?>" required>
                </div>
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text toggle-password" onclick="togglePassword()">😎</span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                            value="<?php echo $isError ? $password : "" ?>" required>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-success w-100 mt-3 rounded-pill" name="submit">Sign
                    In</button>
            </form>
        </div>

        <div class="text-center ms-4" style="width: 100%; max-width: 600px;">
            <h4>Don't have an account?</h4>
            <hr>
            <p>Sign up for a FREE Learniverse account.</p>
            <strong class="text-danger">*Parents: Ensure your child has permission to sign up.</strong><br>
            <a href="register.php" class="btn btn-outline-success rounded-pill px-5 mt-5">Sign Up Now</a>
        </div>
    </div>

    <?php include_once("../layouts/footer.php"); ?>


    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password");

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

