<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'dokan';
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
$conn->set_charset("utf8");
?>