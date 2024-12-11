<?php
include_once("../layouts/navbar.php");
include_once("../models/book.php");
include_once("../controllers/BookController.php");

$role = "";
if (!empty($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];
}
$bookController = new BookController();
$books = $bookController->getAllBook();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse:E-Book</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body style="background:whitesmoke">
    <div class="container mt-3">
        <div class="row g-4">
            <?php
            foreach ($books as $book) {
                echo '<div class="col-md-3 col-sm-6 mb-3">
                <div class="card video-card shadow-sm" style="height: 100%;width:100%; display: flex; flex-direction: column; flex-grow: 1; border-radius: 15px; overflow: hidden;">
                    <img  src="../bookStore/images/'.$book['image'].'"controls style="width: 100%; height:250px; object-fit: cover; border-radius: 15px 15px 0 0;">
                <div class="card-body" style="flex-grow: 1;">
                 <a href="book_detail.php?id='.$book['id'].'" class="text-decoration-none text-dark text-center" >   <strong class="card-title">' . $book['title'] . '</strong>  </a>';
                   
                echo '</div>
        </div>
    </div>';
            }
    ?>

        </div>
    </div>

    <?php
    include_once("../layouts/footer.php");
    ?>
</body>
</html>