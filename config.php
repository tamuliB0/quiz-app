<?php
session_start();
$host = "localhost";
$dbname = "quiz";
$user = "root";
$pass = "root";


$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
