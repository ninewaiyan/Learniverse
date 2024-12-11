<?php
include_once("../layouts/navbar.php");

$level1Passed = false; // Variable to track if Level 1 is passed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the user's color choices
    $appleColor = $_POST['appleColor'];
    $broccoliColor = $_POST['broccoliColor'];
    $bananaColor = $_POST['bananaColor'];
    $carrotColor = $_POST['carrotColor'];

    // Define the correct colors for the first level
    $correctAnswers = [
        'appleColor' => 'red',
        'broccoliColor' => 'green',
        'bananaColor' => 'yellow',
        'carrotColor' => 'red'
    ];

    // Check the user's answers
    $results = [];
    $level1Passed = true; // Assume Level 1 is passed unless proven otherwise
    foreach ($correctAnswers as $object => $correctColor) {
        if ($$object !== $correctColor) {
            $results[$object] = "Incorrect";
            $level1Passed = false; // Mark Level 1 as not passed if any answer is incorrect
        } else {
            $results[$object] = "Correct";
        }
    }

    // Display the results for the current level
    echo "<div class='container mt-5'>";
    echo "<h3>Level 1 Results:</h3>";
    echo "<p>Apple: {$results['appleColor']} (Correct color: Red)</p>";
    echo "<p>Broccoli: {$results['broccoliColor']} (Correct color: Green)</p>";
    echo "<p>Banana: {$results['bananaColor']} (Correct color: Yellow)</p>";
    echo "<p>Carrot: {$results['carrotColor']} (Correct color: Red)</p>";

    if ($level1Passed) {
        echo "<br><a href='#level2' class='btn btn-success'>Proceed to Level 2</a>";
    } else {
        echo "<br><a href='#level1' class='btn btn-danger'>Try Level 1 Again</a>";
    }
    echo "</div>";
}

?>

<!-- Bootstrap Styling -->
<div class="container mt-5">
    <h2 id="level1">Level 1: Color the Fruits Red and Vegetables Green</h2>

    <!-- Color palette (using Bootstrap classes) -->
    <div class="d-flex justify-content-center mb-4">
        <div id="red" class="rounded-circle bg-danger" style="width: 60px; height: 60px; cursor: pointer;"></div>
        <div id="green" class="rounded-circle bg-success" style="width: 60px; height: 60px; cursor: pointer; margin-left: 10px;"></div>
        <div id="yellow" class="rounded-circle bg-warning" style="width: 60px; height: 60px; cursor: pointer; margin-left: 10px;"></div>
        <div id="blue" class="rounded-circle bg-primary" style="width: 60px; height: 60px; cursor: pointer; margin-left: 10px;"></div>
    </div>

    <!-- Objects to be colored (fruits and vegetables) -->
    <div class="row justify-content-center">
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="apple" style="height: 120px; line-height: 120px;">Apple</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="broccoli" style="height: 120px; line-height: 120px;">Broccoli</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="banana" style="height: 120px; line-height: 120px;">Banana</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="carrot" style="height: 120px; line-height: 120px;">Carrot</div>
        </div>
    </div>

    <!-- Form to submit answers -->
    <form action="" method="POST" class="mt-4">
        <input type="hidden" id="appleColor" name="appleColor" value="">
        <input type="hidden" id="broccoliColor" name="broccoliColor" value="">
        <input type="hidden" id="bananaColor" name="bananaColor" value="">
        <input type="hidden" id="carrotColor" name="carrotColor" value="">
        <button type="submit" class="btn btn-success">Submit Level 1</button>
    </form>
</div>

<!-- Level 2 -->
<?php if ($level1Passed): ?>
<div id="level2" class="container mt-5">
    <h2>Level 2: Color the Fruits Blue and Vegetables Yellow</h2>

    <!-- Color palette (using Bootstrap classes) -->
    <div class="d-flex justify-content-center mb-4">
        <div id="blue" class="rounded-circle bg-primary" style="width: 60px; height: 60px; cursor: pointer;"></div>
        <div id="yellow" class="rounded-circle bg-warning" style="width: 60px; height: 60px; cursor: pointer; margin-left: 10px;"></div>
    </div>

    <!-- Objects to be colored (fruits and vegetables) -->
    <div class="row justify-content-center">
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="apple2" style="height: 120px; line-height: 120px;">Apple</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="broccoli2" style="height: 120px; line-height: 120px;">Broccoli</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="banana2" style="height: 120px; line-height: 120px;">Banana</div>
        </div>
        <div class="col-2 text-center">
            <div class="border rounded p-3" id="carrot2" style="height: 120px; line-height: 120px;">Carrot</div>
        </div>
    </div>

    <!-- Form to submit answers -->
    <form action="" method="POST" class="mt-4">
        <input type="hidden" id="appleColor2" name="appleColor" value="">
        <input type="hidden" id="broccoliColor2" name="broccoliColor" value="">
        <input type="hidden" id="bananaColor2" name="bananaColor" value="">
        <input type="hidden" id="carrotColor2" name="carrotColor" value="">
        <button type="submit" class="btn btn-warning">Submit Level 2</button>
    </form>
</div>
<?php endif; ?>

<!-- JavaScript for selecting and coloring objects -->
<script>
    let selectedColor = '';  // Variable to store the selected color

    // Set color on clicking the palette
    document.querySelector('#red').addEventListener('click', function () {
        selectedColor = 'red';
    });

    document.querySelector('#green').addEventListener('click', function () {
        selectedColor = 'green';
    });

    document.querySelector('#blue').addEventListener('click', function () {
        selectedColor = 'blue';
    });

    document.querySelector('#yellow').addEventListener('click', function () {
        selectedColor = 'yellow';
    });

    // Assign color to objects when clicked (Level 1)
    document.querySelectorAll('.border').forEach(function (object) {
        object.addEventListener('click', function () {
            if (selectedColor) {
                object.style.backgroundColor = selectedColor;
                document.getElementById(object.id + "Color").value = selectedColor;
            }
        });
    });

    // Assign color to objects when clicked (Level 2)
    document.querySelectorAll('.border').forEach(function (object) {
        object.addEventListener('click', function () {
            if (selectedColor) {
                object.style.backgroundColor = selectedColor;
                document.getElementById(object.id + "Color2").value = selectedColor;
            }
        });
    });
</script>

<?php
include_once("../layouts/footer.php");
?>
