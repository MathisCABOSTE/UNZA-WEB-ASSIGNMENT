<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

// Database connection parameters
$host = 'localhost';
$user = 'providence';
$password = 'bb1wy';
$dbname = 'Providence';

// Connect to MySQL
$conn = new mysqli($host, $user, $password, $dbname);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $author = $_SESSION['user_id'];

  if ($title && $content) {
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO articles (title, content, author) VALUES (?, ?, ?)");
    if ($stmt) {
      $stmt->bind_param("sss", $title, $content, $author);
      if ($stmt->execute()) {
        $message = '<div class="alert alert-success mt-3">Article published successfully!</div>';
      } else {
        $message = '<div class="alert alert-danger mt-3">Error: ' . htmlspecialchars($stmt->error) . '</div>';
      }
      $stmt->close();
    } else {
      $message = '<div class="alert alert-danger mt-3">Error: ' . htmlspecialchars($conn->error) . '</div>';
    }
  } else {
    $message = '<div class="alert alert-warning mt-3">Please fill in all fields.</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    .article-box {
      background-color: #050117;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
      color: #fff;
    }
    .article-box img {
      max-width: 100%;
      height: auto;
      margin-bottom: 30px;
    }
    .article-box .form-control,
    .article-box textarea {
      background-color: #18122b;
      color: #fff;
      border: 1px solid #343a40;
      margin-bottom: 20px;
    }
    .article-box .form-control:focus,
    .article-box textarea:focus {
      background-color: #23203a;
      color: #fff;
      border-color: #495057;
    }
    .article-box .btn-primary {
      background-color: #343a40;
      border: none;
    }
    .article-box .btn-primary:hover {
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
  </style>
</head>
<body>
  <div class="top-left-home">
    <a href="index.php" class="btn btn-dark">Home</a>
  </div>
  <div class="article-box">
    <img src="./content/logo_provid3.png" alt="Logo Providence">
    <h2 class="fw-bold mb-3" style="color: #f1f1f1;">Create Article :</h2>
    <?php if ($message) echo $message; ?>
    <form method="post" action="create_article.php">
      <div class="mb-3 text-start">
        <label for="title" class="form-label">Article Title</label>
        <input type="text" class="form-control" id="title" name="title" required maxlength="150" placeholder="Enter article title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
      </div>
      <div class="mb-4 text-start">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="8" required placeholder="Write your article here..."><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100">Publish Article</button>
    </form>
  </div>
</body>
</html>