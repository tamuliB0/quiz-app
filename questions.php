<?php
require_once 'config.php';

if(!isset($_SESSION['current_question'])) {
    header('Location: index.php');
    exit;
}

$currentQuestion = $_SESSION['current_question'];

$stmt = $pdo->query('SELECT COUNT(*) FROM questions');
$totalQuestions = $stmt->fetchColumn();

if($currentQuestion > $totalQuestions) {
    header('Location: results.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM questions');
$stmt->execute($currentQuestion);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM options');
$stmt->execute($currentQuestion);
$options = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz <?php echo $currentQuestion ?></title>
</head>
<body>
    <p>Question <?php echo $currentQuestion." of ". $totalQuestions ;?></p>
    <h2><?php echo $question['question_text']?></h2>

    <form action="process.php" method="POST">
        <?php foreach ($options as $option): ?>
        <label>
            <input type="radio" name="answer" value="<?php echo $option['option_label'];?>" required>
            <?php echo $option['option_label']; ?>. <?php echo $option['option_text']; ?>
        </label>
        <?php endforeach; ?> <br>

        <?php if($currentQuestion > 1): ?>
            <button type="submit" name="action" value="previous"> Previous Question </button>
        <?php endif ?>
        <button type="submit" name="action" value="next"> 
            <?php echo ($currentQuestion == $totalQuestions)? 'Finish Quiz' : 'Next Question'; ?>  
        </button>
    </form>
</body>
</html>