<?php
    include "../conf.php";

    session_start();
    if($_SESSION['status']!="login"){
        header("location: login.php?pesan=belum_login");
    }

    if (isset($_GET['insert'])){
        if ($_GET['insert'] == "seminar"){
            $stmt = $conn->prepare("INSERT INTO seminar SET nama_seminar=?, waktu=?, tempat=?, htm=?");
            $stmt->bind_param("sssi", $_POST['judul'], $_POST['waktu'], $_POST['tempat'], $_POST['htm']);
            $stmt->execute();
        
            if ($stmt){
                header("location: seminar.php");
            }
    
            $stmt->close();
        }
    }

    else if (isset($_GET['update'])){
        if ($_GET['update'] == "peserta"){
            $stmt = $conn->prepare("UPDATE peserta SET nama=?, jenis_kelamin=?, email=?, hp=?, id_kota=?, id_seminar=? WHERE id=?");
            $stmt->bind_param("ssssiii", $_POST['nama'], $_POST['gender'], $_POST['email'], $_POST['hp'], $_POST['kota'], $_POST['seminar'], $_POST['no_id']);
            $stmt->execute();
    
            if ($stmt){
                header("location: detailpeserta.php");
            }
    
            $stmt->close();
        }
        else if ($_GET['update'] == "seminar"){
            $stmt = $conn->prepare("UPDATE seminar SET nama_seminar=?, waktu=?, tempat=?, htm=? WHERE id_seminar=?");
            $stmt->bind_param("sssii", $_POST['judul'], $_POST['waktu'], $_POST['tempat'], $_POST['htm'], $_POST['id_seminar']);
            $stmt->execute();
    
            if ($stmt){
                header("location: seminar.php");
            }
    
            $stmt->close();
        }
    }

    else if (isset($_GET['delete_peserta_id'])){
        $stmt = $conn->prepare("DELETE FROM peserta WHERE id=?");
        $stmt->bind_param("s", $_GET['delete_peserta_id']);
        $stmt->execute();

        if ($stmt){
            header("location: detailpeserta.php");
        }

        $stmt->close();
    }

    else if (isset($_GET['delete_seminar_id'])){
        $stmt = $conn->prepare("DELETE FROM seminar WHERE id_seminar=?");
        $stmt->bind_param("s", $_GET['delete_seminar_id']);
        $stmt->execute();

        if ($stmt){
            header("location: seminar.php");
        }

        $stmt->close();
    }
    
    else{
        echo "403 FORBIDDEN";
    }
?>