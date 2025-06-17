<?php
$host = 'localhost';
$dbname = 'guestbook';
$user = 'root';
$pass = ''; // Change this as needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection Failed: " . $e->getMessage());
}
session_start();
?>
