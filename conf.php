<?php

$conn = new mysqli("localhost", "root", "", "ta_sbd");
if($conn->connect_error) {
    exit('Error connecting to database');
}

?>