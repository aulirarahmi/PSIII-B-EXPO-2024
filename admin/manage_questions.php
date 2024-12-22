<?php
session_start();
require_once '../includes/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

// Handle form submissions for adding/editing/deleting questions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
                $stmt->bind_param("s", $_POST['question_text']);
                $stmt->execute();
                header("Location: manage_questions.php?status=success");
                exit();
                
            case 'edit':
                $stmt = $conn->prepare("UPDATE questions SET question_text=? WHERE id=?");
                $stmt->bind_param("si", $_POST['question_text'], $_POST['id']);
                $stmt->execute();
                header("Location: manage_questions.php?status=success");
                exit();

            case 'delete':
                $stmt = $conn->prepare("DELETE FROM questions WHERE id=?");
                $stmt->bind_param("i", $_POST['id']);
                $stmt->execute();
                header("Location: manage_questions.php?status=deleted");
                exit();
        }
    }
}

// Get all questions
$questions = $conn->query("SELECT * FROM questions ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
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
        <h2>Manage Questions</h2>

        <!-- Add New Question Form -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addQuestionModal">Add New Question</button>

        <!-- Questions List -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $questions->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['question_text']); ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editQuestion(<?php echo $row['id']; ?>)">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteQuestion(<?php echo $row['id']; ?>)">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add Question Modal -->
        <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQuestionModalLabel">Add New Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="question_text" class="form-label">Question Text</label>
                                <input type="text" class="form-control" name="question_text" required>
                            </div>
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="btn btn-primary">Add Question</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Question Modal -->
        <!-- You can implement the edit modal similarly as shown in previous examples -->

    </div>

    <!-- JavaScript -->
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>

    <!-- JavaScript functions for edit and delete -->
    <script>
    function editQuestion(id) {
        // Implement fetch logic to get question details and populate the edit modal
    }

    function deleteQuestion(id) {
        if (confirm("Are you sure you want to delete this question?")) {
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', id);

            fetch('manage_questions.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                location.reload(); // Reload to see changes
            })
            .catch(error => console.error('Error:', error));
        }
    }
    </script>

</body>
</html>

