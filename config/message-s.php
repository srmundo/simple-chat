<?php
include('./connect.php');

$send = $_REQUEST['send'];
$user = $_REQUEST['user'];
$current_date = $_REQUEST['date'];
$key = $_REQUEST['key'];

$select_id_user = "SELECT id FROM user WHERE nickname = '$user'";
$query_id = mysqli_query($link, $select_id_user);
$show_id = mysqli_fetch_array($query_id);
$id_user = $show_id['id'];
$sql_insert = "INSERT INTO chat (id_user, data_time, name_user, message, key_code) VALUES ($id_user, '$current_date', '$user', '$send', '$key') ";
$query_insert = mysqli_query($link, $sql_insert);
if (!$query_insert) {
    echo '<li id="me" class="me">
    <div class="entete">
        <h3>10:12AM, Today</h3>
        <h2>Vincent</h2>
        <span class="status blue"></span>
    </div>
    <div class="triangle"></div>
    <div class="message">
        Error sending the message.
    </div>
    </li>';
}

$sql_select = "SELECT * FROM chat WHERE name_user = '$user' ORDER BY id DESC";
$query_select = mysqli_query($link, $sql_select);
$row = mysqli_fetch_row($query_select);

echo '<li class="me">
<div class="entete">
    <h3 id="d">'. $row[2] .'</h3>
    <h2 id="name">'. $row[3] .'</h2>
    <span class="status blue"></span>
</div>
<div class="triangle"></div>
<div id="message" class="message">
    ' . $row[5] . '
</div>
</li>';