<?php

session_start();
include("conf.php");

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));

$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
$admin = mysqli_num_rows($query);

if ($admin > 0){
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header('location: admin.php');
}else{
	echo mysqli_error($conn);
	header('location: login.php');
}

?>