<?php
include('./connect.php');
$user = $_REQUEST['user'];
$key = $_REQUEST['key'];

$sql_select1 = "SELECT * FROM chat_room WHERE key_code = '$key'";
$query_select1 = mysqli_query($link, $sql_select1);
$res = mysqli_num_rows($query_select1);
if($res === 0){
    echo '<div id="cont-no-room">
        <h1> Lo siento mucho, la sala de chat a la que ingresaste no existe. </h1>
        <h2> Verifica si la llave que tienes esta correcta o puedes crear tu propia sala de chat </h2>
        <a href="#" onclick="back()">Volver al inicio</a>
        <br>
        <script>
        function back() {
            sessionStorage.removeItem("user");
            location.replace("../index.html");
          }
        </script>
    </div>';
}

$sql_select = "SELECT * FROM chat WHERE key_code = '$key' ORDER BY id ASC";
$query_select = mysqli_query($link, $sql_select);

while($show=mysqli_fetch_array($query_select)){
    if ($show['name_user'] === $user) {
        echo '<li class="me">
            <div class="entete">
                <h3 id="d">' . $show['data_time'] . '</h3>
                <h2 id="name">' . $show['name_user'] . '</h2>
                <span class="status blue"></span>
            </div>
            <div class="triangle"></div>
            <div id="message" class="message">
                ' . $show['message'] . '
            </div>
            </li>';
    } elseif ($show['name_user'] !== $user) {
        echo '<li id="you" class="you">
                <div class="entete">
                    <span class="status green"></span>
                    <h2>' . $show['data_time'] . '</h2>
                    <h3>' . $show['name_user'] . '</h3>
                </div>
                <div class="triangle"></div>
                <div id="message-r" class="message">
                    ' . $show['message'] . '
                </div>
            </li>';
    }
}