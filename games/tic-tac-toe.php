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
    <title>Tic-Tac-Toe</title>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <style>
        h2 {
            margin: 0;
            padding: 10px;
            font-size: 2.5rem;
        }

        .tic-tac-toe-board {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            gap: 1px;
            margin: 20px auto;
            width: 250px;
            height: 250px;
            border: 5px solid white;
            border-radius: 10px;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);  */
            background-color: black;
        }

        .cell {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-family: 'Luckiest Guy', cursive;
            color: #d4af37;
            border: 2px solid white;
            background-color: white;
            transition: color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .mode-btn, .back-index-btn, .difficulty-btn, .restart-btn {
            background-color: #d4af37;
            color: #333;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin: 10px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .mode-btn:hover, .back-index-btn:hover, .difficulty-btn:hover, .restart-btn:hover {
            background-color: #b58e2a;
            transform: scale(1.05);
        }

        #difficulty-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin: 10px;
        }

        #difficulty-buttons button {
            margin: 5px;
        }

        #game-status {
            font-size: 1.5rem;
            margin-top: 20px;
        }
    </style>
</head>
<body style="text-align: center; margin: 0; padding: 0; color: black; background-image:url('../images/matchBgjpg.jpg')">
    <div class="container" style="max-width: 500px; margin: 20px auto; padding: 20px; border: 5px solid #d4af37; border-radius: 15px; background-color: white; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);">
        <h2>Tic-Tac-Toe</h2>
        <button class="mode-btn rounded-pill" onclick="startGame('player')">
            <i class="fa-regular fa-user fa-sm"></i> Vs <i class="fa-regular fa-user fa-sm"></i>
        </button>
        <button class="mode-btn rounded-pill" onclick="showDifficulty()">
            <i class="fa-regular fa-user fa-sm"></i> Vs <i class="fa-solid fa-robot fa-sm"></i>
        </button>
        <div id="difficulty-buttons" style="display: none;">
            <button class="difficulty-btn btn btn-sm rounded-pill" onclick="startGame('bot', 'easy')">Easy</button>
            <button class="difficulty-btn btn btn-sm rounded-pill" onclick="startGame('bot', 'medium')">Medium</button>
            <button class="difficulty-btn btn btn-sm rounded-pill" onclick="startGame('bot', 'hard')">Hard</button>
        </div>

        <div class="tic-tac-toe-board" id="tic-tac-toe-board">
            <div class="cell" data-index="0"></div>
            <div class="cell" data-index="1"></div>
            <div class="cell" data-index="2"></div>
            <div class="cell" data-index="3"></div>
            <div class="cell" data-index="4"></div>
            <div class="cell" data-index="5"></div>
            <div class="cell" data-index="6"></div>
            <div class="cell" data-index="7"></div>
            <div class="cell" data-index="8"></div>
        </div>

        <p id="game-status">Select a game mode to start</p>

        <button class="back-index-btn rounded-pill" onclick="window.location.href='../views/game_index.php'">
            <i class="fa-solid fa-house"></i>
        </button>
        <button class="restart-btn rounded-pill" onclick="resetBoard()">
            <i class="fa-solid fa-rotate-right"></i>
        </button>
    </div>

    <script src="../js/tic-tac-toe.js"></script>
    <?php include_once("../layouts/footer.php"); ?>
</body>
</html>
