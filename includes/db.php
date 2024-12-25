<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tubes";
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


// db.php

// Only define if not already defined
if (!function_exists('checkAdminAccess')) {
    function checkAdminAccess() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
            header("Location: login.php");
            exit();
        }
    }
}



try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>