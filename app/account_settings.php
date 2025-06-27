<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>User Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="./content/icon_provid.png" />
  <link rel="stylesheet" href="genrstyle.css">
</head>
<body>
  <div class="top-left-home">
    <a href="index.php" class="btn btn-dark">Home</a>
  </div>
  
  <div class="top-right-admin"> 
    <?php if (isset($_SESSION['admin'])): ?> 
      <a href="admin-panel.php" class="btn btn-dark">Access Admin Panel</a> 
  	<?php endif; ?> 
  </div>

  <div class="profile-box">
    <img src="./content/logo_provid3.png" alt="Logo Providence">
    <?php if (isset($_SESSION['user_id'])): ?>
      <h2 class="fw-bold mb-3" style="color: #66b2ff;">Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?>!</h2>
    <?php else:
      header("Location: login.php");
      exit();
    endif; ?>
    <p class="lead text-light mb-4" style="opacity: 0.8;">Access your account info & settings using the tools below.</p>

    <div class="button-group d-flex flex-column align-items-center gap-3 mt-4">
      <a href="my_articles.php" class="btn btn-primary w-100">My Articles</a>
      <a href="liked_articles.php" class="btn btn-primary w-100">Liked Articles</a>
      <a href="edit_password.php" class="btn btn-dark w-100">Edit Password</a>
      <a href="logout.php" class="btn btn-danger w-100">Disconnect</a>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
