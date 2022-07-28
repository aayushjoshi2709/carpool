<?php
    $server_url = "localhost";
    $user_name = "root";
    $password = "";
    $db_name = "carpool";
    $conn = new mysqli($server_url, $user_name, $password, $db_name);
    if($conn -> connect_error){
        die("connection falied: ". $conn-> connect_error);
    }
?>

