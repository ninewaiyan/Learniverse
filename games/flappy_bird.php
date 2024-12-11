<?php
session_start();
include_once "../includes/db.php"; // Database connection
include_once "../controllers/UserController.php";
include_once "../controllers/RecordController.php";

$userId = $_SESSION['user_id'] ?? null; // Get user ID from session if available

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and decode JSON data from the request
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract individual data fields from the request
	$quizz_name = $data['quizz_name'] ?? 'flappy-birds';
    $achievement = $data['achievement'] ?? '';
    $score = $data['score'] ?? 0;
    $user_id = $data['user_id'] ?? $userId; // Fallback to session user_id if not provided

    // Ensure that a valid user_id is available
    if ($user_id) {
        // Create a new RecordController instance to save the score
        $recordController = new RecordController();
        $result = $recordController->storeRecord($quizz_name, $achievement, $score, $user_id);

        // Return JSON response to indicate success or failure
        echo json_encode(['success' => $result ? true : false]);
    } else {
        // User not authenticated
        echo json_encode(['success' => false, 'message' => 'User not authenticated']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/favicon.ico"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Flappy Bird Game</title>
    <style>

* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: Arial, Helvetica, sans-serif;
}
.background {
	height: 100vh;
	width: 100vw;
	background: url('../images/flappy_bird/background-img.png') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.bird {
	height: 70px;
	width: 100px;
	position: fixed;
	top: 40vh;
	left: 30vw;
	z-index: 100;
}
.pipe_sprite {
	position: fixed;
	top: 40vh;
	left: 100vw;
	height: 70vh;
	width: 6vw;
	background:radial-gradient(lightgreen 50%, green);
	border: 5px solid black;
}


.message {
	position: absolute;
	z-index: 10;
	color: black;
	top: 30%;
	left: 50%;
	font-size: 4em;
	transform: translate(-50%, -50%);
	text-align: center;
}
.messageStyle{
	background: white;
	padding: 30px;
	box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
	border-radius: 5%;
}
.score {
	position: fixed;
	z-index: 10;
	height: 10vh;
	font-size: 10vh;
	font-weight: 100;
	color: white;
	-webkit-text-stroke-width: 2px;
    -webkit-text-stroke-color: black;
	top: 0;
	left: 0;
	margin: 10px;
	font-family: Arial, Helvetica, sans-serif;
}
.score_val {
	color: gold;
	font-weight: bold;
}
@media only screen and (max-width: 1080px) {
    .message{
		font-size: 50px;
		top: 50%;
		white-space: nowrap;
	}
	.score{
		font-size: 8vh;
	}
	.bird{
		width: 120px;
		height: 90px;
	}
	.pipe_sprite{
		width: 14vw;
	}
}
    </style>
</head>
<body>
    <div class="background"> <button class="btn btn-secondary btn-lg  mt-3 mb-3 rounded-pill"
	onclick="window.location.href='../views/game_index.php'"><i class="fa-solid fa-house"></i></button></div>
    <img src="../images/flappy_bird/Bird.png" alt="bird-img" class="bird" id="bird-1">
    <div class="message">
        Enter To Start Game <p><span style="color: red;">&uarr;</span> ArrowUp to Control</p>
    </div>
    <audio id="backgroundMusic" loop>
    <source src="../sounds/flappy_bird_sounds/bgsound.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
    <div class="score">
        <span class="score_title"></span>
        <span class="score_val"></span>
    </div>

    <script src="../js/flappy-bird.js" defer></script>


</body>
</html>
   