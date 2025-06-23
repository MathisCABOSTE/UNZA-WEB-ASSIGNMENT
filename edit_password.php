<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = 'localhost';
$user = 'providence';
$password = 'bb1wy';
$database = 'Providence';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_user = $_SESSION['user_id'];
    $old_pass = $_POST['old_password'] ?? '';
    $new_pass = $_POST['new_password'] ?? '';
    $confirm_pass = $_POST['confirm_password'] ?? '';

    // check if password are similar
    if ($new_pass !== $confirm_pass) {
        $error = "New passwords do not match.";
    } else {
        // verify former password
        $stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
        $stmt->bind_param("s", $current_user);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        if ($stmt->fetch() && password_verify($old_pass, $hashed_password)) {
            $stmt->close();

            // Chnage the password
            $new_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
            $update->bind_param("ss", $new_hashed, $current_user);
            if ($update->execute()) {
                $success = "Password successfully updated.";
            } else {
                $error = "Error updating password.";
            }
            $update->close();
        } else {
            $error = "Incorrect current password.";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Password - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #06021c;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background-color: #050117;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            color: white;
        }

        .login-box img {
            max-width: 100%;
            height: auto;
            margin-bottom: 30px;
        }

        .login-box input[type="password"] {
            background-color: #fff;
            border: none;
            padding: 12px;
            margin-bottom: 20px;
            width: 100%;
            border-radius: 5px;
        }

        .login-box button {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
        }

        .login-box button:hover {
            background-color: #495057;
        }

        .top-left-home {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }

        .top-left-home .btn-dark {
            background-color: #09032a;
            border-color: #ccc;
            padding: 8px 16px;
            font-weight: bold;
        }

        .error-message {
            color: #ff4d4d;
            margin-top: 15px;
        }

        .success-message {
            color: #66ff99;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="top-left-home">
        <a href="account_settings.php" class="btn btn-dark">Back</a>
    </div>

    <form class="login-box" action="edit_password.php" method="POST">
        <img src="./content/logo_provid3.png" alt="Logo Providence">
        <h4 class="mb-4">Change your password</h4>
        <input type="password" name="old_password" placeholder="Current Password" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
        <button type="submit">Save Changes</button>

        <?php if (!empty($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php elseif (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</body>
</html>
