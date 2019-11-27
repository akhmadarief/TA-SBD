<?php
    include "conf.php";

    session_start();
    if($_SESSION['status']!="login"){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Data Peserta Seminar</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">

    <!-- Jquery JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="page-wrapper p-t-45 p-b-50">
        <div class="wrapper wrapper--w1550">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Data Peserta Seminar</h2>
                </div>
                <div class="card-body-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#peserta">Peserta</a></li>
                        <li><a data-toggle="tab" href="#seminar">Seminar</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="peserta" class="tab-pane fade in active">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Instansi</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No. HP</th>
                                    <th scope="col">Kota</th>
                                    <th scope="col">Seminar</th>
                                    <th scope="col">Waktu Registrasi</th>
                                    </tr>
                                </thead>
                                <?php
                                    $data_peserta = $conn->query("SELECT * FROM peserta");
                                    while ($row = $data_peserta->fetch_assoc()) {
                                        echo "<tr>
                                        <td>".$row['nama']."</td>
                                        <td>".$row['id']."</td>
                                        <td>".$row['inst']."</td>
                                        <td>".$row['jenis_kelamin']."</td>
                                        <td>".$row['email']."</td>
                                        <td>".$row['hp']."</td>
                                        <td>".$row['id_kota']."</td>
                                        <td>".$row['id_seminar']."</td>
                                        <td>".$row['waktu']."</td>
                                        </tr>";
                                    }
                                    $data_peserta->close();
                                ?>
                            </table>
                        </div>
                        <div id="seminar" class="tab-pane fade">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Seminar</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Tempat</th>
                                        <th scope="col">HTM</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $data_seminar = $conn->query("SELECT * FROM seminar");
                                    while ($row = $data_seminar->fetch_assoc()) {
                                        echo "<tr>
                                        <td>".$row['nama_seminar']."</td>
                                        <td align='center'>".$row['waktu']."</td>
                                        <td>".$row['tempat']."</td>
                                        <td align='right'>Rp ".$row['htm']."</td>
                                        <td align='center'>
                                            <a href='hapus_mahasiswa.php?id=".$row['id_seminar']."' class='btn btn-danger'>Hapus</button></a>
                                        </td>
                                        </tr>";
                                    }
                                    $data_seminar->close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
