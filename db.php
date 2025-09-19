<?php
$host = "10.22.200.123";
$user = "arqam";     // change if needed
$pass = "123456@a";         // change if needed
$db   = "login_demo";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
