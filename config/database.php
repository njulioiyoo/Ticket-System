<?php

define('DB_HOST', '192.168.0.102');
define('DB_USER', 'root');
define('DB_PASS', 'mysql-container');
define('DB_NAME', 'ticket_system');
define('DB_PORT', '3336');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}