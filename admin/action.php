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
    
    else if (isset($_GET['action'])){
        if ($_GET['action'] == "cari"){
            if (isset($_POST['search_seminar'])) {
                $search = "%{$_POST['search_seminar']}%";
                $data_seminar = $conn->prepare("SELECT * FROM seminar WHERE nama_seminar LIKE ? OR tempat LIKE ?");
                $data_seminar->bind_param("ss", $search, $search);
                $data_seminar->execute();
                $result = $data_seminar->get_result();
                while ($row = $result->fetch_assoc()) {
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
            }
            else if (isset($_POST['search_peserta'])) {
                $no = 1;
                $search = "%{$_POST['search_peserta']}%";
                $data_peserta = $conn->prepare("SELECT peserta.nama, peserta.id, peserta.jenis_kelamin, peserta.email, peserta.hp, seminar.nama_seminar, peserta.waktu FROM peserta INNER JOIN seminar ON peserta.id_seminar=seminar.id_seminar WHERE nama LIKE ? OR nama_seminar LIKE ? ORDER BY nama");
                $data_peserta->bind_param("ss", $search, $search);
                $data_peserta->execute();
                $result = $data_peserta->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo
                    "<tr>
                        <td class='text-center'>".$no++."</td>
                        <td>".$row['nama']."</td>
                        <td>".$row['id']."</td>
                        <td>".$row['nama_seminar']."</td>
                        <td class='text-center'>".$row['waktu']."</td>
                        <td class='text-center'>
                            <a class='btn btn-sm btn-info' href='edit_peserta.php?id=".$row['id']."'>
                                <span class='ti-pencil'>
                                </span>Edit
                            </a>
                            <a class='btn btn-sm btn-danger' href='action.php?delete_peserta_id=".$row['id']."'>
                                <span class='ti-trash'>
                                </span>Hapus
                            </a>
                        </td>
                    </tr>";
                }
                $data_peserta->close();
            }
            else if (isset($_POST['search_detailpeserta'])) {
                $no = 1;
                $search = "%{$_POST['search_detailpeserta']}%";
                $detail_peserta = $conn->prepare("SELECT peserta.*, regencies.name AS kota, provinces.name AS provinsi FROM peserta INNER JOIN regencies ON regencies.id=peserta.id_kota INNER JOIN provinces ON regencies.province_id=provinces.id WHERE nama LIKE ? OR regencies.name LIKE ? OR provinces.name LIKE ? ORDER BY nama");
                $detail_peserta->bind_param("sss", $search, $search, $search);
                $detail_peserta->execute();
                $result = $detail_peserta->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo
                    "<tr>
                        <td class='text-center'>".$no++."</td>
                        <td>".$row['nama']."</td>
                        <td>".$row['id']."</td>
                        <td class='text-center'>".$row['jenis_kelamin']."</td>
                        <td>".$row['hp']."</td>
                        <td>".$row['email']."</td>
                        <td>".$row['kota'].", ".$row['provinsi']."</td>
                        <td class='text-center'>".$row['id_seminar']."</td>
                        <td class='text-center'>".$row['waktu']."</td>
                        <td class='text-center'>
                            <a class='btn btn-sm btn-info' href='edit_peserta.php?id=".$row['id']."'>
                                <span class='ti-pencil' title='Edit'>
                                </span>Edit
                            </a>
                            <a class='btn btn-sm btn-danger' href='action.php?delete_peserta_id=".$row['id']."'>
                                <span class='ti-trash' title='Edit'>
                                </span>Hapus
                            </a>
                        </td>
                    </tr>";
                }
                $detail_peserta->close();
            }
        }
    }
    else{
        echo "403 FORBIDDEN";
    }
?>