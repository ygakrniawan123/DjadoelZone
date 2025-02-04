<?php
$host = "localhost";
$user = "root";
$pw = "";
$db_name = "nostalgia";

$conn = mysqli_connect($host, $user, $pw, $db_name);


if(!$conn){
    echo 'tidak bisa connect ke database';
}



?>