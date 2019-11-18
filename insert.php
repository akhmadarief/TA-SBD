<?php

include("conf.php");

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$id = mysqli_real_escape_string($conn, $_POST['no_id']);
$inst = mysqli_real_escape_string($conn, $_POST['inst']);
$jk = mysqli_real_escape_string($conn, $_POST['gender']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$hp = mysqli_real_escape_string($conn, $_POST['hp']);
$id_kota = mysqli_real_escape_string($conn, $_POST['kota']);
$id_seminar = mysqli_real_escape_string($conn, $_POST['seminar']);

$query = mysqli_query($conn, "INSERT INTO peserta SET nama='$nama', id=$id, inst='$inst', jenis_kelamin='$jk', email='$email', hp='$hp', id_kota=$id_kota, id_seminar=$id_seminar")
or die(mysqli_error($conn));

if ($query){
	header('location: index.php');
}
else{
	echo mysqli_error($conn);
}

?>