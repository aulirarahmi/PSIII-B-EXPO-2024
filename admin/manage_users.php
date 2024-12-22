<?php
session_start();
require_once '../includes/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login/login.php");
    exit();
}

// Handle form submissions for adding/editing/deleting users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                // Ensure password hashing is done here
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $_POST['username'], $_POST['email'], $hashedPassword);
                $stmt->execute();
                
                header("Location: manage_users.php?status=success");
                exit();

            case 'edit':
                // Update user logic here (ensure proper password handling)
                
            case 'delete':
                $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
                $stmt->bind_param("i", $_POST['id']);
                $stmt->execute();
                
                header("Location: manage_users.php?status=deleted");
                exit();
        }
    }
}

// Get all users
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>
<body>

<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <div class='container'>
        <a class='navbar-brand' href='#'>Admin Dashboard</a>
        <div class='navbar-nav'>
            <a class='nav-link' href='manage_rambu.php'>Manage Rambu</a>
            <a class='nav-link' href='manage_questions.php'>Manage Questions</a>
            <a class='nav-link' href='manage_users.php'>Manage Users</a>
            <a class='nav-link' href='../logout.php'>Logout</a>
        </div>
    </div>
</nav>

<div class='container mt-4'>
    <h2>Manage Users</h2>

    <!-- Add New User Form -->
    <!-- You can implement the add user modal similarly as shown in previous examples -->

    <!-- Users List -->
    <table class='table'>
        <thead>
            <tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr></thead><tbody><?php while ($row = $users->fetch_assoc()): ?><tr><td><?php echo $row['id']; ?></td><td><?php echo htmlspecialchars($row['username']); ?></td><td><?php echo htmlspecialchars($row['email']); ?></td><td><button class='btn btn-sm btn-warning' onclick='editUser(<?php echo $row["id"]; ?>)'>Edit</button><button class='btn btn-sm btn-danger' onclick='deleteUser(<?php echo $row["id"]; ?>)'>Delete</button></td></tr><?php endwhile; ?></tbody></table></div>

<!-- JavaScript -->
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>

<!-- JavaScript functions for edit and delete -->
<script>
// Implement editUser function similar to editRambu function
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);

        fetch('manage_users.php', {
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

</body></html>

