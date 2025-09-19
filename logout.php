<?php
session_start();
require "cache.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $memcache->delete("user_" . $username); // remove from cache
    session_destroy();
}
header("Location: login.php");
exit();
?>
