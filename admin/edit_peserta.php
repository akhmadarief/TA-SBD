<?php
    include "../conf.php";

    session_start();
    if($_SESSION['status']!="login"){
        header("location: ../login.php");
    }

    $stmt = $conn->prepare("SELECT * FROM peserta WHERE id=?");
	$stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $data_kota = $conn->prepare("SELECT * FROM regencies WHERE id=?");
	$data_kota->bind_param("i", $row['id_kota']);
	$data_kota->execute();
	$result_kota = $data_kota->get_result();
	$row_kota = $result_kota->fetch_assoc();
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
        
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#provinsi").change(function(){
                var provinsi = $("#provinsi").val();
                    $.ajax({
                        type: 'POST',
                        url: "../get_city.php",
                        data: {id_provinsi: provinsi},
                        cache: false,
                        success: function(msg){
                        $("#kota").html(msg);
                        }
                    });
                });
            });
        </script>

    </head>

    <body>

        <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
            <div class="nano">
                <div class="nano-content">
                    <div class="logo"><a href="../admin"><!-- <img src="assets/images/logo.png" alt="" /> --><span>Focus</span></a></div>
                    <ul>
                        <li class="label">Main</li>
                        <li><a href="../admin"><i class="ti-home"></i> Beranda </a></li>
                        <li class="active"><a><i class="ti-user"></i> Data Peserta </a></li>
                        <li><a href="seminar.php"><i class="ti-calendar"></i> Data Seminar </a></li>
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
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 p-b-20">
                                                <a href="javascript:history.go(-1)" class="btn btn-sm btn-danger"><span class='ti-angle-left' title='Kembali'></span> Kembali</a>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="action.php?update=peserta">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">No. Identitas</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?php echo $row['id']; ?>" class="form-control" name="no_id" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Nama</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?php echo $row['nama']; ?>" class="form-control" name="nama" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?php echo $row['jenis_kelamin']; ?>" class="form-control" name="gender" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Nomor HP</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?php echo $row['hp']; ?>" class="form-control" name="hp" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" value="<?php echo $row['email']; ?>" class="form-control" name="email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Alamat</label>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" id="provinsi">
                                                            <?php
                                                                $data_prov = $conn->query("SELECT * FROM provinces ORDER BY name ASC");
                                                                while($row_prov = $data_prov->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $row_prov['id']; ?>" <?php if ($row_prov['id'] == $row_kota['province_id']) echo 'selected'; ?> ><?php echo $row_prov['name']; ?></option>
                                                                <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <select class="form-control" name="kota" id="kota">
                                                            <?php
                                                                $data_kota_op = $conn->prepare("SELECT * FROM regencies WHERE province_id=? ORDER BY name ASC");
                                                                $data_kota_op->bind_param("i", $row_kota['province_id']);
                                                                $data_kota_op->execute();
                                                                $result_kota_op = $data_kota_op->get_result();
                                                                while($row_kota_op = $result_kota_op->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $row_kota_op['id']; ?>" <?php if ($row_kota_op['id'] == $row['id_kota']) echo 'selected'; ?> ><?php echo $row_kota_op['name']; ?></option>
                                                                <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label">Seminar</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="seminar">
                                                            <?php
                                                                $data_seminar = $conn->query("SELECT * FROM seminar ORDER BY id_seminar");
                                                                while($row_seminar = $data_seminar->fetch_assoc()) { ?>
                                                                    <option value="<?php echo $row_seminar['id_seminar']; ?>" <?php if ($row_seminar['id_seminar'] == $row['id_seminar']) echo 'selected'; ?> ><?php echo $row_seminar['nama_seminar']; ?></option>
                                                                <?php }
                                                                $data_seminar->close();
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-2 control-label"></label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

    </body>

</html>
