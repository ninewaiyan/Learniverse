<?php
include_once("../layouts/navbar.php");
    if(isset($_POST["submit"])){
        //rectangle the user's answer
        $userAnswer=$_POST["answer"];

        //the correct answer is "triangle"
        $correctAnswer="triangle";

        //check if the user's answer is correct
        if($userAnswer==$correctAnswer){
            echo "<h3>Correct! This is a triangle.</h3>";
        }else{
            echo "<h3>Incorrect. The correct answer is the triangle.</h3>";
        }

        //provide a link to retake the quiz
        echo "<a href='pictureQuizz.php'>Try Again</a>";
    }
?>

    <style>
        .container{
            display:flex;
            justify-content:space-around;
            margin-top:20px;
        }
        .option{
            text-align:center;
        }
        img{
            width:150px;
            height:150px;
            border:2px solid #ccc;
            border-radius:10px;
            cursor:pointer;
        }
        img:hover{
            border-color:#00f;
        }
    </style>

  
        <h2 class="m-5">Which picture shows a triangle?</h2>

        <form action="" method="post">
            <div class="container">
                <!-- image1(square) -->
                <div class="option">
                    <label>
                        <input type="radio" name="answer" value="square" required>
                        <img src="square.png" alt="Square">
                    </label>
                </div>

                <!-- image 2 (Triangle) -->
                <div class="option">
                    <label>
                        <input type="radio" name="answer" value="triangle" required>
                        <img src="triangle.png" alt="Triangle">
                    </label>
                </div>

                <!-- image 3(circle) -->
                <div class="option">
                    <label>
                        <input type="radio" name="answer" value="circle" required>
                        <img src="circle.png" alt="Circle">
                    </label>
                </div>

                <!-- image 4 (rectangle) -->
                    <div class="option">
                        <label>
                            <input type="radio" name="answer" value="rectangle" required>
                            <img src="rectangle.png" alt="Rectangle">
                        </label>
                    </div>
                    <br>
                    
                    <button class="btn btn-primary" name="submit">Submit</button>
                    
            </div>
        </form>
 
  <?php
  include_once("../layouts/footer.php");
  ?>
