<?php
$servernameku = "localhost";
$username = "root";
$dbname = "quiz";
$password = "private";

// Create connection

$conn = mysqli_connect($servernameku, $username, $password, $dbname);


return new PDO("mysql:host=$servernameku;dbname=$dbname", $username, $password, array (
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));

// Check connection
if (!$conn) {
  die("koneksi gagal: " . mysqli_connect_error());
}
?>
