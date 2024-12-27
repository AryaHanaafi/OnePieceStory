<?php
date_default_timezone_set(timezoneId: 'Asia/Jakarta');

$servername = "localhost";
$username = "root";
$password = "";
$db = "webstoryonepiece"; //nama database

//create connection
$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $db);

//check apakah ada error connection
if ($conn->connect_error) {
	//jika ada, hentikan script dan tampilkan pesan error
	die("Connection failed : " . $conn->connect_error);
}
?>