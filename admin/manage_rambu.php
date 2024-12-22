<?php
require_once '../includes/db.php';
checkAdminAccess();

// Handle form submissions for adding/editing/deleting rambu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                // Handle file upload
                $target_dir = "../images/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    // Prepare and execute insert statement
                    $stmt = $conn->prepare("INSERT INTO rambu (nama_rambu, tipe_rambu, image, deskripsi) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $_POST['nama_rambu'], $_POST['tipe_rambu'], $_FILES["image"]["name"], $_POST['deskripsi']);
                    $stmt->execute();

                    // Redirect after successful insertion
                    header("Location: manage_rambu.php?status=success");
                    exit(); // Important to stop script execution after redirection
                } else {
                    echo "Error uploading file.";
                }
                break;

            case 'edit':
                // Check if an image is uploaded
                if (!empty($_FILES["image"]["name"])) {
                    // Handle file upload if a new image is provided
                    $target_dir = "../images/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        // Update statement with new image
                        $stmt = $conn->prepare("UPDATE rambu SET nama_rambu=?, tipe_rambu=?, image=?, deskripsi=? WHERE id=?");
                        $stmt->bind_param("ssssi", $_POST['nama_rambu'], $_POST['tipe_rambu'], $_FILES["image"]["name"], $_POST['deskripsi'], $_POST['id']);
                    } else {
                        echo "Error uploading file.";
                    }
                } else {
                    // Update statement without changing the image
                    $stmt = $conn->prepare("UPDATE rambu SET nama_rambu=?, tipe_rambu=?, deskripsi=? WHERE id=?");
                    $stmt->bind_param("sssi", $_POST['nama_rambu'], $_POST['tipe_rambu'], $_POST['deskripsi'], $_POST['id']);
                }

                if ($stmt->execute()) {
                    header("Location: manage_rambu.php?status=updated");
                    exit();
                }
                break;

            case 'delete':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
                        // Fetch the image filename from the database
                        $stmt = $conn->prepare("SELECT image FROM rambu WHERE id = ?");
                        $stmt->bind_param("i", $_POST['id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $image_filename = $row['image'];
                            $image_path = "../images/" . $image_filename;
                
                            // Attempt to delete the image file
                            if (file_exists($image_path)) {
                                if (unlink($image_path)) {
                                    echo "File deleted successfully.";
                                } else {
                                    echo "Failed to delete file.";
                                }
                            } else {
                                echo "File does not exist.";
                            }
                
                            // Delete the rambu from the database
                            $stmt = $conn->prepare("DELETE FROM rambu WHERE id = ?");
                            $stmt->bind_param("i", $_POST['id']);
                            if ($stmt->execute()) {
                                echo "Rambu deleted successfully.";
                                header("Location: manage_rambu.php?status=deleted");
                                exit();
                            } else {
                                echo "Failed to delete rambu.";
                            }
                        } else {
                            echo "Rambu not found.";
                        }
                    }
                }
            }
        }
    }
                // Get all rambu
                $rambu = $conn->query("SELECT * FROM rambu ORDER BY id DESC");
                ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rambu</title>
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
    <!-- Add your navigation here -->
    
    <div class="container mt-4">
    <h2>Manage Rambu</h2>
    
    <!-- Back to Dashboard Button -->
    <a href="dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    
    <!-- Add New Rambu Form -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRambuModal">Add New Rambu</button>
    
    <!-- Rambu List -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Rambu</th>
                <th>Tipe</th>
                <th>Image</th>
                <th>Deskripsi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $rambu->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama_rambu']; ?></td>
                <td><?php echo $row['tipe_rambu']; ?></td>
                <td><img src="uploads/<?php echo $row['image']; ?>" width="50"></td>
                <td><?php echo $row['deskripsi']; ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editRambu(<?php echo $row['id']; ?>)">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteRambu(<?php echo $row['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

    
   <!-- Add Modal -->
<div class="modal fade" id="addRambuModal" tabindex="-1" aria-labelledby="addRambuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRambuModalLabel">Add New Rambu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRambuForm" enctype="multipart/form-data" method="POST">
                    <div class="mb-3">
                        <label for="nama_rambu" class="form-label">Nama Rambu</label>
                        <input type="text" class="form-control" name="nama_rambu" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipe_rambu" class="form-label">Tipe Rambu</label>
                        <input type="text" class="form-control" name="tipe_rambu" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Add Rambu</button>
                </form>
            </div>
        </div>
    </div>
</div>

    
    <!-- Edit Modal -->
<div class="modal fade" id="editRambuModal" tabindex="-1" aria-labelledby="editRambuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRambuModalLabel">Edit Rambu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editRambuForm" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" id="editRambuId"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="edit_nama_rambu" class="form-label">Nama Rambu</label>
                        <input type="text" class="form-control" name="nama_rambu" id="edit_nama_rambu" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_tipe_rambu" class="form-label">Tipe Rambu</label>
                        <input type="text" class="form-control" name="tipe_rambu" id="edit_tipe_rambu" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="edit_image">
                        <small>Leave blank if you don't want to change the image.</small>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="edit_deskripsi" required></textarea>
                    </div>
                    <button type="submit" name="action" value="edit" class="btn btn-primary">Update Rambu</button>
                </form>
            </div>
        </div>
    </div>
</div>


    
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>

    <script>
function deleteRambu(id) {
    if (confirm("Are you sure you want to delete this rambu?")) {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', id);

        fetch('manage_rambu.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Optionally handle success or error messages
            location.reload(); // Reload the page to see changes
        })
        .catch(error => console.error('Error:', error));
    }

    function editRambu(id) {
    console.log("Edit button clicked for ID:", id); // Debugging line

    // Fetch existing rambu data
    fetch('get_rambu.php?id=' + id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched Data:", data); // Debugging line
            if (data && Object.keys(data).length > 0) {
                // Populate modal fields with existing data
                document.getElementById('editRambuId').value = data.id;
                document.getElementById('edit_nama_rambu').value = data.nama_rambu;
                document.getElementById('edit_tipe_rambu').value = data.tipe_rambu;
                document.getElementById('edit_deskripsi').value = data.deskripsi;

                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('editRambuModal'));
                myModal.show();
            } else {
                console.error("No data found for ID:", id);
            }
        })
        .catch(error => console.error('Error fetching rambu data:', error));
}


}
</script>

</body>
</html>