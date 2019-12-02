<?php
    include "../conf.php";

    session_start();
    if($_SESSION['status']!="login"){
        header("location: login.php?pesan=belum_login");
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Regristrasi Seminar - Data Peserta</title>

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

        <!-- Styles -->
        <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/lib/jsgrid/jsgrid.min.css" type="text/css" rel="stylesheet">

        <link href="assets/css/lib/helper.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body>

        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
            <div class="nano">
                <div class="nano-content">
                    <div class="logo"><a href="../admin"><!-- <img src="assets/images/logo.png" alt="" /> --><span>Focus</span></a></div>
                    <ul>
                        <li class="label">Main</li>
                        <li><a href="../admin"><i class="ti-home"></i> Beranda </a></li>
                        <li><a href="peserta.php"><i class="ti-user"></i> Data Peserta </a></li>
                        <li class="active"><a><i class="ti-calendar"></i> Data Seminar </a></li>
                        <li><a href="detailpeserta.php"><i class="ti-id-badge"></i> Detail Peserta </a></li>
                        <li><a href="logout.php"><i class="ti-close"></i> Logout </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /# sidebar -->

        <div class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-left">
                            <div class="hamburger sidebar-toggle">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>
                        <div class="float-right">
                            <ul>
                                <li class="header-icon dib"><span class="user-avatar">Akhmad Arief <i class="ti-angle-down f-s-10"></i></span>
                                    <div class="drop-down dropdown-profile">
                                        <div class="dropdown-content-body">
                                            <ul>
                                                <li><a href="#"><i class="ti-user"></i> <span>Profile</span></a></li>
                                                <li><a href="#"><i class="ti-email"></i> <span>Inbox</span></a></li>
                                                <li><a href="#"><i class="ti-settings"></i> <span>Setting</span></a></li>
                                                <li><a href="#"><i class="ti-lock"></i> <span>Lock Screen</span></a></li>
                                                <li><a href="logout.php"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Tabel berikut merupakan detail mengenai seminar.</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="../admin">Beranda</a></li>
                                        <li class="breadcrumb-item active">Data Seminar</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <section id="main-content">
                        <div class="row">
                            <div class="col-lg-12 p-b-25">
                                <div class="card">
                                    <div class="bootstrap-data-table-panel">
                                        <div class="row p-b-10">
                                            <div class="col-sm-6">
                                                <label><b>Cari berdasarkan judul atau tempat:</b></label>
                                                <label><input type="text" id="cari" class="form-control input-sm" placeholder=""></label>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="add_seminar.php" class="btn btn-sm btn-success" style="float:right"><span class="ti-plus"></span> Tambah Data Baru</a>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                <table class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="bootstrap-data-table-export_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="text-center">ID</th>
                                                            <th class="text-center">Judul Seminar</th>
                                                            <th class="text-center">Pelaksanaan</th>
                                                            <th class="text-center">Tempat</th>
                                                            <th class="text-center">HTM</th>
                                                            <th class="text-center">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tampil">
                                                        <?php
                                                            $data_seminar = $conn->query("SELECT * FROM seminar");
                                                            while ($row = $data_seminar->fetch_assoc()) {
                                                                echo
                                                                "<tr>
                                                                    <td class='text-center'>".$row['id_seminar']."</td>
                                                                    <td>".$row['nama_seminar']."</td>
                                                                    <td class='text-center'>".$row['waktu']."</td>
                                                                    <td>".$row['tempat']."</td>
                                                                    <td class='text-right'>Rp. ".$row['htm']."</td>
                                                                    <td class='text-center'>
                                                                        <a class='btn btn-sm btn-info' href='edit_seminar.php?id=".$row['id_seminar']."'>
                                                                            <span class='ti-pencil'>
                                                                            </span> Edit
                                                                        </a>
                                                                        <a class='btn btn-sm btn-danger' href='action.php?delete_seminar_id=".$row['id_seminar']."'>
                                                                            <span class='ti-trash'>
                                                                            </span> Hapus
                                                                        </a>
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
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                        <!-- /# row -->
                    </section>
                </div>
            </div>
        </div>
        <div id="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- jquery vendor -->
        <script src="assets/js/lib/jquery.min.js"></script>
        <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="assets/js/lib/menubar/sidebar.js"></script>
        <script src="assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="assets/js/lib/bootstrap.min.js"></script>

        <!-- bootstrap -->

        <script src="assets/js/scripts.js"></script>
        <!-- scripit init-->
        
        <script type="text/javascript">
            $(document).ready( function() {
                $('#cari').on('keyup', function() {
                    $.ajax({
                    type: 'POST',
                    url: 'search.php',
                    data: {
                        search_seminar: $(this).val()
                    },
                    cache: false,
                    success: function(data) {
                        $('#tampil').html(data);
                    }
                    });
                });
            });
        </script>
    </body>

</html>
