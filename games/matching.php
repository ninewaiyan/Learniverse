<?php
session_start();
include_once "../includes/db.php";
include_once("../controllers/UserController.php");

if (!isset($_SESSION['user_id'])) {
    header('location:../users/login.php');
} else {
    session_write_close();
}
include_once("../layouts/navbar.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:Matching Game</title>
</head>
<style>
    .overlay {
    display: none; 
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); 
    z-index: 1000; 
}

.overlay-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /* background-color: white; */
    padding: 20px;
    /* border-radius: 10px; */
    text-align: center;
    color: white;
}

.btn {
    margin: 10px;
}
.selected {
    border: 2px dashed #3498db;
    background-color: #e3f2fd;
}

.matched {
    border: 2px solid green;
    background-color: #d4f8e8;
    transform: scale(1.05);
}

.animate-match {
    animation: matchAnimation 0.5s ease-in-out;
}

@keyframes matchAnimation {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.animate-mismatch {
    animation: mismatchAnimation 0.5s ease-in-out;
}

@keyframes mismatchAnimation {
    0% { transform: rotate(0deg); }
    25% { transform: rotate(-5deg); }
    50% { transform: rotate(5deg); }
    100% { transform: rotate(0deg); }
}

</style>
<body style="background-image:url(../images/matchBgjpg.jpg)">
    <div class="container py-3">
        <h2 class="text-center mb-2">Matching Game Challenges</h2>

        <!-- <div class="text-center mt-2 mb-4">
            <div id="scoreDisplay"></div>
            <button class="btn btn-outline-primary rounded-pill mt-3" id="prevChallenge" disabled><i class="fa-solid fa-backward"></i></button>
            <button class="btn btn-danger mt-3 rounded-pill ms-1" id="retryButton"><i class="fa-solid fa-rotate-right"></i></button>
            <button class="btn btn-outline-primary rounded-pill mt-3 ms-1" id="nextChallenge" disabled><i class="fa-solid fa-forward"></i></button>

            <button id="toggleSound" class="btn btn-success rounded-pill mt-3 ms-1">🔇</button>
            <audio id="bgSound" preload="auto" loop>
                <source src="../sounds/alphabet-quest_88136.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

        </div>

        <div id="messageOverlay" class="overlay">
    <div class="overlay-content">
        <h2 id="overlayMessage"></h2>
        <div id="scoreDisplayOverlay"></div>
        <button id="retryButton" class="btn btn-danger">Retry</button>
        <button id="nextChallenge" class="btn btn-outline-primary" disabled>Next Challenge</button>
        <button id="closeOverlay" class="btn btn-secondary">Close</button>
    </div>
</div> -->

<div class="text-center mt-2 mb-4">
    <!-- <div id="scoreDisplay"></div> -->
    <!-- <button class="btn btn-outline-primary rounded-pill mt-3" id="prevChallenge" disabled>
        <i class="fa-solid fa-backward"></i>
    </button> -->

    <button class="btn btn-info mt-3 rounded-pill ms-1" id="reloadButton">
        <i class="fa-solid fa-shuffle"></i>
    </button>

    <button id="toggleSound" class="btn btn-success rounded-pill mt-3 ms-1">🔇</button>
            <audio id="bgSound" preload="auto" loop>
                <source src="../sounds/alphabet-quest_88136.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
</div>

<div id="messageOverlay" class="overlay">
    <div class="overlay-content">
        <h2 id="overlayMessage"></h2>
        <div id="scoreDisplayOverlay"></div>
        <button id="retryOverlayButton" class="btn btn-danger rounded-pill">Retry</button>
        <button id="nextOverlayButton" class="btn btn-primary rounded-pill" disabled>Next Challenge</button>
        <button id="closeOverlay" class="btn btn-secondary rounded-pill">Close</button>
    </div>
</div>



        <div id="challengeContainer" class="row">
            <div>
                <div class="row row-cols-6 g-3" id="photos"></div>
                <h4 class="text-center mt-5 mb-4">Select a letter first!</h4>
                <div class="row row-cols-6 g-3" id="letters"></div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary mt-3 mb-3 rounded-pill btn-lg"
                onclick="window.location.href='../views/game_index.php'"><i class="fa-solid fa-house"></i></button>
        </div>
    </div>


    <?php include_once("../layouts/footer.php"); ?>
    <script src="../js/matching.js"></script>
    <script>

    </script>
</body>

</html>