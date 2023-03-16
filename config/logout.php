<?php
include('./connect.php');
$user = $_REQUEST['user'];

$sql_select = "SELECT * FROM get_date WHERE name_user='$user'";
$get_id = mysqli_query($link, $sql_select);
$pre_id = mysqli_fetch_array($get_id);
$id = $pre_id['id'];
$code = $pre_id['key_code'];
$sql_select0 = "SELECT * FROM chat_room WHERE key_code='$code'";
$get_id0 = mysqli_query($link, $sql_select0);
$req_code = mysqli_fetch_array($get_id0);
$create_by = $req_code['create_by'];

if ($create_by == $id) {

    $sql_delete0 = "DELETE FROM user WHERE `user`.`id` != '$id'";
    $query_delete0 = mysqli_query($link, $sql_delete0);

    $sql_delete1 = "DELETE FROM user WHERE `user`.`id` = '$id'";
    $query_delete1 = mysqli_query($link, $sql_delete1);

    $sql_delete2 = "DELETE FROM chat WHERE `chat`.`id_user` = '$id'";
    $query_delete2 = mysqli_query($link, $sql_delete2);


    $sql_delete3 = "DELETE FROM chat_room WHERE `chat_room`.`create_by` = '$id'";
    $query_delete3 = mysqli_query($link, $sql_delete3);

    $sql_delete4 = "DELETE FROM get_date WHERE `get_date`.`id` != '$id'";
    $query_delete4 = mysqli_query($link, $sql_delete4);

    $sql_delete5 = "DELETE FROM chat WHERE `chat`.`id_user` != '$id'";
    $query_delete5 = mysqli_query($link, $sql_delete5);

    $sql_delete = "DELETE FROM get_date WHERE `get_date`.`id` = '$id'";
    $query_delete = mysqli_query($link, $sql_delete);

    header('Location: ../index.html');

}else{
    $sql_update = "UPDATE `get_date` SET `id_status` = 0 WHERE `get_date`.`id` = $id ";
    $sql_delete6 = "DELETE FROM chat_room WHERE `chat_room`.`create_by` = '$id'";
    $query_delete6 = mysqli_query($link, $sql_delete6);
    mysqli_query($link, $sql_update);
    header('Location: ../index.html');
}