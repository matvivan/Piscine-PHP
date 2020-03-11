<?php

function sql($mysqli, $str) {
    if ($mysqli->query($str))
        return "OK ";
    else
        return $mysqli->error;
}

$my = new mysqli("localhost", "root", "");
if (!$my) {
    die("Database connection failed: " . mysqli_error());
}
echo "<!-- ";
echo "DATABASE: ".sql($my, "CREATE DATABASE IF NOT EXISTS `millenium`;");
echo "; USAGE: ".sql($my, "USE `millenium`;");
echo "; USERS: ".sql($my, "CREATE TABLE IF NOT EXISTS `users` (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(30) NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
echo "-->\n";
?>