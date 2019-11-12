<?php
	include 'conf.php';
	$id_provinsi = $_POST['id_provinsi'];

	echo "<option disabled='disabled' selected='selected'>Pilih Kota/Kabupaten</option>";

	$kota = mysqli_query($conn2,"SELECT * FROM regencies WHERE province_id='$id_provinsi' ORDER BY name ASC");
	while ($row = mysqli_fetch_assoc($kota)) {
		echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
	}
?>