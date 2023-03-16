<?php
include('connect.php');

$nick = $_POST['nickname'];
$key_code = $_POST['key'];



$sql = "SELECT * FROM user WHERE nickname = '$nick'";

$query = mysqli_query($link, $sql);
$num = mysqli_num_rows($query);


if ($num > 0) {
    $sql_two = "SELECT * FROM chat_room WHERE key_code = '$key_code'";
    $query_two = mysqli_query($link, $sql_two);
    $num_two = mysqli_num_rows($query_two);
    if ($num_two > 0) {
        mysqli_query($link, "UPDATE `get_date` SET `id_status` = '1' WHERE `get_date`.`name_user` = '$nick' ");
        header('Location: ../src/app.html');
    } elseif ($num_two === 0) {
        mysqli_query($link, "DELETE FROM `get_date` WHERE `get_date`.`name_user` = '$nick'");
        mysqli_query($link, "DELETE FROM `user` WHERE `user`.`nickname` = '$nick'");
        header('Location: ../index.html');
    }

} elseif ($num === 0) {
    $sql_three = "INSERT INTO get_date (name_user, key_code, type_user, id_status) VALUES ('$nick', '$key_code', 2, 1)";
    $query_three = mysqli_query($link, $sql_three);

    mysqli_query($link, "INSERT INTO user (nickname, type_user, id_status) SELECT name_user, type_user, id_status FROM get_date WHERE name_user = '$nick'");
    $sql_four = "SELECT * FROM chat_room WHERE key_code = '$key_code'";
    $query_four = mysqli_query($link, $sql_four);
    $num_four = mysqli_num_rows($query_four);
    if ($num_four > 0) {
        header('Location: ../src/app.html');
    } elseif ($num_four === 0) {
        mysqli_query($link, "DELETE FROM `get_date` WHERE `get_date`.`name_user` = '$nick'");
        mysqli_query($link, "DELETE FROM `user` WHERE `user`.`nickname` = '$nick'");
        header('Location: ../index.html');
    }
}

mysqli_close($link);