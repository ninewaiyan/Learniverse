<?php
// Step 1: Generate English alphabet array
$number = range('1', '10');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Letter Cards Slide</title>
    <style>
        /* Step 2: Basic styles for the cards and the container */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }

        .container {
            display: flex;
            overflow: hidden; /* Ensure only one card is visible */
            width: 150px; /* Set width according to card size */
            height: 200px;
            position: relative;
        }

        .card {
            min-width: 150px;
            height: 200px;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            position: absolute;
            top: 0;
            transition: all 0.5s ease; /* Smooth transition */
            border-radius: 10px;
        }

        .card.hidden {
            opacity: 0;
            transform: translateX(150px); /* Slide right */
        }

        .card.active {
            opacity: 1;
            transform: translateX(0); /* Slide into place */
        }

        .controls {
            text-align: center;
            margin-top: 20px;
        }

        .controls button {
            padding: 10px 20px;
            margin: 0 10px;
            font-size: 1em;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Step 2: Container for the cards -->
    <div class="container">
        <?php
        // Step 1: Loop through the alphabet and create cards for each letter
        foreach ($number as $index => $no) {
            // Assign class 'active' to the first card to make it visible initially
            $activeClass = $index === 0 ? 'active' : 'hidden';
            echo "<div class='card $activeClass' id='card-$index'>$no</div>";
        }
        ?>
    </div>

    <!-- Step 2: Control buttons for sliding the cards -->
    <div class="controls">
        <button onclick="previousCard()">Previous</button>
        <button onclick="nextCard()">Next</button>
    </div>

    <!-- Step 3: JavaScript for sliding the cards -->
    <script>
        let currentIndex = 0;
        const totalCards = <?php echo count($number); ?>;

        function showCard(index) {
            // Hide the current card
            document.getElementById('card-' + currentIndex).classList.remove('active');
            document.getElementById('card-' + currentIndex).classList.add('hidden');

            // Show the new card
            document.getElementById('card-' + index).classList.remove('hidden');
            document.getElementById('card-' + index).classList.add('active');

            // Update the current index
            currentIndex = index;
        }

        function nextCard() {
            let nextIndex = currentIndex + 1;
            if (nextIndex >= totalCards) {
                nextIndex = 0; // Loop back to the first card
            }
            showCard(nextIndex);
        }

        function previousCard() {
            let prevIndex = currentIndex - 1;
            if (prevIndex < 0) {
                prevIndex = totalCards - 1; // Loop back to the last card
            }
            showCard(prevIndex);
        }
    </script>

</body>
</html>