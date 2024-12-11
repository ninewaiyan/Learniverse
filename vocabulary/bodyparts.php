<?php
include_once("../layouts/navbar.php");
$vocab = [
    ['H', 'Hair', 'hair.jpg'],
    ['E', 'Eye', 'eye.jpg'],
    ['E', 'Ear', 'ear.jpg'],
    ['N', 'Nose', 'nose.jpg'],
    ['T', 'Teeth', 'teeth.jpg'],
    ['H', 'Hand', 'hand.jpg'],
    ['L', 'Leg', 'leg.jpg'],
    ['F', 'Foot', 'foot.jpg'],
    
    
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vocabulary Cards - Interactive Carousel</title>
    <style>
       

        /* Carousel container styling */
        .carousel-container {
            margin-bottom: 30px; /* Space below each carousel */
        }

        /* Individual vocab cards */
        .vocab-card {
            background-color: #ffffff;
            text-align: center;
            padding: 20px;
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative; /* For child absolute positioning */
            overflow: hidden; /* Hide overflow */
        }

        /* Hover effect */
        .vocab-card:hover {
            transform: translateY(-5px); /* Slight lift on hover */
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
            background-color: #ffeb3b; /* Bright yellow on hover */
        }

        /* Image styling */
        .vocab-card img {
            max-width: 80%; /* Smaller image */
            height: 150px;
            margin-bottom: 10px;
            border-radius: 10px; /* Rounded image corners */
        }

        /* Text styling */
        .vocab-card .card-body {
            font-size: 1.5rem; /* Larger font size */
            font-weight: bold;
            color: #333; /* Dark text for contrast */
            margin-top: 10px; /* Space above text */
        }

        /* Animation styles */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }

        .shake {
            animation: shake 0.5s ease forwards;
        }

        /* Hide inactive carousel items */
        .carousel-item {
            display: none;
        }

        .carousel-item.active {
            display: block;
        }
    </style>
</head>

<body style="background: whitesmoke;">

    <div class="container my-5">
        <h1 class="text-center mb-4">Body Parts</h1>

        <?php

        // Split vocab into chunks of 4 for carousels
        $chunkedVocab = array_chunk($vocab, 4);
        foreach ($chunkedVocab as $index => $chunk) {
            ?>
            <div class="carousel-container">
                <div id="vocabCarousel<?= $index ?>" class="carousel slide" data-bs-ride="carousel" data-bs-interval="20000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <?php
                                foreach ($chunk as $item) {
                                    $word = $item[1];
                                    $image = $item[2];
                                    ?>
                                    <div class="col">
                                        <div class="vocab-card shake" onclick="playSound('<?= $word ?>')">
                                            <img src="images/<?= $image ?>" alt="<?= $word ?>">
                                            <div class="card-body"><?= $word ?></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        // Create additional carousel items for looping
                        for ($i = 1; $i < count($chunk); $i++) {
                            ?>
                            <div class="carousel-item">
                                <div class="row">
                                    <?php
                                    // Rotate cards for next carousel item
                                    foreach ($chunk as $item) {
                                        $indexInChunk = (array_search($item, $chunk) + $i) % count($chunk);
                                        $word = $chunk[$indexInChunk][1];
                                        $image = $chunk[$indexInChunk][2];
                                        ?>
                                        <div class="col">
                                            <div class="vocab-card shake" onclick="playSound('<?= $word ?>')">
                                                <img src="images/<?= $image ?>" alt="<?= $word ?>">
                                                <div class="card-body"><?= $word ?></div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#vocabCarousel<?= $index ?>" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#vocabCarousel<?= $index ?>" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> -->
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <button class="btn btn-dark mx-3 me-1 mb-3 rounded-pill" onclick="window.location.href='vocabularyLearn.php'"><i class="fa-solid fa-house"></i></button>

    <script>
    // Variable to keep track of the currently playing audio
    let currentAudio = null;

    function playSound(word) {
        // Stop the previous audio if it’s still playing
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0; // Reset the playback position to the beginning
        }

        // Play the new audio
        currentAudio = new Audio('audio/' + word + '.mp3');
        currentAudio.play();
    }

    // Custom auto-looping logic with shake effect
    document.querySelectorAll('.carousel').forEach(carousel => {
        let items = carousel.querySelectorAll('.carousel-item');
        let index = 0;

        setInterval(() => {
            // Hide the current item
            items[index].classList.remove('active');
            index = (index + 1) % items.length; // Move to next item
            // Show the new current item
            items[index].classList.add('active');

            // Add shake effect to the new active cards
            const newCards = items[index].querySelectorAll('.vocab-card');
            newCards.forEach(card => {
                card.classList.add('shake');
                // Remove shake class after animation ends to allow re-animation
                card.addEventListener('animationend', () => {
                    card.classList.remove('shake');
                }, { once: true });
            });
        }, 15000); // Change interval as needed
    });
</script>

<?php
    include_once("../layouts/footer.php");
    ?>

</body>

</html>
