<?php

$server = "localhost";
$user = "root";
$password = "";
$wilayah = "wilayah_indonesia";
$conn2 = mysqli_connect($server, $user, $password, $wilayah);

if(!$conn2){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>