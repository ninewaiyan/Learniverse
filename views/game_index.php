<?php
session_start();
include_once "../includes/db.php";
include_once("../controllers/UserController.php");

if (!isset($_SESSION['user_id'])) {
    header('location:../users/login.php');
} else {
    session_write_close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:GameIndex</title>
</head>
<body style="background:whitesmoke;">
<?php include_once("../layouts/navbar.php");?>
    <section id="games" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Choose Your Game</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/snakeLogo.gif" class="card-img-top" alt="Snake Game">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Snake Game</h5>
                            <p class="card-text">Navigate your snake to eat and grow longer. Avoid running into yourself!</p>
                            <a href="../games/snake.php" class="btn btn-danger mt-auto rounded-pill">Play Now <i class="fa-solid fa-gamepad"
                            style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/matchLogo.gif" class="card-img-top" alt="Math Challenge">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Matching</h5>
                            <p class="card-text">Engage in exciting photo and letter matching activities to enhance your cognitive skills!</p>
                            <a href="../games/matching.php" class="btn btn-success mt-auto rounded-pill">Play Now <i class="fa-solid fa-gamepad"
                            style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/tic-tac-toe-Logo.gif" class="card-img-top" alt="Word Match">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Tic-Tac-Toe</h5>
                            <p class="card-text">Find and match words in this exciting game.</p>
                            <a href="../games/tic-tac-toe.php" class="btn btn-warning mt-auto rounded-pill">Play Now <i class="fa-solid fa-gamepad"
                            style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex mt-4">
                    <div class="card h-100 w-100">
                        <img src="../images/memory/memory1.gif" class="card-img-top" style="height: 300px; object-fit: cover;" alt="Word Match">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Meomry</h5>
                            <p class="card-text">Find and match words in this exciting game.</p>
                            <a href="../games/memory.php" class="btn btn-warning mt-auto rounded-pill">Play Now <i class="fa-solid fa-gamepad"
                            style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex mt-4">
                    <div class="card h-100 w-100">
                        <img src="../images/flappy_bird/flappy-bird-gif.gif" style="height: 300px; object-fit: cover;" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Flappy Bird</h5>
                            <p class="card-text">Fly Avenger.</p>
                            <a href="../games/flappy_bird.php" class="btn btn-warning mt-auto rounded-pill">Play Now <i class="fa-solid fa-gamepad"
                            style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex mt-4">
                    <div class="card h-100 w-100">
                        <img src="../images/ComingSoon.gif" style="height: 300px; object-fit: cover;" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Still developing...</h5>
                            <p class="card-text">This feature is currently under development. Stay tuned for updates!</p>
                            <a href="index.php" class="btn btn-dark mt-auto rounded-pill">Home <i class="fa-solid fa-house" style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once("../layouts/footer.php");?>

   
</body>
</html>
