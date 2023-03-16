<?php
include('./connect.php');

$url_avatar = $_REQUEST['avatarURL'];
$user = $_REQUEST['user'];
mysqli_query($link, "UPDATE `get_date` SET `url_avatar` = '$url_avatar' WHERE `get_date`.`name_user` = '$user' ");
