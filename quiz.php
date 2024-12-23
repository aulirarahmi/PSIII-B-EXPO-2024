<?php
session_start();
include 'includes/db.php';

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);

// Access user data from session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Initialize variables for score and total questions
$score = 0;
$totalQuestions = 0;

// Check if questions are already in session
if (!isset($_SESSION['questions'])) {
    // Fetch 20 random questions from the database and store in session
    $query = $pdo->query("SELECT * FROM questions ORDER BY RAND() LIMIT 20");
    $_SESSION['questions'] = $query->fetchAll();
}

$questions = $_SESSION['questions']; // Load questions from session

// Handle quiz submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($questions as $question) {
        // Increment total questions count
        $totalQuestions++;

        // Check if the answer is correct
        if (isset($_POST['q' . $question['id']]) && $_POST['q' . $question['id']] === $question['correct_answer']) {
            $score++;
        }
    }

    // Calculate percentage score
    $percentageScore = ($score / $totalQuestions) * 100;

    // Store score in session to display after redirect
    $_SESSION['score'] = $score;
    $_SESSION['totalQuestions'] = $totalQuestions;
    $_SESSION['percentageScore'] = $percentageScore;

    // Redirect to avoid form resubmission
    header("Location: quiz.php");
    exit();
}

// Display score if available in session
if (isset($_SESSION['score'])) {
    $score = $_SESSION['score'];
    $totalQuestions = $_SESSION['totalQuestions'];
    $percentageScore = $_SESSION['percentageScore'];

    // Clear score from session after displaying (optional)
    unset($_SESSION['score'], $_SESSION['totalQuestions'], $_SESSION['percentageScore']);
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
                <img src="images/default_avatar.jpg" alt="Foto Profil" class="profile-photo">
                <div class="user-logout">
                <a href="logout.php" class="button">Logout</a>
                </div>
            <?php else: ?>
                <div class="auth-buttons">
                <a href="login/login.php" class="button">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Main Content -->
    <main class="container">
        <?php if ($score > 0): ?>
            <!-- Display Score -->
            <h2>Your Score: <?= htmlspecialchars($score); ?> out of <?= htmlspecialchars($totalQuestions); ?> (<?= htmlspecialchars(round($percentageScore, 2)); ?>%)</h2>
        <?php endif; ?>

        <!-- Display Questions -->
        <h1>Selamat Mengerjakan</h1>
        <form id="quizForm" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <div class="question">
                    <h3><?= ($index + 1) . '. ' . htmlspecialchars($question['question_text']); ?></h3>
                    <div class="options">
                        <label class="option">
                            <input type="radio" name="<?= 'q' . htmlspecialchars($question['id']); ?>" value="A">
                            A. <?= htmlspecialchars($question['option_a']); ?>
                        </label>
                        <label class="option">
                            <input type="radio" name="<?= 'q' . htmlspecialchars($question['id']); ?>" value="B">
                            B. <?= htmlspecialchars($question['option_b']); ?>
                        </label>
                        <label class="option">
                            <input type="radio" name="<?= 'q' . htmlspecialchars($question['id']); ?>" value="C">
                            C. <?= htmlspecialchars($question['option_c']); ?>
                        </label>
                        <label class="option">
                            <input type="radio" name="<?= 'q' . htmlspecialchars($question['id']); ?>" value="D">
                            D. <?= htmlspecialchars($question['option_d']); ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn-submit">Submit Jawaban</button>
        </form>
    </main>

    <!-- Footer -->
    <div class='footer'>
        <p>Created by @PSIII PABW B</p>
    </div>

</body>
</html>

