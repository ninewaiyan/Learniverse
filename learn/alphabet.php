<?php
    include_once("../layouts/navbar.php");
    // Step 1: Generate English alphabet array
    $alphabets = range('A', 'Z');

    $images =[
        '../images/alphabets/a.jpg',
        '../images/alphabets/b.jpg',
        '../images/alphabets/c.jpg',
        '../images/alphabets/d.jpg',
        '../images/alphabets/e.jpg',
        '../images/alphabets/f.jpg',
        '../images/alphabets/g.jpg',
        '../images/alphabets/h.jpg',
        '../images/alphabets/i.jpg',
        '../images/alphabets/j.jpg',
        '../images/alphabets/k.jpg',
        '../images/alphabets/l.jpg',
        '../images/alphabets/m.jpg',
        '../images/alphabets/n.jpg',
        '../images/alphabets/o.jpg',
        '../images/alphabets/p.jpg',
        '../images/alphabets/q.jpg',
        '../images/alphabets/r.jpg',
        '../images/alphabets/s.jpg',
        '../images/alphabets/t.jpg',
        '../images/alphabets/u.jpg',
        '../images/alphabets/v.jpg',
        '../images/alphabets/w.jpg',
        '../images/alphabets/x.jpg',
        '../images/alphabets/y.jpg',
        '../images/alphabets/z.jpg'
    ];

    $audioFile=[
        '../images/audios/a.mp3',
        '../images/audios/b.mp3',
        '../images/audios/c.mp3',
        '../images/audios/d.mp3',
        '../images/audios/e.mp3',
        '../images/audios/f.mp3',
        '../images/audios/g.mp3',
        '../images/audios/h.mp3',
        '../images/audios/i.mp3',
        '../images/audios/j.mp3',
        '../images/audios/k.mp3',
        '../images/audios/l.mp3',
        '../images/audios/m.mp3',
        '../images/audios/n.mp3',
        '../images/audios/o.mp3',
        '../images/audios/p.mp3',
        '../images/audios/q.mp3',
        '../images/audios/r.mp3',
        '../images/audios/s.mp3',
        '../images/audios/t.mp3',
        '../images/audios/u.mp3',
        '../images/audios/v.mp3',
        '../images/audios/w.mp3',
        '../images/audios/x.mp3',
        '../images/audios/y.mp3',
        '../images/audios/z.mp3'
    ];

    $audios_json = json_encode($audioFile);
    $alphabets_json = json_encode($alphabets);
    $images_json = json_encode($images);

    // Function to generate alphabet cards
    function alphabetCard($alphabets, $images) {
        foreach ($alphabets as $index => $letter) {
            // Assign class 'active' to the first card to make it visible initially
            $activeClass = $index === 0 ? 'active' : 'hidden';
            
            // Get the corresponding image for this index
            $image = isset($images[$index]) ? $images[$index] : ''; // Use default image if not found
            
            // Echo the HTML structure for each alphabet card
            echo "<div class='alphabet-card $activeClass' id='card-$index' style='background-image: url($image); background-size: cover; background-position: center;'>
                     
                </div>";
        }
    }
?>

    <style>
        .alphabet-card {
            min-width: 400px;
            height: 500px;
            /* background-color: #007bff;  */
            /* color: white; */
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 3em;
            position: absolute;
            top: 0;
            transition: all 0.5s ease; /* Smooth transition */
            border-radius: 10px;
            top: 23%; /* Move the element halfway down */
            left: 34%; /* Move the element halfway across */
        }

        .alphabet-card.hidden {
            opacity: 0;
            transform: translateX(50px); /* Slide right */
            position: absolute;
        }

        .alphabet-card.active {
            opacity: 1;
            transform: translateX(0); /* Slide into place */
        }

        /* .hidden {
            display: none;
        }
        .active {
            display: block;
        } */

        .p{
            height:100%;
            weight:100%;
        }
        .n{
            height:100%;
        }
         button{
            text-align: center;
            margin: 0px 0px;
        }

        .p button,.n button {
            padding: 10px 20px;
            /* margin: 280px 10px; */
            
            font-size: 1em;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;            
        }
    </style>
    <body style="background-image:url(../images/picture/learnbg.jpg);background-size: contain;">

    <!-- Slide Container -->
    <div class="container-fluid">
        
        <div class="row align-items-center">
            <div class="col p d-flex justify-content-center align-items-center" style="height: 100vh;margin-right:5s0px;">
                <button class="prev" id="prev-slide"><i class="fa-solid fa-chevron-left"></i></button>
            </div>
            <div class="col d-flex justify-content-center align-items-center" style="height: 100vh;margin-right:0px;">
                <?php
                   alphabetCard($alphabets, $images);
                ?>
            </div> 
            <div class="col n d-flex justify-content-center align-items-center" style="height: 100vh;margin-right:50px;">
                <button class="next" id="next-slide"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>
        <div>
            
        </div>

        <audio id="slide-audio" hidden></audio>

        <?php include_once("../layouts/footer.php"); ?>
        
    </div>  
       

    <script>
        // JavaScript to handle slides and audio
        const audios = <?php echo $audios_json; ?>;
        const alphabets = <?php echo $alphabets_json; ?>;
        const images = <?php echo $images_json; ?>;
        let currentIndex = 0;

        // Get all card elements
        const cards = document.querySelectorAll('.alphabet-card');
        const audioElement = document.getElementById('slide-audio');

        // Function to load the current slide (card and audio)
        function loadSlide(index) {
            // Hide all cards first
            cards.forEach(card => card.classList.add('hidden'));

            // Show the current card
            const currentCard = document.getElementById('card-' + index);
            if (currentCard) {
                currentCard.classList.remove('hidden');
            }

            // Update the audio source
            audioElement.src = audios[index];
            audioElement.play(); // Autoplay the audio when slide changes
        }

        // Load the initial slide
        loadSlide(currentIndex);

        // Next button functionality
        document.getElementById('next-slide').addEventListener('click', function() {
            currentIndex=(currentIndex+1)%alphabets.length;
            loadSlide(currentIndex);

           // if (currentIndex < cards.length - 1) {
              //  currentIndex++;
              //  loadSlide(currentIndex);
            //}
        });

        // Previous button functionality
        document.getElementById('prev-slide').addEventListener('click', function() {
            currentIndex=(currentIndex-1+alphabets.length)%alphabets.length;
            loadSlide(currentIndex);
            
            //if (currentIndex > 0) {
               // currentIndex--;
               // loadSlide(currentIndex);
            //}
        });
    </script> 
   
</body>




    
