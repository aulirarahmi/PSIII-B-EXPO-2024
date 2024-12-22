<?php
session_start();
require_once '../includes/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="navbar-nav">
                <a class="nav-link" href="manage_rambu.php">Manage Rambu</a>
                <a class="nav-link" href="manage_questions.php">Manage Questions</a>
                <a class="nav-link" href="manage_users.php">Manage Users</a>
                <a class="nav-link" href="../logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Statistics Cards -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <?php
                        $user_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
                        echo "<p class='card-text'>{$user_count}</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Rambu</h5>
                        <?php
                        $rambu_count = $conn->query("SELECT COUNT(*) as count FROM rambu")->fetch_assoc()['count'];
                        echo "<p class='card-text'>{$rambu_count}</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Questions</h5>
                        <?php
                        $question_count = $conn->query("SELECT COUNT(*) as count FROM questions")->fetch_assoc()['count'];
                        echo "<p class='card-text'>{$question_count}</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>