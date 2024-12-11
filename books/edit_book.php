<?php
session_start();
include_once("../includes/db.php");
include_once("../controllers/BookController.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('location:../users/login.php');
}
$bookController = new BookController();


if (isset($_GET['mode']) && $_GET['mode']=="DEL") {

    $del_id = $_GET['id'];

    $result = $bookController->deleteBook($del_id);

    if ($result) {
       header("location:ebook.php?");
    } else {
       header("location:ebook.php?del=fail");
    }
}


    if (isset($_POST['mode']) && $_POST['mode']=="EDIT") {

        $edit_id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $isEdit = $bookController->updateBook($edit_id, $title, $description);
        if ($isEdit) {
            header("location:ebook.php?mode=$isEdit");
        } else {
            header("location:ebook.php?edit=fail");
        }
    }

