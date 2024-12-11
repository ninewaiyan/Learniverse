<?php
include_once("../layouts/navbar.php");

if(isset($_POST['submit'])){
    $userAnswer=$_POST['answer'];

    //correct answer for this question
    $correctAnswer="true";

    //check if the user's answer is correct
    if($userAnswer==$correctAnswer){
        echo "<h3>Correct!".$a."</h3>";
    }else{
        echo "<h3>Incorrect, The correct answer is True.".$a."</h3>";
    }
    echo "<a href='trueorfalse.php'>Try Again</a>";
}

?>

<div class="container m-5">
<h2>True or False</h2>

<form action="" method="post">
    <p>###</p>
    <label for="">
        <input type="radio" name="answer" value="true" required> True
    </label><br>

    <label for="">
        <input type="radio" name="answer" value="false" required> False
    </label><br>

    <button class="btn btn-primary mt-4" name="submit">Submit</button>
</form>
</div>
    <?php
    include_once("../layouts/footer.php");
    ?>
