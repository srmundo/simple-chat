<?php
include('connect.php');
$txtHeaderM = $_REQUEST['txtHeaderM'];
$user = $_REQUEST['user'];
$key = $_REQUEST['key'];
$sql_two = "SELECT message FROM chat WHERE key_code = '$key'";
$query_two = mysqli_query($link, $sql_two);
$count_m = mysqli_num_rows($query_two);

echo $count_m . $txtHeaderM;