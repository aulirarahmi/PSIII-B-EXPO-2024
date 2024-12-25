<?php
// Database connection
$hostname = "db";
$username = "sjkuser";
$password = "sjkpassword";
$database_name = "tubes";

// MySQLi Connection
$db = mysqli_connect($hostname, $username, $password, $database_name);
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

// PDO Connection
try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Function to check admin access
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

// Check connection using MySQLi (optional redundancy)
try {
    $conn = new mysqli($hostname, $username, $password, $database_name);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>
