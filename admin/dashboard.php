<?php
session_start();

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Selamat datang, Admin!</h1>
    <p>Ini adalah halaman dashboard admin.</p>
    <a href="../logout.php">Logout</a>
</body>
</html>
