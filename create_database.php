<?php
// Handle error 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config.php";

$sql = "CREATE DATABASE $dbname";

try {
    $conn->exec($sql);
    echo "Database created successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}

$conn = null;
