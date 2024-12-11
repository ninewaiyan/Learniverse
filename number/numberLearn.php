<?php include_once("../layouts/navbar.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:123 Learning</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body style="background:whitesmoke">
    <audio id="backgroundMusic" loop>
        <source id="musicSource" src="../sounds/123Counting.mp3" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>

    <div class="container mt-5 text-center">
        <h1 class="display-4 text-success">Number Counting Space</h1>
        <p class="lead">Learn numbers 0 to 100 in a fun and interactive way!</p>
        <p>Click on each number to learn more about it!</p>
    </div>

    <div class="container text-center mt-4">
        <button class="btn btn-primary rounded-pill" id="song1-btn" onclick="toggleSong('song1')">
        🔇 Song 1
        </button>

        <button class="btn btn-secondary rounded-pill" id="song2-btn" onclick="toggleSong('song2')">
        🔇 Song 2
        </button>
        <button class="btn btn-dark rounded-pill" onclick="window.location.href='../views/index.php'"><i class="fa-solid fa-house"></i></button>
    </div>

    <div class="container mt-4">
        <div class="row g-4">
            <?php
            $numbers = [
                0 => ["description" => "Zero", "color" => "warning"],
                1 => ["description" => "One", "color" => "primary"],
                2 => ["description" => "Two", "color" => "success"],
                3 => ["description" => "Three", "color" => "danger"],
                4 => ["description" => "Four", "color" => "warning"],
                5 => ["description" => "Five", "color" => "info"],
                6 => ["description" => "Six", "color" => "secondary"],
                7 => ["description" => "Seven", "color" => "dark"],
                8 => ["description" => "Eight", "color" => "primary"],
                9 => ["description" => "Nine", "color" => "success"],
                10 => ["description" => "Ten", "color" => "danger"],
                100 => ["description" => "One Hundred", "color" => "primary"],
            ];

            foreach ($numbers as $num => $data) {
                echo '
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="card text-center">
                        <div class="card-body shadow">
                            <h2 class="display-3 text-' . $data['color'] . '">' . $num . '</h2>
                            <p class="card-text">' . $data['description'] . '</p>
                            <button class="btn btn-outline-' . $data['color'] . ' rounded-pill w-100" onclick="playSound(\'' . $num . '\')">🔊</button>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <?php
    include_once("../layouts/footer.php");
    ?>

    <script>
        var currentSong = null;
        var isPlaying = false; 

        function playSound(number) {
            let audio = new Audio('../sounds/number/' + number + '.mp3');
            audio.play();
        }

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
                    musicSource.src = "../sounds/123Counting.mp3"; 
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
                    musicSource.src = "../sounds/bg_song.mp3";
                    music.load(); 
                    music.play(); 
                    songButton.innerHTML = "🔊 Song 2"; 
                    isPlaying = true;
                    currentSong = "song2"; 
                }
            }
        }
    </script>

    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
