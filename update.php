<?php
    include "conf.php";
    
    if(isset($GET['peserta'])){
        $stmt = $conn->prepare("UPDATE peserta SET nama=?, inst=?, jenis_kelamin=?, email=?, hp=?, id_kota=?, id_seminar=? WHERE id=?");
        $stmt->bind_param("sssssiis", $_POST['nama'], $_POST['inst'], $_POST['gender'], $_POST['email'], $_POST['hp'], $_POST['kota'], $_POST['seminar'], $_POST['no_id']);
        $stmt->execute();

        if ($stmt){
            header('location: peserta.php');
        }
    }
    else if(isset($GET['seminar'])){
        $stmt = $conn->prepare("UPDATE semianr SET nama_seminar=?, waktu=?, tempat=?, htm=? WHERE id_seminar=?");
        $stmt->bind_param("sssii", $_POST['nama_seminar'], $_POST['waktu'], $_POST['tempat'], $_POST['id_seminar']);
        $stmt->execute();

        if ($stmt){
            header('location: seminar.php');
        }
    }

	$stmt->close();
?>