<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="./content/icon_provid.png" />
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
    .profile-box {
      background-color: #050117;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
      color: #fff;
    }
    .profile-box img {
      max-width: 100%;
      height: auto;
      margin-bottom: 30px;
    }
    .profile-box .btn-primary {
      background-color: #343a40;
      border: none;
    }
    .profile-box .btn-primary:hover {
      background-color: #495057;
    }
    .profile-box .btn-danger {
      background-color: #ff4d4d;
      border: none;
    }
    .profile-box .btn-danger:hover {
      background-color: #e60000;
    }
    .top-left-home {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 1000;
    }
  </style>
</head>
<body>
  <div class="top-left-home">
    <a href="index.php">
      <img src="./content/providball.gif" height="200" alt="Home">
    </a>
  </div>
  <div class="profile-box">
    <img src="./content/logo_provid3.png" alt="Logo Providence">
    <?php if (isset($_SESSION['user_id'])): ?>
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h2>
    <?php else:
      header("Location: login.php");
      exit();
    endif; ?>
    <p class="mt-4 mb-4">Manage your profile settings below.</p>
    <a href="edit_username.php" class="btn btn-primary me-2 mb-2">Edit Username</a>
    <a href="edit_password.php" class="btn btn-primary me-2 mb-2">Edit Password</a>
    <a href="logout.php" class="btn btn-danger mb-2">Disconnect</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
