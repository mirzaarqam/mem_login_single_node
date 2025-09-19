<?php
$memcache = new Memcached();
$memcache->addServer("127.0.0.1", 11211);

// Proper connection check
$stats = $memcache->getStats();
if (empty($stats) || $stats["127.0.0.1:11211"]["pid"] == -1) {
    die("Could not connect to Memcached");
}
?>
