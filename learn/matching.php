<?php
include_once("../layouts/navbar.php");
    if(isset($_POST['submit'])){
        //define the correct matches
        $correctMatches=[
            'lion'=>'forest',
            'fish'=>'ocean',
            'eagle'=>'sky'
        ];

        //get user submitted matches from the form
        $userMatches=[
            'lion'=>$_POST['lion'],
            'fish'=>$_POST['fish'],
            'eagle'=>$_POST['eagle']
        ];

        //check the user's answers
        $results=[];
        foreach($correctMatches as $animal => $correctHabbitat){
            if($userMatches[$animal]===$correctHabbitat){
                $results[$animal]="Correct";
            }else{
                $results[$animal]="Incorrect";
            }
        }
        //display the results
        echo "<div class='m-5'>";
        echo "<h3>Results: </h3>";
        echo "<p> Lion : {$results['lion']}(Correct habitat :Forest)</p>";
        echo "<p> Fish : {$results['fish']}(Correct habitat :Ocean)</p>";
        echo "<p> Eagle : {$results['eagle']}(Correct habitat :Sky)</p>";

        //provide a link to retake the quizz
        echo '<a href="matching.php" >Try Again</a>';
        echo "</div>";
       
    }

?>

<style>
    .container{
        display:flex;
        justify-content:space-around;
    }
    .list{
        width:400px;
        padding:10px;
        border:1px solid #ccc;
        min-height:200px;
    }
    .draggable{
        margin:10px;
        padding:10px;
        background-image:lightblue;
        cursor:grab;
        min-height:200px;
        min-width:200px;
        background-size: 350px;
        background-repeat: no-repeat;
    }
    .dropzone{
        margin:10px;
        padding:10px;
        min-height:200px;
        min-width:200px;
        background-size: 350px;
        background-repeat: no-repeat;
    }
</style>
<body>
    <h2 class="m-5">Match the Aniamls with Their Habitats</h2>
    <div class="container">
        <div class="list m-3">
            <div id="drag-lion" class="draggable" draggable="true" style="background-image:url(../images/matching/Lion_King.jpg);"></div>
            <div id="drag-fish" class="draggable" draggable="true" style="background-image:url(../images/matching/fish.jpg);"></div>
            <div id="drag-eagle" class="draggable" draggable="true" style="background-image:url(../images/matching/eagle.jpg);"></div>
        </div>

        <div class="list m-3">
            <div id="sky" class="dropzone" style="background-image:url(../images/matching/sky.jpg);"></div>
            <div id="ocean" class="dropzone" style="background-image:url(../images/matching/Ocean.jpeg);"></div>        
            <div id="forest" class="dropzone" style="background-image:url(../images/matching/forest.png);"></div>
        </div>
    </div>

    <div class="container mb-4">
        <form action="" id="quizForm" method="post">
            <input type="hidden" id="lionValue" name="lion" value="">
            <input type="hidden" id="fishValue" name="fish" value="">
            <input type="hidden" id="eagleValue" name="eagle" value="">
            <br>
            <button class="btn btn-primary" name="submit">submit</button>
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
        })

        function dragStart(e){
            e.dataTransfer.setData('text/plain',e.target.id);
        }

        function dragOver(e){
            e.preventDefault();
        }

        function drop(e){
            e.preventDefault();
            const draggedId=e.dataTransfer.getData('text/plain');
            const draggedElement=document.getElementById(draggedId);
            e.target.appendChild(draggedElement);

            //update hidden inputs with drag and drop results
            if(draggedId==='drag-lion'){
                document.getElementById('lionValue').value=e.target.id;               
            }else if(draggedId==='drag-fish'){
                document.getElementById('fishValue').value=e.target.id;
            }else if(draggedId==='drag-eagle'){
                document.getElementById('eagleValue').value=e.target.id;
            }
        }

    </script> 
    <?php
     include_once("../layouts/footer.php");
    ?>
