<?php
include('./connect.php');

$txtHeaderU = $_REQUEST['txtHeaderU'];
$user = $_REQUEST['user'];
$current_date = $_REQUEST['date'];
$key = $_REQUEST['key'];

$sql_one = "SELECT * FROM get_date WHERE key_code = '$key'";
$query_one = mysqli_query($link, $sql_one);
echo $txtHeaderU;
while($show_one = mysqli_fetch_array($query_one)){

    if($show_one['name_user'] != $user){
        echo $show_one['name_user'] . " ";
    }

}