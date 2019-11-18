<?php
	include "conf.php";

	echo "<option disabled='disabled' selected='selected'>Pilih Kota/Kabupaten</option>";

	$kota = $conn->prepare("SELECT * FROM regencies WHERE province_id=? ORDER BY name ASC");
	$kota->bind_param("i", $_POST['id_provinsi']);
	$kota->execute();
	$result = $kota->get_result();
	while($row = $result->fetch_assoc()) {
		echo "<option value='".$row['id']."'>".$row['name']."</option>";
	}
	$kota->close();
?>