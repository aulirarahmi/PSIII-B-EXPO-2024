<?php
// db_connect.php
$hostname = "localhost";
$username = "root";  // sesuaikan dengan username database Anda
$password = "";      // sesuaikan dengan password database Anda
$database_name = "tubes"; // nama database Anda

$db = mysqli_connect($hostname, $username, $password, $database_name);
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tubes', 'root', ''); // Ganti dengan kredensial Anda
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

if ($db->connect_error) {
    echo "koneksi database rusak";
}

?>