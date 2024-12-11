<?php
include_once("../layouts/navbar.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse-ColorfulAlphabetBoard</title>
    <style>
        .alphabet-card {
            border-radius: 20px;
            background-color: #fff;
            text-align: center;
            margin: 10px;
            padding: 20px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .alphabet-card:hover {
            transform: scale(1.05);
            transition: 0.2s ease-in-out;
        }

        .alphabet-card .card-body {
            font-size: 48px;
            font-weight: bold;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Example color classes for each letter */
        .letter-a {
            background-color: #FF0000;
        }

        .letter-b {
            background-color: #0000FF;
        }

        .letter-c {
            background-color: #00CED1;
        }

        .letter-d {
            background-color: #FF4500;
        }

        .letter-e {
            background-color: #008000;
        }

        .letter-f {
            background-color: #20B2AA;
        }

        .letter-g {
            background-color: #1E90FF;
        }

        .letter-h {
            background-color: #8A2BE2;
        }

        .letter-i {
            background-color: #00CED1;
        }

        .letter-j {
            background-color: #FFA07A;
        }

        .letter-k {
            background-color: #20B2AA;
        }

        .letter-l {
            background-color: #FF6347;
        }

        .letter-m {
            background-color: #B22222;
        }

        .letter-n {
            background-color: #00FF00;
        }

        .letter-o {
            background-color: #00FA9A;
        }

        .letter-p {
            background-color: #FF69B4;
        }

        .letter-q {
            background-color: #9932CC;
        }

        .letter-r {
            background-color: #00FA9A;
        }

        .letter-s {
            background-color: #FF4500;
        }

        .letter-t {
            background-color: #87CEEB;
        }

        .letter-u {
            background-color: #FF1493;
        }

        .letter-v {
            background-color: #4B0082;
        }

        .letter-w {
            background-color: #FF6347;
        }

        .letter-x {
            background-color: #4682B4;
        }

        .letter-y {
            background-color: #32CD32;
        }

        .letter-z {
            background-color: #FF1493;
        }

        /* Add other letter classes with different colors */
    </style>
</head>

<body style="background: whitesmoke;">
    <audio id="backgroundMusic" loop>
        <source id="musicSource" src="../sounds/abcCounting.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Capital Letter</h1>

        <a href="smallLetter.php" class="btn btn-dark mb-3 me-1 rounded-square"> <i class="fa-solid fa-retweet"></i>
            a,b,c
        </a>
        <button class="btn btn-primary rounded-square mb-3 mx-2" id="song1-btn" onclick="toggleSong('song1')">
            🔇 Song 1
        </button>

        <button class="btn btn-secondary rounded-square mb-3 mx-2" id="song2-btn" onclick="toggleSong('song2')">
            🔇 Song 2
        </button>

        <button class="btn btn-dark mx-2 mb-3 rounded-pill" onclick="window.location.href='../views/index.php'">
            <i class="fa-solid fa-house"></i>
        </button>


        <!-- Table for Uppercase (Big) Letters -->
        <div class="row">
            <?php
            $alphabets = range('A', 'Z');
            $colors = [
                "letter-a",
                "letter-b",
                "letter-c",
                "letter-d",
                "letter-e",
                "letter-f",
                "letter-g",
                "letter-h",
                "letter-i",
                "letter-j",
                "letter-k",
                "letter-l",
                "letter-m",
                "letter-n",
                "letter-o",
                "letter-p",
                "letter-q",
                "letter-r",
                "letter-s",
                "letter-t",
                "letter-u",
                "letter-v",
                "letter-w",
                "letter-x",
                "letter-y",
                "letter-z"
            ];

            foreach ($alphabets as $index => $letter) {
                // Start a new row every 4 letters, except for the last two
                if ($index % 4 === 0 && $index !== 0 && $index < 24) {
                    echo '</div><div class="row">';
                }

                if ($index == 24) {
                    // For Y and Z, create a centered row with space around
                    echo '</div><div class="row justify-content-center">';
                }

                ?>
                <div class="col-3">
                    <div class="card alphabet-card shadow rounded-pill <?= $colors[$index] ?>"
                        onclick="playSound('<?= $letter ?>')">
                        <div class="card-body">
                            <?= $letter ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <script>
        function playSound(letter) {
            var audio = new Audio('audio/' + letter + '.mp3');
            audio.play();
        }

        var currentSong = null;
        var isPlaying = false; 

        function toggleSong(songId) {
            var music = document.getElementById("backgroundMusic");
            var musicSource = document.getElementById("musicSource");

            
            if (songId === "song1") {
                var songButton = document.getElementById("song1-btn");
                if (isPlaying && currentSong === "song1") {
                    music.pause(); 
                    songButton.innerHTML = "🔇 Song 1"; 
                    isPlaying = false;
                } else {
                    musicSource.src = "../sounds/abcCounting.mp3"; 
                    music.load(); 
                    music.play(); 
                    songButton.innerHTML = "🔊 Song 1"; 
                    isPlaying = true;
                    currentSong = "song1"; 
                }
            }

            if (songId === "song2") {
                var songButton = document.getElementById("song2-btn");
                if (isPlaying && currentSong === "song2") {
                    music.pause();
                    songButton.innerHTML = "🔇 Song 2";
                    isPlaying = false;
                } else {
                    musicSource.src = "../sounds/abcCounting2.mp3";
                    music.load(); 
                    music.play(); 
                    songButton.innerHTML = "🔊 Song 2";
                    isPlaying = true;
                    currentSong = "song2"; 
                }
            }
        }
    </script>
    <?php
    include_once("../layouts/footer.php");
    ?>
</body>

</html>