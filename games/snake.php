<?php

 include_once("../layouts/navbar.php");
 include_once("../controllers/RecordController.php");

 $userId = $_SESSION['user_id'] ?? null;
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $data = json_decode(file_get_contents("php://input"), true);
 
     $quizz_name = $data['quizz_name'];
     $achievement = $data['achievement'];
     $score = $data['score'];
     $user_id = $data['user_id'];
 
     $recordController = new RecordController();
     $result = $recordController->storeRecord($quizz_name, $achievement, $score, $user_id);
 
     echo json_encode(['success' => $result ? true : false]);
 }

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
    <title>Snake Game</title>
    <style>
        .snake {
            background-color: red;
            position: absolute;
            width: 20px;
            height: 20px;
        }

        .fruit {
            background-color: yellow;
            position: absolute;
            width: 20px;
            height: 20px;
        }

        .bone {
            background-color: black;
            position: relative;
            width: 20px;
            height: 20px;
        }

        .snake-board {
            position: relative;
            overflow: hidden;
            width: 100%;
            height: 100px;
            background-image: url('../images/snake-board.jpg');
            background-size: cover;
            background-attachment: scroll;
        }
    </style>
</head>

<body style="background-image: url('../images/snake_bg.jpg');">
    <div class="container text-center">
        <h2 class="mt-2">Snake Game</h2>
        <span id="game-over" class="text-danger display-4" style="display:none;">Game Over</span>
        <div class="info mb-3">
            <span id="hearts"></span> | Score: <span id="score">0</span> | Time: <span id="time">0</span> seconds
        </div>
        <div id="snake-board" class="snake-board mx-auto shadow-lg"></div>
        <button class="btn btn-warning mb-3 mt-3 rounded-pill" onclick="startSnakeGame()"><i class="fa-solid fa-play"></i></button>
        <button class="btn btn-secondary mt-3 mb-3 rounded-pill"
            onclick="window.location.href='../views/game_index.php'"><i class="fa-solid fa-house"></i></button>

        <audio id="bg-music" loop>
            <source src="../sounds/bg_song.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>
    <?php include_once("../layouts/footer.php"); ?>
    <script src="../js/snake.js"></script>
</body>

</html>