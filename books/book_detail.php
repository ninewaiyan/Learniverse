<?php
include_once("../layouts/navbar.php");
include_once("../models/book.php");
include_once("../controllers/BookController.php");

$role = "";
$book;
if (!empty($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];
}
$bookController = new BookController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $book = $bookController->getBookbyId($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .product-image {
            position: relative;
            width: auto;
            height: auto;
            overflow: hidden;
        }

        .product-image img {
            width: 50%;
            height: 50%;
            object-fit: cover;
        }

        .product-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50%;
            padding: 20px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            text-align: center;
        }

        .product-description {
            padding: 20px;
        }

        .btn-group {
            margin-top: 10px;
        }

        .dropdown-menu-end {
            right: 0;
            left: auto;
        }

        .dropdown-menu {
            border-radius: 10px;
            padding: 0;
        }

        .dropdown-item {
            padding: 10px 15px;
            border-radius: 10px;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .dropdown-toggle::after {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <!-- Image and Name/Price -->
            <div class="col-md-6">
                <div class="product-image">
                    <img src="../bookStore/images/<?php echo $book['image'] ?>" alt="Product Image">
                    <div class="product-info">
                        <a class="btn text-info btn-outline-primary" href="../bookStore/pdf/<?php echo $book['file'] ?>"
                            target="_blank">
                            <h4 class="mb-1">Download</h4>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Description and Actions -->
            <div class="col-md-6">
                <div class="product-description">
                    <h3><?php echo $book['title'] ?></h3>
                    <h5>Description</h5>
                    <p><?php echo $book['description'] ?></p>

                    <?php if ($role == 'admin'): ?>
                        <button class="btn btn-danger rounded-pill float-end mx-2" id="deleteBtn">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>

                        <button class="btn btn-primary rounded-pill float-end" id="editBtn">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once("../layouts/footer.php");
    ?>

    <script>

        document.getElementById('deleteBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Confirm Delete',
                text: "Are you sure you want to delete this book?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        window.location.href = 'edit_book.php?id=<?php echo $book['id']; ?>&mode=DEL';
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your file is safe :)",
                        icon: "error"
                    });
                }
            });
        });


        document.getElementById('editBtn').addEventListener('click', function () {
            Swal.fire({
                title: 'Edit Book',
                html: `
                    <input type="text" id="editTitle" class="swal2-input w-100" placeholder="Title" value="<?php echo $book['title']; ?>">
                    <textarea id="editDescription" class="swal2-textarea w-100" placeholder="Description" style="height: 150px;"><?php echo $book['description']; ?></textarea>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    const title = document.getElementById('editTitle').value;
                    const description = document.getElementById('editDescription').value;
                    if (!title || !description) {
                        Swal.showValidationMessage(`Please enter both title and description`);
                    }
                    return { title: title, description: description };
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    const formData = new FormData();
                    formData.append('id', '<?php echo $book['id']; ?>');
                    formData.append('mode', 'EDIT');
                    formData.append('title', result.value.title);
                    formData.append('description', result.value.description);

                    fetch('edit_book.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.text())
                        .then(data => {

                            Swal.fire('Success', 'The book has been updated!', 'success').then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error', 'There was an error updating the book.', 'error');
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Changes are not saved :)",
                        icon: "info"
                    });
                }
            });
        });
    </script>
</body>

</html>