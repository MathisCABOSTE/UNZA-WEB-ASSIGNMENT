<?php
require_once 'config.php';

// Start session
session_start();

$conn = new mysqli($dbhost, $dbuser, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login success
                $_SESSION['user_id'] = $user['user_id'];

                // Checks if user is admin
                $stmt = $conn->prepare("SELECT user_id FROM admins WHERE user_id = ?");
                if ($stmt) {
                    $stmt->bind_param("s", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows === 1) {
                        $admin = $result->fetch_assoc();
                        $_SESSION['admin'] = $admin['user_id'];
                    }
                header("Location: index.php"); // Redirect to dashboard
                exit();
                }
            } else {
                // Incorrect password
                $error =  "Invalid username or password.";
            }
        } else {
            // user_id not found
            $error = "Invalid username or password.";
        }

        $stmt->close();
    } else {
        $error =  "Database error.";
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="genrstyle.css">
</head>
<body>
    <div class="top-left-home">
        <a href="index.php" class="btn btn-dark">Home</a>
    </div>


    <form class="login-box" action="login.php" method="POST">
        <img src="./content/logo_provid3.png" alt="Logo Providence">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <p style="margin-bottom: 20px; text-align: left;">
            <a href="signin.php" style="color: #66b2ff; text-decoration: none; font-size: 0.9rem;">
                Create an account
            </a>
        </p>

        <button type="submit">Login</button>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>

</body>
</html>