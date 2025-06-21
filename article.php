<?php
session_start();
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

// Check if user is logged in
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$liked = false;
if ($user_id) {
    $like_check_stmt = $mysqli->prepare("SELECT 1 FROM likes WHERE user_id = ? AND article_id = ?");
    $like_check_stmt->bind_param("si", $user_id, $article_id);
    $like_check_stmt->execute();
    $like_check_stmt->store_result();
    $liked = $like_check_stmt->num_rows > 0;
    $like_check_stmt->close();
}
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
            /* display: flex;
            align-items: center;
            justify-content: center; */
            font-family: Arial, sans-serif;
            padding: 30px;
            display: block;
        }
        .article-box {
            margin: 0 auto;
            background-color: #050117;
            padding: 40px 40px 30px 40px;
            border-radius: 10px;
            text-align: left;
            width: 100%;
            max-width: 850px;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
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
        .heart {
            font-size: 1.5rem;
            color: #ff4d6d;
            vertical-align: middle;
            transition: color 0.2s;
            cursor: pointer;
            user-select: none;
        }
        .heart.liked {
            color: #ff0033;
        }
        .like-card {
            display: inline-flex;
            align-items: center;
            background: #18152b;
            border-radius: 8px;
            padding: 8px 18px 8px 12px;
            box-shadow: 0 2px 8px rgba(102,178,255,0.08);
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
            max-width: 130px;
            width: 100%;
            gap: 10px;
        }
        .like-card .heart {
            margin-right: 7px;
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
        <div class="like-card">
            <button id="like-card-btn" style="background:none;border:none;padding:0;outline:none;cursor:pointer;display:inline-flex;align-items:center;gap:10px;">
                <span class="heart<?php echo $liked ? ' liked' : ''; ?>">
                    <?php echo $liked ? '♥' : '♡'; ?>
                </span>
                <span id="like-count" style="color:#fff;"><?php
                    // Get like count
                    $like_stmt = $mysqli->prepare("SELECT likes FROM articles WHERE article_id = ?");
                    $like_stmt->bind_param("i", $article_id);
                    $like_stmt->execute();
                    $like_stmt->bind_result($likes);
                    $like_stmt->fetch();
                    echo $likes;
                    $like_stmt->close();
                ?></span> <span style="color:#fff;">Likes</span>
            </button>
        </div>
        <a href="javascript:history.back()" class="back-link">← Back</a>
        <script>
        document.getElementById('like-card-btn').onclick = function() {
            fetch('like_article.php?id=<?php echo $article_id; ?>', {method: 'POST'})
            .then(response => response.json())
            .then(data => {
                if(data.login_required) {
                    window.location.href = 'login.php';
                } else if(data.success) {
                    document.getElementById('like-count').textContent = data.likes;
                    // Toggle heart icon
                    const heart = document.querySelector('#like-card-btn .heart');
                    if(data.liked) {
                        heart.textContent = '♥';
                        heart.classList.add('liked');
                    } else {
                        heart.textContent = '♡';
                        heart.classList.remove('liked');
                    }
                } else {
                    alert(data.message || "Error liking article.");
                }
            });
            return false;
        };
        </script>
    </div>
</body>
</html>
<?php
$stmt->close();
$mysqli->close();
?>