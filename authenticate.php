<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require "cache.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

// Check if user is already cached
$cachedUser = $memcache->get("user_" . $username);

if ($cachedUser) {
    $_SESSION['username'] = $cachedUser['username'];
    header("Location: welcome.php");
    exit();
}

require "db.php";
// If not cached → check DB
$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    
    // Save to Memcached for 10 minutes
    $memcache->set("user_" . $username, $user, 600);
    
    $_SESSION['username'] = $user['username'];
    header("Location: welcome.php");
    exit();
} else {
    echo "❌ Invalid username or password.";
}
?>
