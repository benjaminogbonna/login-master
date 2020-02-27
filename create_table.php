<?php
// Handle error 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config.php";

$tablename = "users";

$sql = "CREATE TABLE users (
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
name VARCHAR(255),
username VARCHAR(255) not null,
email VARCHAR(255) not null,
pass VARCHAR(255) not null,
photo VARCHAR(255),
created DATE,
token VARCHAR(255) ,
tokenExpire TIMESTAMP(6) ,
PRIMARY KEY (id) ) CHARACTER SET utf8";
//NOT NULL DEFAULT CURRENT_TIMESTAMP

try {
    $conn->exec($sql);
    echo "Table {$tablename} created successfully";
} catch (PDOException $e) {
    echo $e->getMessage();
}

$conn = null;