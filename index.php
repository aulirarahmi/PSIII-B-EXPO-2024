<?php
session_start();

// Periksa apakah pengguna sudah login, jika belum, arahkan ke halaman login
$isLoggedIn = isset($_SESSION['user_id']);

// Sekarang Anda dapat mengakses data pengguna dari session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null; // Atur nilai default jika session belum ada
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civic Traffic Knowledge-2</title>
    <!-- Menghubungkan dengan file CSS -->
    <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="images/CTK LOGO black.png" alt="Logo Traffic Knowledge">
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
                <img src="images/profile.jpg" alt="Foto Profil" class="profile-photo">
                <div class="user-logout">
                <a href="logout.php" class="button">Logout</a>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                <a href="login/login.php">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bagian hero -->
    <div class="hero">
        <div class="hero-content">
            <h1>Civic Traffic Knowledge</h1>
            <p>Dapatkan pembelajaran interaktif mengenai rambu - rambu lalu lintas</p>
        </div>
    </div>

    <!-- Bagian Learning -->
    <div class="learning-section" id="learning">
        <h2>Learning</h2>
        <div class="learning-content">
            <!-- Daftar jenis rambu -->
            <div class="sign-list">  
                <!-- rambu peringatan -->
                <div class="sign-item">
                    <a href="rambu.php?tipe=peringatan" style="display: contents;">>
                        <img src="images/RambuPeringatan.png" alt="Rambu Peringatan" class="sign-icon">
                        <button class="sign-button">Rambu Peringatan</button>
                    </a>
                </div>

                <!-- rambu larangan -->
                <div class="sign-item">

                    <a href="rambu.php?tipe=Larangan" style="display: contents;">
                        <img src="images/RambuLarangan.png" alt="Rambu Larangan" class="sign-icon">
                        <button class="sign-button">Rambu Larangan</button>
                    </a>

                </div>

                <!-- rambu petunjuk -->
                <div class="sign-item">
                     <a href="rambu.php?tipe=petunjuk" style="display: contents;">
                        <img src="images/RambuPetunjuk.png" alt="Rambu Petunjuk" class="sign-icon">
                        <button class="sign-button">Rambu Petunjuk</button>
                    </a>
                </div>

                <!-- rambu perintah -->
                <div class="sign-item">
                    <a href="rambu.php?tipe=perintah" style="display: contents;">
                        <img src="images/RambuPerintah.png" alt="Rambu perinta" class="sign-icon">
                        <button class="sign-button">Rambu Perintah</button>
                    </a>
                </div>

            </div>
            <!-- Preview gambar rambu -->
            <div class="sign-preview">
                <img src="images/learningImage.png" alt="Preview Rambu">
            </div>
        </div>
    </div>

    <!-- Bagian kuis preview-->
    <div class="quiz-section" id="quiz">
        <div class="quiz-content">
            <div class="quiz-image">
                <img src="images/quizImage.png" alt="Quiz Icon">
            </div>
            <div class="quiz-text">
                <h2>Let's Answer some Quiz</h2>
                <p>Uji pemahaman anda mengenai rambu rambu lalu lintas</p>
                <div class="arrow">→</div>
            </div>
        </div>
    </div>

    <!-- Bagian tentang kami -->
    <div class="about-section" id="about">
        <h2>Get To Know About Us</h2>
        <div class="team-members">
            <div class="member">
                <img src="images/aesthetic.jpg" alt="Aulira">
                <h3>Aulira</h3>
                <p>ini untuk teks ini untuk teks</p>
            </div>
            <div class="member">
                <img src="images/aesthetic.jpg" alt="Lingga">
                <h3>Lingga</h3>
                <p>ini untuk teks ini untuk teks</p>
            </div>
            <div class="member">
                <img src="images/aesthetic.jpg" alt="Adhi">
                <h3>Adhi</h3>
                <p>ini untuk teks ini untuk teks</p>
            </div>
            <div class="member">
                <img src="images/aesthetic.jpg" alt="Putra">
                <h3>Putra</h3>
                <p>ini untuk teks ini untuk teks</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>create by @PSIII PABW B</p>
    </div>

    <script src="script2.js"></script>
</body>
</html>