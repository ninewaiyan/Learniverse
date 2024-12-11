<?php
session_start();

$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-lg">
        <div class="container">
            <a class="navbar-brand" href="../views/index.php">
                <img src="../images/logo.png" alt="Learniverse Logo"
                    style="width: 45px; height: 45px;"><strong>Learniverse</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item btn btn-success me-2 rounded-pill">
                        <a class="nav-link " href="../views/learn_index.php"><i class="fas fa-paint-brush"
                                style="color:#ffffff;"></i><strong class="text-white"> Learn </strong></a>
                    </li>
                    <li class="nav-item btn btn-danger me-2 rounded-pill">
                        <a class="nav-link" href="<?php echo $isLoggedIn ? '../views/game_index.php' : '../users/login.php'; ?>"><i class="fa-solid fa-gamepad"
                                style="color:#ffffff;"></i><strong class="text-white"> Games</strong></a>
                    </li>
                    <li class="nav-item btn btn-primary me-2 rounded-pill">
                        <a class="nav-link " href="../kidtubes/kidtube.php"><i class="fas fa-video" style="color:#ffffff;"></i><strong
                                class="text-white"> Kidtube </strong></a>
                    </li>
                    <li class="nav-item btn btn-warning me-2 rounded-pill">
                        <a class="nav-link " href="../books/ebook.php"><i class="fa-solid fa-book-open" style="color:#ffffff;"></i><strong class="text-white"> Books </strong></a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_fullname'])): ?>
                        <li class="nav-item btn btn-success me-2 rounded-pill">
                            <div class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    😀
                                    <strong class="text-white"><?php echo $_SESSION['user_fullname']; ?></strong>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="../users/profile.php"><i class="fa-solid fa-gear"></i> Your Account</a></li>
                                    <?php 
                                    if(isset($_SESSION['user_id'] ) && $_SESSION['user_role'] == 'admin')
                                    {
                                      echo '<li><a class="dropdown-item" href="../admin/adminpanel.php"><i class="fa-solid fa-globe"></i> Admin Portal</a></li>';

                                    }
                                    ?>
                                    <li><a class="dropdown-item" href="../users/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a></li>
                                </ul>
                            </div>

                        </li>
                    <?php else: ?>
                        <li class="nav-item btn btn-success me-2 rounded-pill">
                            <a class="nav-link" href="../users/login.php"><i class="fas fa-sign-in-alt"
                                    style="color:#ffffff;"></i><strong class="text-white"> Sign In </strong></a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item btn btn-info me-2 rounded-pill">
                        <!-- <a class="nav-link" href="#"><i class="fas fa-user-shield" style="color:#ffffff;"></i><strong
                                class="text-white"> Grown Ups </strong></a> -->
                        <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                            aria-controls="offcanvasRight"><i class="fas fa-user-shield"
                                style="color:#ffffff;"></i><strong class="text-white"> Grown Ups </strong>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Grown Ups</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">

            <form class="d-flex mb-3">
                <input class="form-control me-2 rounded-pill" type="search" placeholder="still developing..." aria-label="Search">
                <button class="btn btn-success rounded-circle" type="button"><i class="fas fa-search"></i></button>
            </form>

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../views/learn_index.php">Learning Areas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../records/recordTable.php">Play History</a>
                </li>
            </ul>

            <div class="menu-buttons mt-5 position-absolute bottom-0 start-50 translate-middle-x w-100">
                <a class="btn btn-primary w-100 mb-0 rounded-0" href="../feedbacks/create_feedback.php"><i class="fa-solid fa-message"></i> Feedback Us</a>
                <a class="btn btn-secondary w-100 mb-0 rounded-0" href="../users/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign Out </i></a>
            </div>
        </div>
    </div>

    