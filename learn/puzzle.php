<?php
include_once("../layouts/navbar.php");

    if(isset($_POST['submit'])){
        //retrieve the pieces placed in each zone
        $zone1Piece=$_POST['zone1Piece'];
        $zone2Piece=$_POST['zone2Piece'];
        $zone3Piece=$_POST['zone3Piece'];
        $zone4Piece=$_POST['zone4Piece'];

        //define the correct positions for the pieces
        $correctAnswers=[
            'zone1Piece'=>'piece1',
            'zone2Piece'=>'piece2',
            'zone3Piece'=>'piece3',
            'zone4Piece'=>'piece4',
        ];

        //check the user's answer
        $results=[];
        foreach($correctAnswers as $zone=>$correctPiece){
            if($$zone===$correctPiece){
                $results[$zone]="Correct";
            }else{
                $results[$zone]="Incorrect";
            }
        }

        //display the results
        echo "<div class='m-5'>";
        echo "<h3>Results:</h3>";
        echo "<p>Zone 1: {$results['zone1Piece']}</p>";
        echo "<p>Zone 2: {$results['zone2Piece']}</p>";
        echo "<p>Zone 3: {$results['zone3Piece']}</p>";
        echo "<p>Zone 4: {$results['zone4Piece']}</p>";

        //provide a link to retry the puzzle
        echo "<a href='puzzle.php'>Try Again</a>";
        echo  "</div>";
    }

?>

    <style>
        .puzzle-container{
            width:200px;
            height:200px;
            position:relative;
            border: 2px solid #000;
        }
        .puzzle-piece{
            width:100px;
            height:100px;
            position:absolute;
            border:1px solid #000;
            cursor:pointer;
        }
        .drop-zone{
            width:100px;
            height:100px;
            position:absolute;
            border:none;
        }
        .drop-zone.correct{
            border-color:green;
        }
        #piece1{background-color:#ff5733;}
        #piece2{background-color:#33ff57;}
        #piece3{background-color:#3357ff;}
        #piece4{background-color:#ffc300;}
    </style>

<h2 class="m-5">Fit the pieces to complete the picture of a tree.</h2>
<div class="container">
    <div class="puzzle-container">
        <!-- drop zones for the puzzle -->
        <div class="row">
            <div class="col-md-6">
                <div class="drop-zone" id="zone1" style="top: 0;left:0;border-bottom:2px dashed #999;border-right:2px dashed #999;"></div>
                <div class="drop-zone" id="zone2" style="top:0;left:100px;border-bottom:2px dashed #999;"></div>
                <div class="drop-zone" id="zone3" style="top:100px;left:0;border-right:2px dashed #999;"></div>
                <div class="drop-zone" id="zone4" style="top:100px; left:100px;"></div> 
            </div>
            <div class="col-md-6">
                <div class="puzzle-piece" id="piece1" draggable="true" style="top:100px;left:400px;"></div>
                <div class="puzzle-piece" id="piece2" draggable="true" style="top:100px;left:500px;"></div>
                <div class="puzzle-piece" id="piece3" draggable="true" style="top:100px;left:600px;"></div>
                <div class="puzzle-piece" id="piece4" draggable="true" style="top:100px;left:700px;"></div>
            </div> 
        </div>
        <!-- puzzle pieces to drag -->        

    </div>

    
            <form action="" method="post" id="puzzleForm">
                <input type="hidden" id="zone1Piece" name="zone1Piece" value="">
                <input type="hidden" id="zone2Piece" name="zone2Piece" value="">
                <input type="hidden" id="zone3Piece" name="zone3Piece" value="">
                <input type="hidden" id="zone4Piece" name="zone4Piece" value="">
                <br>
                <button class="btn btn-primary mb-5 mt-5" name="submit">Submit</button>
            </form>
    
</div>

    <script>
        //handle drag and drop
        document.querySelectorAll('.puzzle-piece').forEach(piece =>{
            piece.addEventListener('dragstart',function(e){
                e.dataTransfer.setData("text",e.target.id);
            });
        });

        document.querySelectorAll('.drop-zone').forEach(zone=>{
            zone.addEventListener('dragover',function(e){
                e.preventDefault();
            });
            zone.addEventListener('drop',function(e){
                e.preventDefault();
                let pieceId=e.dataTransfer.getData("text");
                let piece=document.getElementById(pieceId);
                this.appendChild(piece);// move piece to drop zone
                piece.style.top='0';//align piece inside the zone
                piece.style.left='0';//align piece inside the zone

                //upload hidden input values for from submission
                document.getElementById(this.id+"Piece").value=pieceId;
            });
        });
    </script>
    <?php
    include_once("../layouts/footer.php");
    ?>
