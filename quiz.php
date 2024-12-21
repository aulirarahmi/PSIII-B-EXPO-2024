<?php
session_start();
include 'includes/db.php';
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
    <title>Quiz Page</title>
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>
<div class="header">
        <!-- Logo website -->
        <nav class="navbar">
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
    <a href="quiz.php">Quiz</a>
    <a href="#about">About us</a>
</div>
        <!-- Tombol autentikasi -->
        <?php if ($isLoggedIn): ?>
                <!-- Tampilkan foto profil jika sudah login -->
                 <img src="images/profile.jpg" alt="Profile" class="profile-photo">
                <div class="user-logout">
                <a href="logout.php">Logout</a>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                <a href="login/login.php">Login</a>
                <a href="login/login.php">Sign Up</a>
                </div>
            <?php endif; ?>       
        </div>
    </nav>
    <!-- Main Content -->
    <main class="container">
        <h1>QUIZ, NANTI DI DESAIN</h1>
            <div class="quiz-container">
            <?php
$query = $pdo->query("SELECT * FROM questions");
$questions = $query->fetchAll();

foreach ($questions as $index => $question) {
    echo '<div class="question">';
    echo '<h3>' . ($index + 1) . '. ' . htmlspecialchars($question['question_text']) . '</h3>';
    echo '<div class="options">';
    echo '<label class="option">';
    echo '<input type="radio" name="q' . $question['id'] . '" value="A">';
    echo 'A. ' . htmlspecialchars($question['option_a']);
    echo '</label>';
    echo '<label class="option">';
    echo '<input type="radio" name="q' . $question['id'] . '" value="B">';
    echo 'B. ' . htmlspecialchars($question['option_b']);
    echo '</label>';
    echo '<label class="option">';
    echo '<input type="radio" name="q' . $question['id'] . '" value="C">';
    echo 'C. ' . htmlspecialchars($question['option_c']);
    echo '</label>';
    echo '<label class="option">';
    echo '<input type="radio" name="q' . $question['id'] . '" value="D">';
    echo 'D. ' . htmlspecialchars($question['option_d']);
    echo '</label>';
    echo '</div>';
    echo '</div>';
}
?>

<form id="quizForm" method="POST">
    <!-- Pertanyaan dan opsi radio -->
    <button type="submit">Submit Jawaban</button>
</form>

    </main>

    <!-- Footer -->
    <div class="footer">
        <p>create by @PSIII PABW B</p>
    </div>

    <script src="quiz.js"></script>
</body>
</html>