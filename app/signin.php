<?php
require_once 'config.php';

// Start session to store messages
session_start();

// Connect to MySQL
$conn = new mysqli($dbhost, $dbuser, $dbpassword, $database);

// Check connection
if ($conn->connect_error) {
    die("Error connecting to the database: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Every field has to be filled.";
    } elseif (!preg_match('/^\w+$/', $username)) {
        $error = "Username can only contain letters, numbers, and underscores.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords not matching.";
    } elseif (strlen($username) > 15){ 
        $error = "Username can only be 15 character long or shorter.";
    } else {
        // Check if username already exists
        $check = $conn->prepare("SELECT LOWER(user_id) FROM users WHERE user_id = LOWER(?)");
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "An account already has this username.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (user_id, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                // Registration successful
                header("Location: login.php?success=1");
                exit();
            } else {
                $error = "Sign in error, please try again.";
            }
            $stmt->close();
        }
        $check->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Inscription - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="genrstyle.css">
</head>
<body>
    <div class="top-left-home">
        <a href="index.php" class="btn btn-dark">Home</a>
    </div>

    <form class="signin-box" action="signin.php" method="POST">
        <img src="./content/logo_provid3.png" alt="Logo Providence">
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <input type="text" name="username" placeholder="Username" required value="<?php if (!empty($username)) echo htmlspecialchars($username); ?>">
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm password" required>
        <button type="submit">Sign In</button>
    </form>

</body>
</html>