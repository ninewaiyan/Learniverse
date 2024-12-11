<?php
include_once("../layouts/navbar.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswer = [
        'head' => 'Head',
        'arm' => 'Arm',
        'leg' => 'Leg'
    ];

    // Get user's answers from the form
    $userAnswers = [
        'head' => $_POST['head'],
        'arm' => $_POST['arm'],
        'leg' => $_POST['leg']
    ];

    // Check answers
    $results = [];
    foreach ($correctAnswer as $key => $value) {
        if ($userAnswers[$key] == $value) {
            $results[$key] = "correct";
        } else {
            $results[$key] = "incorrect";
        }
    }

    // Output results after processing the loop
    echo "<div class='m-5'>";
    echo "<h3>Result:</h3>";
    echo "<p>Head: {$results['head']}</p>";
    echo "<p>Arm: {$results['arm']}</p>";
    echo "<p>Leg: {$results['leg']}</p>";

    // Provide a link to retake the quiz
    echo '<a href="draganddrop.php">Try Again</a>';
    echo "</div>";
}

?>

    <style>
        .dropzone{
            width:150px;
            height:150px;
            border:2px dashed #ccc;
            margin : 20px;
            padding:10px;
            text-align:center;
        }
        .draggable{
            width:100px;
            heght:50px;
            background-color:(lightblue);
            text-align:center;
            padding:10px;
        }
        .container{
            display:flex;
            justify-content:space-around;           
        }
    </style>

    <h2 class="m-5">Drag the body part name to the correct location</h2>
    <!-- humam body image-->
    <div class="container">
        <div id="head" class="dropzone">Head Area</div>
        <div id="arm" class="dropzone">Arm Area</div>
        <div id="leg" class="dropzone">Leg Area</div>
    </div>

    <!-- Draggable words -->
    <div class="container">
        <div id="drag-head" class="draggable" draggable="true">Head</div>
        <div id="drag-arm" class="draggable" draggable="true">Arm</div>
        <div id="drag-leg" class="draggable" draggable="true">Leg</div>
    </div>

    <div class="container">
        <form id="quizform" action="" method="POST">
            <input type="hidden" id="headValue" name="head" value="">
            <input type="hidden" id="armValue" name="arm" value="">
            <input type="hidden" id="legValue" name="leg" value="">
            <br>
            <button class="btn btn-primary mb-5" type="submit">Submit</button>
        </form>
    </div>

    <script>
        //drag and drop functionality
        const draggables=document.querySelectorAll('.draggable');
        const dropzones=document.querySelectorAll('.dropzone');

        draggables.forEach(draggable=>{
            draggable.addEventListener('dragstart',dragStart);
        });

        dropzones.forEach(dropzone=>{
            dropzone.addEventListener('dragover',dragOver);
            dropzone.addEventListener('drop',drop);
        });

        //drag start event
        function dragStart(e){
            e.dataTransfer.setData('text/plain',e.target.id);
        }

        //allow drop event (prevent default behavior)
        function dragOver(e){
            e.preventDefault();
        }

        //drop event
        function drop(e){
            e.preventDefault();
            const draggedId=e.dataTransfer.getData('text/plain');
            const draggedElement=document.getElementById(draggedId);
            e.target.appendChild(draggedElement);

            //update hidden inputs with drag-and drop results
            if(e.target.id==="head"){
                document.getElementById('headValue').value=draggedElement.textContent;
            }else if(e.target.id==="arm"){
                document.getElementById('armValue').value=draggedElement.textContent;
            }else if(e.target.id==="leg"){
                document.getElementById('legValue').value=draggedElement.textContent;
            }
        }

    </script> 
    <?php
        include_once("../layouts/footer.php");
    ?>
