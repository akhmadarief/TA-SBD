<?php
	session_start();
	include("../conf.php");

	$admin = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
	$admin->bind_param("ss", $_POST['username'], md5($_POST['password']));
	$admin->execute();
	$result = $admin->get_result();
	$row = $result->fetch_row();

	if ($row > 0){
		$_SESSION['username'] = $username;
		$_SESSION['status'] = "login";
		header("location: ../admin");
	}else{
		header("location: login.php?pesan=gagal");
	}

	$admin->close();
?>