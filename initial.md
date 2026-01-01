<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz app</title>
</head>
<body>
    <h2>Quiz Game</h2>
    <div class = "quiz-container">
        <p> Q. What is the largest mammal?</p>
        <form method="POST">
            <button type="submit" name ="answer" value="Elephant"> Elephant </button>
            <button type="submit" name ="answer" value="Hippopotamus"> Hippopotamus </button>
            <button type="submit" name ="answer" value="Blue Whale"> Blue Whale </button>
            <button type="submit" name ="answer" value="Giraffe"> Giraffe </button>
        </form>
        <?php 
        if(isset($_POST['answer'])) {
            $correct = "Blue Whale";

            if($_POST['answer'] == $correct) {
                echo "<p>CORRECT</p>";
            } else {
                echo "<p>WRONG ANSWER</p>";
            }
        }
        ?> 
    </div>

</body>
</html>