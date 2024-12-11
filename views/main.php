<?php
include_once("../layouts/navbar.php");
include_once("../controllers/VideoController.php");

$videoController = new VideoController();
$videos = $videoController->getAllVideo();


?>

<div class="container mt-5">
    <div class="row align-items-start">
        <div class="col-lg-8 d-flex flex-column justify-content-between">
            <div class="hero-section mb-3">
                <h1>Welcome to Learniverse!</h1>
                <p>Explore the universe of learning through fun games, exciting videos, and creative art!</p>
                <a href="../users/login.php" class="btn btn-danger rounded-pill">
                    Start Learning <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div id="heroCarousel" class="carousel slide mt-3 mb-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../images/image1.jpg" class="d-block w-100" alt="Welcome to Learniverse">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-dark">Welcome to Learniverse</h3>
                            <p class="text-dark">Explore the universe of learning through fun games, exciting
                                videos, and creative art!</p>
                            <a href="#games" class="btn btn-success rounded-pill">
                                Start Learning <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../images/image2.jpg" class="d-block w-100" alt="Learning through Fun">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-dark">Learning through Fun!</h3>
                            <p class="text-dark">Engage in interactive games, exciting videos, and creative art
                                activities!</p>
                            <a href="#games" class="btn btn-danger rounded-pill">
                                Start Learning <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="../images/image1.jpg" class="d-block w-100" alt="Join Us in the Adventure">
                        <div class="carousel-caption d-none d-md-block">
                            <h3 class="text-dark">Join Us in the Adventure!</h3>
                            <p class="text-dark">Discover new worlds of knowledge through fun learning experiences.
                            </p>
                            <a href="#games" class="btn btn-warning rounded-pill">
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


        <div class="col-lg-4 d-flex flex-column justify-content-between">

            <div class="card mb-3" id="abc-card">
                <img src="../images/image1.jpg" class="card-img-top" alt="ABC Learning">
                <div class="card-body">
                    <h5 class="card-title">ABC Learning</h5>
                    <p class="card-text">Learn the alphabet with fun activities.</p>
                </div>
            </div>


            <div class="card" id="space-card">
                <img src="../images/image2.jpg" class="card-img-top" alt="Space Exploration">
                <div class="card-body">
                    <h5 class="card-title">Math Space Adventure</h5>
                    <p class="card-text">Discover the math and planets with us.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<section id="games" class="py-5 text-center">
    <h2 class="mb-4">Fun Learning Games</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4 d-flex">
                <div class="card">
                    <img src="../images/snake_cover.gif" class="card-img-top h-75" alt="Puzzle Game">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Snake Game</h5>
                        <p class="card-text">Challenge test to improve your vocabulary skills!</p>
                        <a href="../games/snake.php" class="btn btn-danger mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card">
                    <img src="../images/image2.jpg" class="card-img-top h-75" alt="Math Challenge">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Math Challenge</h5>
                        <p class="card-text">Practice math with fun challenges!</p>
                        <a href="#" class="btn btn-success mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex">
                <div class="card">
                    <img src="../images/image1.jpg" class="card-img-top h-75" alt="Word Search">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Word Match</h5>
                        <p class="card-text">Find words in this exciting game!</p>
                        <a href="#" class="btn btn-warning mt-auto rounded-pill">Play Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <div class="container">

<div class="row">


        <?php 
            foreach($videos as $video){

            echo'<div class="col-md-3 col-sm-6 mb-4">
                <div class="card video-card">
                <video class=" " controls>
					<source
					src="../videos/'.$video['url'].'"
					type="">
					Your browser does not support the video tag.
                </video>
                    <div class="card-body">
                        <h5 class="card-title">'.$video['title'].'</h5>
                    </div>
                </div>
            </div>';
            }
            

            ?>
    </div>
</div>
     -->






<?php
include_once("../layouts/footer.php");
?>


