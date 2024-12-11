<?php
include_once("../layouts/navbar.php");
include_once("../controllers/VideoController.php");

$role = "";
if (!empty($_SESSION['user_role'])) {
    $role = $_SESSION['user_role'];
}
$videoController = new VideoController();
$videos = $videoController->getAllVideo();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learniverse: Kidtube</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="background:whitesmoke">

    <div class="container mt-5">
        <div class="row g-4">
            <?php
            foreach ($videos as $video) {
                echo '<div class="col-md-4 col-sm-6 mb-3">
                <div class="card video-card shadow-sm" style="height: 100%; display: flex; flex-direction: column; flex-grow: 1; border-radius: 15px; overflow: hidden;">
                    <video controls style="width: 100%; height: 200px; object-fit: cover; border-radius: 15px 15px 0 0;">
                        <source src="../videos/' . $video['url'] . '" type="">
                        Your browser does not support the video tag.
                    </video>
                <div class="card-body" style="flex-grow: 1;">
                    <strong class="card-title">' . $video['title'] . '</strong>';
                if ($role == 'user') {
                    echo '<p class="btn btn-warning rounded-circle float-end md-3">
                        <i class="fa-solid fa-video fa-sm" style="color: #ffffff;"></i>
                    </p>';
                }
                if ($role == 'admin') {
                    echo '<button class="btn btn-danger rounded-pill float-end ms-2" 
                        onclick="confirmDelete(' . $video['id'] . ')">
                        <i class="fa-solid fa-trash-can"></i>
                      </button>
                      <button class="btn btn-primary rounded-pill float-end" 
                        onclick="openEditModal(' . $video['id'] . ', \'' . addslashes($video['title']) . '\')">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </button>';
                }
                echo '</div>
        </div>
    </div>';
            }
            ?>
        </div>
    </div>

    

    <script>
        function confirmDelete(videoId) {
            Swal.fire({
                title: 'Confirm Delete',
                text: "Are you sure you want to delete this video?",
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
                        window.location.href = "edit_video.php?id=" + videoId + "&mode=DEL";
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your file is safe :)",
                        icon: "error"
                    });
                }
            });
        }

        function openEditModal(videoId, title) {
            Swal.fire({
                title: 'Edit Video Title',
                input: 'text',
                inputValue: title,
                showCancelButton: true,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
                preConfirm: (newTitle) => {
                    if (!newTitle) {
                        Swal.showValidationMessage('You need to write something!');
                        return false;
                    }
                    return newTitle;
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'edit_video.php';
                    form.innerHTML = `
                <input type="hidden" name="id" value="${videoId}">
                <input type="hidden" name="mode" value="EDIT">
                <input type="hidden" name="title" value="${result.value}">
            `;
                    document.body.appendChild(form);
                    Swal.fire({
                        title: 'Success!',
                        text: 'Video title updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        form.submit();

                    })

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: "Cancelled",
                        text: "Changes are not saved :)",
                        icon: "info"
                    });
                }
            });
        }



    </script>

    <?php
    include_once("../layouts/footer.php");
    ?>
</body>

</html>