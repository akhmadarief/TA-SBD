<?php
    include "../conf.php";

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
                    <a class='btn btn-sm btn-danger' href='delete_seminar.php?id=".$row['id_seminar']."'>
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
                    <a class='btn btn-sm btn-info' href='edit.php?id=".$row['id']."'>
                        <span class='ti-pencil'>
                        </span>Edit
                    </a>
                    <a class='btn btn-sm btn-danger' href='delete.php?id=".$row['id']."'>
                        <span class='ti-trash'>
                        </span>Hapus
                    </a>
                </td>
            </tr>";
        }
        $data_peserta->close();
    }
?>