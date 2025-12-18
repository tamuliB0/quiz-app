<?php
require_once 'config.php';


if(isset($_GET['begin'])) {
    $_SESSION['current_question'] = 1;
    $_SESSION['answers'] = [];
    header('Location: questions.php');
    exit;
}

$stmt = $pdo->query('SELECT COUNT(*) FROM questions');
$totalQuestions = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>
</head>
<body>
    <div>
        <h1>General Knowledge Quiz</h1>
        <p>Test your knowledge with <?php echo $totalQuestions; ?> questions!</p>
        <a href="?begin">Start Quiz</a>
    </div>
</body>
</html>