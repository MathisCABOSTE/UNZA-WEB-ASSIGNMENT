<?php
// Connect to the database
$mysqli = new mysqli("localhost", "providence", "bb1wy", "Providence");
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo "Database connection failed.";
    exit();
}

// Get the article ID from the URL
$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($article_id <= 0) {
    echo "Invalid article ID.";
    exit();
}

// Prepare and execute the query
$stmt = $mysqli->prepare("SELECT title, author, datetime, content FROM articles WHERE article_id = ?");
$stmt->bind_param("i", $article_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "Article not found.";
    $stmt->close();
    $mysqli->close();
    exit();
}

$stmt->bind_result($title, $author, $datetime, $content);
$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($title); ?> - Providence</title>
    <link rel="icon" type="image/png" href="./content/icon_provid.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #06021c;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .article-box {
            background-color: #050117;
            padding: 40px 40px 30px 40px;
            border-radius: 10px;
            text-align: left;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.15);
            color: #fff;
        }
        .article-title {
            font-size: 2.3rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #66b2ff;
        }
        .article-meta {
            color: #b0b0b0;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
        .article-content {
            font-size: 1.15rem;
            line-height: 1.7;
            color: #f3f3f3;
            margin-bottom: 2rem;
        }
        .back-link {
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 12px 28px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s;
        }
        .back-link:hover {
            background-color: #495057;
            color: #66b2ff;
            text-decoration: none;
        }
        @media (max-width: 800px) {
            .article-box {
                padding: 25px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="article-box">
        <div class="article-title"><?php echo htmlspecialchars($title); ?></div>
        <div class="article-meta">
            By <b><?php echo htmlspecialchars($author); ?></b> | <?php echo htmlspecialchars($datetime); ?>
        </div>
        <div class="article-content">
            <?php echo nl2br(htmlspecialchars($content)); ?>
        </div>
        <div style="margin-bottom: 1.5rem;">
            <button id="like-btn" class="back-link" style="margin-right:10px;">👍 Like</button>
            <span id="like-count"><?php
                // Get like count
                $like_stmt = $mysqli->prepare("SELECT likes FROM articles WHERE article_id = ?");
                $like_stmt->bind_param("i", $article_id);
                $like_stmt->execute();
                $like_stmt->bind_result($likes);
                $like_stmt->fetch();
                echo $likes;
                $like_stmt->close();
            ?></span> Likes
        </div>
        <a href="javascript:history.back()" class="back-link">← Back</a>
        <script>
        document.getElementById('like-btn').onclick = function() {
            fetch('like_article.php?id=<?php echo $article_id; ?>', {method: 'POST'})
            .then(response => response.json())
            .then(data => {
                if(data.login_required) {
                    window.location.href = 'login.php';
                } else if(data.success) {
                    document.getElementById('like-count').textContent = data.likes;
                } else {
                    alert(data.message || "Error liking article.");
                }
            });
        };
        </script>
    </div>
</body>
</html>
<?php
$stmt->close();
$mysqli->close();
?>