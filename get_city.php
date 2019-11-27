<?php
	include "conf.php";

	echo "<option disabled='disabled' selected='selected'>Pilih Kota/Kabupaten</option>";

	$data_kota = $conn->prepare("SELECT * FROM regencies WHERE province_id=? ORDER BY name ASC");
	$data_kota->bind_param("i", $_POST['id_provinsi']);
	$data_kota->execute();
	$result = $data_kota->get_result();
	while($row = $result->fetch_assoc()) {
		echo "<option value='".$row['id']."'>".$row['name']."</option>";
	}
	$kota->close();
?>