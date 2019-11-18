<?php
	include "conf.php";

	$stmt = $conn->prepare("INSERT INTO peserta SET nama=?, id=?, inst=?, jenis_kelamin=?, email=?, hp=?, id_kota=?, id_seminar=?");
	$stmt->bind_param("ssssssii", $_POST['nama'], $_POST['no_id'], $_POST['inst'], $_POST['gender'], $_POST['email'], $_POST['hp'], $_POST['kota'], $_POST['seminar']);
	$stmt->execute();

	if ($stmt){
		header('location: index.php');
	}

	$stmt->close();
?>