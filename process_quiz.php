<?php
include 'includes/db.php';

$query = $pdo->query("SELECT * FROM questions");
$questions = $query->fetchAll(PDO::FETCH_ASSOC);

$userAnswers = $_POST;
$score = 0;

foreach ($questions as $question) {
    $qid = $question['id'];
    $correctAnswer = $question['correct_answer'];

    if (isset($userAnswers["q$qid"]) && $userAnswers["q$qid"] === $correctAnswer) {
        $score++;
    }
}

$totalQuestions = count($questions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <main class="container">
        <h1>Hasil Kuis</h1>
        <p>Skor Anda: <?php echo $score; ?> dari <?php echo $totalQuestions; ?></p>
        <a href="index.php" class="auth-button"><button>Kembali ke Quiz</button></a>
    </main>
</body>
</html>
