<?php
include '../includes/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loginMessage = '';
$registerMessage = '';

// Process Login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Use password_verify for hashed passwords
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            
            // Debug log
            error_log("Login successful for user: " . $user['username'] . " with admin status: " . $user['is_admin']);
            
            // Redirect based on user type
            if ($user['is_admin'] == 1) {
                header("Location: ../admin/dashboard.php");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        } else {
            $loginMessage = "Invalid password";
        }
    } else {
        $loginMessage = "User not found";
    }
}


// Process Registration
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        $registerMessage = "Passwords do not match";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $registerMessage = "Username or email already exists";
        } else {
            // Hash password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            
            if ($stmt->execute()) {
                $loginMessage = "Registration successful! Please login.";
            } else {
                $registerMessage = "Registration failed. Please try again.";
            }
        }
    }
}

// If user is already logged in and is admin, redirect to admin dashboard
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    header("Location: ../admin/admin_dashboard.php");
    exit();
} elseif (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<!-- Rest of your HTML remains the same -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Sign in & Sign up Form</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="login.php" method="POST" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <?php if (!empty($loginMessage)) { ?>
                        <p class="error-message"> <?php echo $loginMessage; ?> </p>
                    <?php } ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="email" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" name="login" value="Login" class="btn solid" />
                </form>
                <form action="login.php" method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <?php if (!empty($registerMessage)) { ?>
                        <p class="error-message"> <?php echo $registerMessage; ?> </p>
                    <?php } ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirmPassword" placeholder="Confirm Password" required />
                    </div>
                    <input type="submit" name="register" value="Sign up" class="btn" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        .
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                       .
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>
</html>