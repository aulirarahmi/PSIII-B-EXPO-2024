<?php
session_start();
include 'includes/db.php';

$isLoggedIn = isset($_SESSION['user_id']);

require_once 'includes/db.php';

$user_id = $_SESSION['user_id'];
$success_message = '';
$error_message = '';

// Fetch current user data
$stmt = $conn->prepare("SELECT username, email, profile_photo FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Pastikan tipe rambu diterima sebagai parameter GET
if (isset($_GET['tipe'])) {
    $tipe_rambu = $_GET['tipe'];

    // Query untuk mengambil data dari database
    $stmt = $pdo->prepare("SELECT * FROM rambu WHERE tipe_rambu = :tipe");
    $stmt->bindParam(':tipe', $tipe_rambu);
    $stmt->execute();
    $rambu_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} else {
    die("Tipe rambu tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rambu <?= htmlspecialchars($tipe_rambu); ?></title>
    <link rel="stylesheet" href="css/learning.css">
</head>
<body>
    <main>
            <!-- Navbar -->
            <div class="header">
            <div class="logo">
    <a href="index.php">
        <img src="images/CTK LOGO black.png" alt="Logo Traffic Knowledge">
    </a>
</div>

      <!-- Menu navigasi -->
     <div class="nav-menu">
    <div class="dropdown">
        <a href="#learning" class="dropdown-toggle">Learning</a>
        <div class="dropdown-menu">
            <a href="rambu.php?tipe=peringatan">Rambu Peringatan</a>
            <a href="rambu.php?tipe=larangan">Rambu Larangan</a>
            <a href="rambu.php?tipe=petunjuk">Rambu Petunjuk</a>
            <a href="rambu.php?tipe=perintah">Rambu Perintah</a>
        </div>
    </div>
    <a href="quiz.php" class="button">Quiz</a>
    <a href="#about" class="button">About us</a>
</div>
        <!-- Tombol autentikasi -->
        <?php if ($isLoggedIn): ?>
                <!-- Tampilkan foto profil jika sudah login -->
                <div class="profile-container">
            <a href="profile.php">
            <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Foto Profil" class="profile-photo">
            </a>
                <div class="user-logout">
                <a href="logout.php" class="button">Logout</a>
                </div>
            </div>
            <?php else: ?>
                <div class="auth-buttons">
                <a href="login/login.php" class="button">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <section class="grid-container">
    <?php foreach ($rambu_data as $rambu): ?>
    <div class="rambu-item">
        <h2><?= htmlspecialchars($rambu['nama_rambu']); ?></h2>
        <img src="images/<?= htmlspecialchars($rambu['image']); ?>" alt="<?= htmlspecialchars($rambu['nama_rambu']); ?>">
        <p><?= htmlspecialchars($rambu['deskripsi']); ?></p>
    </div>
    <?php endforeach; ?>
</section>

    <footer>
        <p>Created by @PSIII PABW B</p>
    </footer>
    </main>
</body>
</html>
