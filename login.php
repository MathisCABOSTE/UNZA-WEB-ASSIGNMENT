<!DOCTYPE html>
<html lang="en">
<?php
// Start session
session_start();

// Database connection
$host = 'localhost';        // Update with your DB host
$user = 'providence';     // Update with your DB user
$password = 'bb1wy'; // Update with your DB password
$database = 'Providence'; // Update with your DB name

$conn = new mysqli($host, $user, $password, $database);

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
                header("Location: index.php"); // Redirect to dashboard
                exit();
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
<head>
    <meta charset="UTF-8">
    <title>Connexion - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #050117;
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
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .login-box img {
            max-width: 100%;
            height: auto;
            margin-bottom: 30px;
        }

        .login-box input[type="text"],
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

        .error-message {
            color: #ff4d4d;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>
    <div class="top-left-home">
        <a href="index.php">
            <img src="./content/providball.gif" height="200" alt="Home">
        </a>
    </div>


    <form class="login-box" action="login.php" method="POST">
        <img src="./content/logo_provid3.png" alt="Logo Providence">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Se connecter</button>
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>

</body>
</html>