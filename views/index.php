<?php
include_once("../layouts/navbar.php");
include_once("../controllers/VideoController.php");

$videoController = new VideoController();
$videos = $videoController->getAllVideo();

$isLoggedIn = isset($_SESSION['user_id']);
?>

<div class="container mt-5">
    <div class="row align-items-stretch">
        <div class="col-lg-8 d-flex flex-column justify-content-between h-100">
            <div class="hero-section mb-3 mt-4">
                <h1>Welcome to Learniverse!</h1>
                <p>Explore the universe of learning through fun games, exciting videos, and creative art!</p>
                <a href="learn_index.php" class="btn btn-danger rounded-pill">
                    Start Learning <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div id="heroCarousel" class="carousel mt-4 mb-3 h-100">
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <video id="video1" class="d-block w-100 h-100" autoplay loop muted playsinline>
                            <source src="../videos/abcCounting2.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <button onclick="toggleMute('video1')" class="btn btn-dark volume-btn">🔇</button>
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-dark">Alphabet Learning</h3>
                            <p class="text-dark">Learn the alphabet with fun color.</p>
                            <a href="../alphabet/capitalLetter.php" class="btn btn-success rounded-pill">
                                Start Learning <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <video id="video2" class="d-block w-100 h-100" autoplay loop muted playsinline>
                            <source src="../videos/123Counting.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <button onclick="toggleMute('video2')" class="btn btn-dark volume-btn">🔇</button>
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-white">Number Counting Space</h3>
                            <p class="text-white">Counting numbers through fun learning experiences.</p>
                            <a href="../number/numberLearn.php" class="btn btn-warning rounded-pill">
                                Start Learning <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon btn btn-danger" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon btn btn-danger" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>

        <div class="col-lg-4 d-flex flex-column justify-content-between h-100">
            <div class="card mb-3">
                <img src="../images/abc.gif" class="card-img-top" alt="ABC Learning">
                <div class="card-body">
                    <h5 class="card-title">Alphabet Learning</h5>
                    <p class="card-text">Learn the alphabet with fun color.</p>
                    <a href="../alphabet/capitalLetter.php" class="btn btn-danger rounded-pill w-100">
                        Start Learning <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="card">
                <img src="../images/vocab.gif" class="card-img-top" alt="Space Exploration">
                <div class="card-body">
                    <h5 class="card-title">Vocabulary Adventure</h5>
                    <p class="card-text">Discover new words with us.</p>
                    <a href="../vocabulary/vocabularyLearn.php" class="btn btn-success rounded-pill w-100">
                        Start Learning <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="games" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Choose Your Game</h2>
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="card h-100 w-100">
                    <img src="../images/snakeLogo.gif" class="card-img-top" alt="Snake Game">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Snake Game</h5>
                        <p class="card-text">Navigate your snake to eat and grow longer. Avoid running into yourself!
                        </p>
                        <a href="<?php echo $isLoggedIn ? '../games/snake.php' : '../users/login.php'; ?>"
                            class="btn btn-danger mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card h-100 w-100">
                    <img src="../images/matchLogo.gif" class="card-img-top" alt="Math Challenge">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Matching</h5>
                        <p class="card-text">Engage in exciting photo and letter matching activities to enhance your
                            cognitive skills!</p>
                        <a href="<?php echo $isLoggedIn ? '../games/matching.php' : '../users/login.php'; ?>"
                            class="btn btn-success mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card h-100 w-100">
                    <img src="../images/tic-tac-toe-Logo.gif" class="card-img-top" alt="Word Match">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Tic-Tac-Toe</h5>
                        <p class="card-text">Find and match words in this exciting game.</p>
                        <a href="<?php echo $isLoggedIn ? '../games/tic-tac-toe.php' : '../users/login.php'; ?>"
                            class="btn btn-warning mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-dark mt-5 col-sm-12 rounded-pill" onclick="window.location.href='../views/game_index.php'">More games <i class="fa-solid fa-angles-right"></i></button>
    </div>
</section>


<?php
include_once("../layouts/footer.php");
?>

<script>
    function toggleMute(videoId) {
        const video = document.getElementById(videoId);
        video.muted = !video.muted;

        const btn = video.parentNode.querySelector(".volume-btn");
        btn.textContent = video.muted ? '🔇' : '🔊';
    }

    const heroCarousel = document.getElementById('heroCarousel');
    heroCarousel.addEventListener('slid.bs.carousel', function () {
        document.querySelectorAll('video').forEach(video => {
            video.currentTime = 0;
            video.pause();
        });

        const activeVideo = heroCarousel.querySelector('.carousel-item.active video');
        if (activeVideo) {
            activeVideo.play();
        }
    });
</script>

<style>
    .volume-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
        border-radius: 50%;
        padding: 5px;
    }
</style>