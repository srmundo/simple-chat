<?php
include('connect.php');

$nick = $_POST['nickname'];
$key_code = $_POST['key'];

$query_ver = mysqli_query($link, "SELECT * FROM get_date WHERE key_code = '$key_code' OR name_user = '$nick'");

if(mysqli_num_rows($query_ver) == 0){
    $sql_first_reg = "INSERT INTO get_date (name_user, key_code, type_user, id_status) VALUES ('$nick', '$key_code', 1, 1)";
    $query_first_reg = mysqli_query($link, $sql_first_reg);
    if (!$query_first_reg) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <div class="container">
                <h1>We are very sorry. It is not possible to make your request at this time, try again later.</h1>
                <a id="btn_back-php" href="javascript:create_room()">Back</a>
            </div>
            <script>
            function create_room(){
                let btnBackPhp = document.getElementById("btn_back-php");
                btnBackPhp.addEventListener("click", ()=>{
                    location.href = "../index.html";
                    window.sessionStorage.removeItem("user");
                });
            }
            </script>
        </body>
        </html>';
    }
    mysqli_query($link, "INSERT INTO user (nickname, type_user, id_status) SELECT name_user, type_user, id_status FROM get_date");
    mysqli_query($link, "INSERT INTO chat_room (key_code, create_by) SELECT key_code, id FROM get_date");
  
    header('Location:../src/app.html');
}else{
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h1>This room already exists, please create a new one.</h1>
            <a id="btn_back-php" onclick="" href="javascript:create_room()">Back</a>
        </div>
        <script>
        function create_room(){
            let btnBackPhp = document.getElementById("btn_back-php");
            btnBackPhp.addEventListener("click", ()=>{
                location.href = "../index.html";
                window.sessionStorage.removeItem("user");
            });
        }
        </script>
    </body>
    </html>';
}

mysqli_close($link);
