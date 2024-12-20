<?php
session_start(); // Memulai sesi
session_destroy(); // Menghapus semua data sesi
header("Location: index.php");
exit();
?>
