<?php
session_start();
require 'config.php';

$user = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
$stmt->bindParam(1, $user);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $row['username'];
$name = $row['name'];
$email = $row['email'];
$photo_file = $row['photo'];
$created = $row['created'];

if (!isset($user)) {
    header("location:index.php");
}