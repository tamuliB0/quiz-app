<?php
require_once 'config.php';

if (!isset($_SESSION['answers']) || empty($_SESSION['answers'])) {
    header('Location:index.php');
    exit;
}

$totalQuestions = count($_SESSION['answers']);
$results = [];

foreach ($_SESSION['answers'] as $questionID => $userAnswer) {
    $stmt = $pdo->prepare('SELECT question_text, correct_answer FROM questions WHERE id = ?');
    $stmt->execute([questionID]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    $isCorrect = ($userAnswer == $question['correct_answer']);

    $stmt = $pdo->prepare('SELECT option_text FROM options WHERE question_id = ? AND option_label = ?');
    $stmt->execute([$questionID, $userAnswer]);
    $userAnswerText = $stmt->fetchColumn();

    $stmt = $pdo->prepare('SELECT option_text FROM options WHERE question_id = ? AND option_label = ?');
    $stmt->execute([$questionID, $questionID['correct_answer']]);
    $correctAnswerText = $stmt->fetchColumn();
    
    $results[] = [
        'question' => $question['question_text'],
        'user_answer' => $userAnswer.'.'.$userAnswerText,
        'correct_answer' => $question['correct_answer'].'.'.$correctAnswerText,
        'is_correct' => $isCorrect
    ];

}

// echo "<pre>";
// print_r($results);
// echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
</head>
<body>
    <h1>Quiz Complete!!</h1>
    <h3>Review your answers</h3><a href="index.php">Take Quiz again</a>
    <?php foreach ($results as $index => $result): ?>
        <p>Question <?php echo $index + 1; ?>: </p>
        <p><?php echo $result['question']; ?></p>
        <p><strong>Your Answer:</strong><?php echo $result['user_answer'];?></p>
        <?php if (!$result['is_correct']):?>
            <p><strong>Correct Answer:</strong><?php echo $result['correct_answer'];?></p>
            <?php endif ; ?>
            <?php echo $result['is_correct'] ? '✓ Correct':'✗ Incorrect';?>
            <?php endforeach ; ?>
</body>
</html>




