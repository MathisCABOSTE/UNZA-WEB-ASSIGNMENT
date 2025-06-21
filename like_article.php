<?php
session_start();

$mysqli = new mysqli("localhost", "providence", "bb1wy", "Providence");

$article_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$user_id = $_SESSION['user_id'];

// Toggle like
$liked = false;
if ($user_id) {
    $like_check_stmt = $mysqli->prepare("SELECT 1 FROM likes WHERE user_id = ? AND article_id = ?");
    $like_check_stmt->bind_param("si", $user_id, $article_id);
    $like_check_stmt->execute();
    $like_check_stmt->store_result();
    $liked = $like_check_stmt->num_rows > 0;
    $like_check_stmt->close();
}

if ($liked) {
    // Unlike
    $mysqli->query("UPDATE articles SET likes = likes - 1 WHERE article_id = $article_id");
    // Remove like from likes table
    $stmt = $mysqli->prepare("DELETE FROM likes WHERE user_id = ? AND article_id = ?");
    $stmt->bind_param("si", $user_id, $article_id);
    $stmt->execute();
    $stmt->close();
    $liked = false;
} else {
    // Like
    $stmt = $mysqli->query("UPDATE articles SET likes = likes + 1 WHERE article_id = $article_id");
    // Add like to likes table
    $stmt = $mysqli->prepare("INSERT INTO likes (user_id, article_id) VALUES (?, ?)");
    $stmt->bind_param("si", $user_id, $article_id);
    $stmt->execute();
    $stmt->close();
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