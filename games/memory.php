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
  <title>Memory Game for Kids</title>
 
  <style>
    .card {
      width: 100px;
      height: 100px;
      background-color: #ccc;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      cursor: pointer;
      user-select: none;
    }
    .card img {
      max-width: 80%;
      display: none;
    }
    .card.flip img {
      display: block;
    }
    .card.flip {
      transform: rotateY(180deg);
    }
    .content {
        flex: 1;
    }
    .message-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 1000; 
}

.message-overlay h2 {
    margin-bottom: 10px;
}

  </style>
</head>
<body class="bg-light">

<h3 class="mt-4 text-center">Memory Game for Kids</h3>

<div class="d-flex justify-content-center w-70 mt-3 mb-1">
  <p class="me-2">Time: <span id="timer">0</span> seconds</p> 
  <p class="ms-2">Level: <span id="level">1</span></p>
</div>


<div id="congratulations" class="message-overlay" style="display: none;">
    <h4>Congratulations! You've completed Level <span id="completedLevel"></span>!</h4>
    <button id="nextLevelButton"  class="btn btn-success rounded-pill mt-1">Next Level</button>
</div>



<div class="text-center mb-3">
    <button id="startGameButton" class="btn btn-primary rounded-pill">Start Game</button>
    <button id="toggleSound" class="btn btn-success rounded-pill ms-1">🔇</button>
            <audio id="bgSound" preload="auto" loop>
                <source src="../sounds/alphabet-quest_88136.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
            <button class="btn btn-secondary mt-3 mb-3 rounded-pill"
            onclick="window.location.href='../views/game_index.php'"><i class="fa-solid fa-house"></i></button>
</div>

<div class="game-board d-grid gap-2 justify-content-center" id="gameBoard"></div>

<audio id="matchSound" src="../sounds/matchedCard.mp3"></audio>
<audio id="flipSound" src="../sounds/flipCard.mp3"></audio>
<audio id="lvlCompleteSound" src="../sounds/completeCard.mp3"></audio>

<div class="content mt-3"></div>

<script src="../js/memory.js"></script>
<?php include_once("../layouts/footer.php"); ?>
</body>
</html>
