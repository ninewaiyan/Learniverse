<?php
include_once("../layouts/navbar.php");
    if(isset($_POST['submit'])){
        $userAnswer=$_POST['answer'];

        //define the correct answer
        $correctAnswer="dolphin";

        //check if the user's answer is correct
        if($userAnswer==$correctAnswer){
            echo "<h3>Correct! Dolphin is a mammal.</h3>";
        }else{
            echo "<h3>Incorrect. The correct answer is Dolphin,which is a mammal.</h3>";
        }

        //provide a link to retake the quiz
        echo "<a href='mcq.php'>Try Again</a>";
    }
?>

<div class="container m-5">
    <h2>Which of these is a mammal?</h2>

    <form action="" method="post">
        <label for="">
            <input type="radio" name="answer" value="shark" reuired> a) Shark
        </label><br>
        <label for="">
            <input type="radio" name="answer" value="dolphin" required> b) Dolphin
        </label><br>
        <label for="">
            <input type="radio" name="answer" value="penguin" required> c) Penguin
        </label><br>
        <label for="">
            <input type="radio" name="answer" value="turtle" required> d) Turtle
        </label><br>
        <button class="btn btn-primary mt-3" name="submit">Submit</button>
    </form>
</div>
    <?php
    include_once("../layouts/footer.php");
    ?>
