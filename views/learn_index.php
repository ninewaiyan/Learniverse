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
    <section id="learns" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Choose You want to learn</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/abc.gif" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Alphabet Learning</h5>
                            <p class="card-text">Learn the alphabet with fun color.</p>
                            <a href="../alphabet/capitalLetter.php" class="btn btn-danger mt-auto rounded-pill">Learn Now <i class="fa-solid fa-book-open" style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/123Count.gif" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Number Counting Space</h5>
                            <p class="card-text">Counting numbers through fun learning experiences.</p>
                            <a href="../number/numberLearn.php" class="btn btn-success mt-auto rounded-pill">Learn Now <i class="fa-solid fa-book-open" style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="card h-100 w-100">
                        <img src="../images/vocab.gif" class="card-img-top" alt="">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Vocabulary Adventure</h5>
                            <p class="card-text">Discover new words with us.</p>
                            <a href="../vocabulary/vocabularyLearn.php" class="btn btn-warning mt-auto rounded-pill">Learn Now <i class="fa-solid fa-book-open" style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex mt-4">
                    <div class="card h-100 w-100">
                        <img src="../images/abc1.gif" class="card-img-top" style="height: 300px; object-fit: cover;" alt="">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">ABC Adventure</h5>
                            <p class="card-text">Discover new words with us.</p>
                            <a href="../alphabet/alphabet.php" class="btn btn-warning mt-auto rounded-pill">Learn Now <i class="fa-solid fa-book-open" style="color:#ffffff;"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex mt-4">
                    <div class="card h-100 w-100">
                        <img src="../images/ComingSoon.gif" class="card-img-top" style="height: 300px; object-fit: cover;" alt="Word Match">
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
