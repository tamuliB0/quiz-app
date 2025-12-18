<?php
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['answer'])) {
    header('Location: questions.php');
    exit;
}

$currentQuestion = $_SESSION['current_question'];
$_SESSION['answer'][$currentQuestion] = $_POST['answer'];

if (isset($_POST['action'])) {
    if($_POST['action'] == 'previous') {
        $_SESSION['current_question']--;
    } elseif($_POST['action'] == 'next') {
        $_SESSION['current_question']++;
    }
}

header('Location: questions.php');
exit;