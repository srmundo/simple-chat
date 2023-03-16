<?php
include('./config.php');

$link = mysqli_connect($host, $user, $pass, $db);

if (!$link) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "debug errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "debug error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}