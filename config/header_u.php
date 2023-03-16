<?php
include('./connect.php');

$user = $_REQUEST['user'];
$current_date = $_REQUEST['date'];
$key = $_REQUEST['key'];

$sql_one = "SELECT * FROM get_date WHERE key_code = '$key'";
$query_one = mysqli_query($link, $sql_one);

while ($show_one = mysqli_fetch_array($query_one)) {
    if ($show_one['name_user'] != $user) {
        if($show_one['id_status'] == 1){
            echo '<li>
        <span class="get-url-img" id="img" style="background-image: url('. $show_one['url_avatar'] .')" alt=""></span>
        <div>
            <h2>'.$show_one['name_user'].'</h2>
            <h3>
                <span class="status green"></span>
                online
            </h3>
        </div>
        </li>';
        }elseif($show_one['id_status'] == 0){
            echo '<li>
        <span class="get-url-img" id="img" style="background-image: url('. $show_one['url_avatar'] .')" alt=""></span>
        <div>
            <h2>'.$show_one['name_user'].'</h2>
            <h3>
                <span class="status orange"></span>
                offline
            </h3>
        </div>
        </li>';
        }
    }
}