<?php
$user = $_REQUEST['user'];
$key = $_REQUEST['key'];

$select_date = "SELECT id FROM get_date WHERE name_user = '$user'";
$select_user = "SELECT id FROM user WHERE name_user = '$user'";
$query_s_date = mysqli_query($link, $select_date);
$query_s_user = mysqli_query($link, $select_user);

$id_date = mysqli_fetch_array($query_s_date);
$id_user = mysqli_fetch_array($query_s_user);

$id_d = $id_date['id'];
$id_u = $id_user['id'];


$sql_delete_date = "DELETE * FROM get_date WHERE id = '$id_d'";
$sql_delete_user = "DELETE * FROM user WHERE id = '$id_u'";
$query_d_date = mysqli_query($link, $sql_delete_date);
$query_d_user = mysqli_query($link, $sql_delete_user);
