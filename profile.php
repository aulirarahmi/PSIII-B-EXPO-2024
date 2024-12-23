<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    // Validate inputs
    if (empty($username) || empty($email)) {
        $error_message = "Username dan email harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid!";
    } elseif (!empty($new_password) && $new_password != $confirm_password) {
        $error_message = "Password baru dan konfirmasi password tidak cocok!";
    } else {
        // Handle profile photo upload
        $profile_photo_sql = "";
        $profile_photo_path = $user['profile_photo'];
        
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['profile_photo']['name'];
            $filetype = pathinfo($filename, PATHINFO_EXTENSION);
            
            if (!in_array(strtolower($filetype), $allowed)) {
                $error_message = "Hanya file gambar (JPG, JPEG, PNG, GIF) yang diperbolehkan!";
            } else {
                // Create unique filename
                $new_filename = uniqid() . '.' . $filetype;
                $upload_path = 'images/' . $new_filename;
                
                if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $upload_path)) {
                    // Delete old profile photo if it's not the default
                    if ($user['profile_photo'] != 'images/default-avatar.png' && file_exists($user['profile_photo'])) {
                        unlink($user['profile_photo']);
                    }
                    $profile_photo_path = $upload_path;
                    $profile_photo_sql = ", profile_photo = ?";
                } else {
                    $error_message = "Gagal mengupload foto profil!";
                }
            }
        }

        if (empty($error_message)) {
            // Update user data
            if (empty($new_password)) {
                $query = "UPDATE users SET username = ?, email = ?" . $profile_photo_sql . " WHERE id = ?";
                $stmt = $conn->prepare($query);
                if (empty($profile_photo_sql)) {
                    $stmt->bind_param("ssi", $username, $email, $user_id);
                } else {
                    $stmt->bind_param("sssi", $username, $email, $profile_photo_path, $user_id);
                }
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE users SET username = ?, email = ?, password = ?" . $profile_photo_sql . " WHERE id = ?";
                $stmt = $conn->prepare($query);
                if (empty($profile_photo_sql)) {
                    $stmt->bind_param("sssi", $username, $email, $hashed_password, $user_id);
                } else {
                    $stmt->bind_param("ssssi", $username, $email, $hashed_password, $profile_photo_path, $user_id);
                }
            }
            
            if ($stmt->execute()) {
                $success_message = "Profil berhasil diperbarui!";
                // Update session data
                $_SESSION['username'] = $username;
                $_SESSION['profile_photo'] = $profile_photo_path;
                
                // Refresh user data after update
                $user['profile_photo'] = $profile_photo_path;
                $user['username'] = $username;
                $user['email'] = $email;
            } else {
                $error_message = "Gagal memperbarui profil!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <a href="dashboard.php" class="text-xl font-bold">Dashboard</a>
                </div>
                <div class="relative group">
                    <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" 
                         alt="Profile" 
                         class="w-10 h-10 rounded-full cursor-pointer object-cover"
                         id="profile-photo">
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden group-hover:block z-50">
                        <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Edit Profil</h1>
        
        <?php if ($success_message): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="profile.php" enctype="multipart/form-data">
            <!-- Profile Photo Preview -->
            <div class="mb-6">
                <div class="flex items-center space-x-6">
                    <div class="shrink-0">
                        <img class="h-16 w-16 object-cover rounded-full"
                             src="<?php echo htmlspecialchars($user['profile_photo']); ?>"
                             alt="Current profile photo" />
                    </div>
                    <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input type="file"
                               name="profile_photo"
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100"/>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="<?php echo htmlspecialchars($user['username']); ?>" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?php echo htmlspecialchars($user['email']); ?>" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                    Password Baru (kosongkan jika tidak ingin mengubah)
                </label>
                <input type="password" 
                       id="new_password" 
                       name="new_password" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                    Konfirmasi Password Baru
                </label>
                <input type="password" 
                       id="confirm_password" 
                       name="confirm_password" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between space-x-4">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan Perubahan
                </button>
                <a href="index.php" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>