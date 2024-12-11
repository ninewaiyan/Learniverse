<?php
session_start();
include_once '../includes/db.php';
include_once '../models/book.php'; // Ensure you have the Book model created
include_once '../controllers/BookController.php'; // Ensure you have the BookController created

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    
    header('location:../users/login.php');
  
}else{
    session_write_close();
}

include_once("../layouts/navbar.php");

$user_id =$_SESSION['user_id'];
$message = "";
$error = "";
$isError = false;
$title = "";
$description = "";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageName = $_FILES['book_image']['name'];
    $pdfName = $_FILES['book_pdf']['name'];
    $imageTmpFile = $_FILES["book_image"]["tmp_name"];
    $pdfTmpFile = $_FILES["book_pdf"]["tmp_name"];
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $pdfFileType = strtolower(pathinfo($pdfName, PATHINFO_EXTENSION));
    $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
    $allowedPdfTypes = ["pdf"];
   

    if ($_FILES['book_image']['error'] != 0 || $_FILES['book_pdf']['error'] != 0) {
        echo "Error File Upload !!";
    } else {
        // Check image file size
        if ($_FILES['book_image']['size'] < 10737418240 && $_FILES['book_pdf']['size'] < 10737418240) {
            // Validate image file type
            if (in_array($imageFileType, $allowedImageTypes) && in_array($pdfFileType, $allowedPdfTypes)) {
                // Generate unique names for files
                $updatedImageName = time() . '_' . $imageName;
                $updatedPdfName = time() . '_' . $pdfName;

                $bookController = new BookController();

                if ($user_id != null) {
                    // Assuming Upload method is defined in the BookController
                    $result = $bookController->createBook($title, $description, $updatedImageName, $updatedPdfName, $user_id);
                    if($result){
                        move_uploaded_file($imageTmpFile, '../bookStore/images/' . $updatedImageName);
                        move_uploaded_file($pdfTmpFile, '../bookStore/pdf/' . $updatedPdfName);
                        $message = "Book is successfully uploaded !!";
                    }else{
                    $error = "Upload Fail !!";
                    $isError = true;
                    }
                    
                } else {
                    $error = "Upload Fail !!";
                    $isError = true;
                }
            } else {
                $error = "The file type is not allowed !!";
                $isError = true;
            }
        } else {
            $error = "The size exceeds the limit, try again.";
            $isError = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse: Create Book</title>
</head>
<body style="background:white;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-4 text-center text-success">Book Upload</h1>
                <?php if ($isError): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if ($message != ''):  ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="title" class="form-label">Book Title</label>
                        <input type="text" name="title" id="title" class="form-control shadow-lg" value="<?php echo $isError ? $title : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Book Description</label>
                        <textarea name="description" id="description" class="form-control shadow-lg" required><?php echo $isError ? $description : '' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="book_image" class="form-label">Choose Book Image</label>
                        <input type="file" name="book_image" id="book_image" class="form-control shadow-lg" required>
                    </div>

                    <div class="mb-3">
                        <label for="book_pdf" class="form-label">Choose Book PDF</label>
                        <input type="file" name="book_pdf" id="book_pdf" class="form-control shadow-lg" required>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-success btn-lg w-100 mt-3 rounded-pill mt-3 shadow-lg" name="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include_once("../layouts/footer.php");
    ?>
</body>

</html>