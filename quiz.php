<?php
session_start();
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Page</title>
    <link rel="stylesheet" href="assets/css/quiz.css">
</head>
<body>
    <div class="header">
        <!-- Logo website -->
        <div class="logo">
            <img src="images/CTK LOGO black.png" alt="Logo Traffic Knowledge">
        </div>
        <!-- Menu navigasi -->
        <div class="nav-menu">
            <a href="#learning">Learning</a>
            <a href="#quiz.html">Quiz</a>
            <a href="#about">About us</a>
        </div>
        <!-- Tombol autentikasi -->
        <div class="auth-buttons">
            <button class="login-btn">Log in</button>
            <button class="signup-btn">Sign Up</button>
        </div>
    </div>

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