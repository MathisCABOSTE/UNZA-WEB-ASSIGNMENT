<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'login_required' => true,
        'message' => 'You must be logged in to like articles.'
    ]);
    exit();
}

$mysqli = new mysqli("localhost", "providence", "bb1wy", "Providence");
if ($mysqli->connect_errno) {
    echo json_encode(['success' => false, 'message' => 'DB error']);
    exit();
}

$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($article_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid article ID']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Toggle like
if (!isset($_SESSION['liked_articles'])) {
    $_SESSION['liked_articles'] = [];
}
$liked = isset($_SESSION['liked_articles'][$article_id]) && $_SESSION['liked_articles'][$article_id] === true;

if ($liked) {
    // Unlike
    $_SESSION['liked_articles'][$article_id] = false;
    $mysqli->query("UPDATE articles SET likes = likes - 1 WHERE article_id = $article_id");
    $liked = false;
} else {
    // Like
    $_SESSION['liked_articles'][$article_id] = true;
    $mysqli->query("UPDATE articles SET likes = likes + 1 WHERE article_id = $article_id");
    $liked = true;
}

// Get new like count
$result = $mysqli->query("SELECT likes FROM articles WHERE article_id = $article_id");
$row = $result->fetch_assoc();

echo json_encode([
    'success' => true,
    'likes' => $row['likes'],
    'liked' => $liked
]);
$mysqli->close();
?>