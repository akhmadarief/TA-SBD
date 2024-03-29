<?php
    include "conf.php" ;
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
    <title>Form Registrasi Seminar</title>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#provinsi").change(function(){
            var provinsi = $("#provinsi").val();
                $.ajax({
                    type: 'POST',
                    url: "get_city.php",
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
    <div class="page-wrapper p-t-45 p-b-50">
        <div class="wrapper wrapper--w850">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Form Registrasi Seminar</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="insert.php" name="reg" id="reg">
                        <div class="form-row">
                            <div class="name">Nama</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="nama" maxlength="50" oninput="this.value = this.value.replace(/[^a-z A-Z ']/g, '');" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">No. Identitas</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="no_id" maxlength="20" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                    <label class="label--desc">KTP/KTM/SIM/Passport</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Institusi</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="inst" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Jenis Kelamin</div>
                            <div class="value">
                                <div class="input-group">
                                    <label class="radio-container m-r-55">Laki-Laki
                                        <input type="radio" name="gender" value="Laki-Laki" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radio-container">Perempuan
                                        <input type="radio" name="gender" value="Perempuan">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" maxlength="50" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Nomor HP</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="hp" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Alamat</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--search">
                                                <select name="provinsi" id="provinsi">
                                                    <option disabled="disabled" selected>Pilih Provinsi</option>
                                                    <?php
                                                        $data_prov = $conn->query("SELECT * FROM provinces ORDER BY name ASC");
                                                        while($row = $data_prov->fetch_assoc()) {
                                                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                                        }
                                                        $data_prov->close();
                                                    ?>
                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                            <label class="label--desc">Provinsi</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <div class="rs-select2 js-select-simple select--search">
                                                <select name="kota" id="kota">
                                                    <option disabled="disabled" selected>Pilih Provinsi terlebih dahulu</option>
                                                </select>
                                                <div class="select-dropdown"></div>
                                            </div>
                                            <label class="label--desc">Kota/Kabupaten</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Seminar</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="seminar">
                                            <option disabled="disabled" selected>Pilih Seminar</option>
                                            <?php
                                                $data_seminar = $conn->query("SELECT * FROM seminar ORDER BY nama_seminar ASC");
                                                while($row = $data_seminar->fetch_assoc()) {
                                                    echo "<option value='".$row['id_seminar']."'>".$row['nama_seminar']."</option>";
                                                }
                                                $data_seminar->close();
                                            ?>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                    <label class="label--desc">HTM: </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 0px">
                            <div class="name"></div>
                            <div class="value">
                                <div class="input-group">
                                    <button class="btn btn--radius-2 btn--blue" type="submit">Registrasi</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
</body>

</html>
