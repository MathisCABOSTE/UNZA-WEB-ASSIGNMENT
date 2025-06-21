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

// Check if already liked
$stmt = $mysqli->prepare("SELECT 1 FROM likes WHERE user_id = ? AND article_id = ?");
$stmt->bind_param("si", $user_id, $article_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Unlike: remove like and decrement count
    $stmt->close();
    $delete = $mysqli->prepare("DELETE FROM likes WHERE user_id = ? AND article_id = ?");
    $delete->bind_param("si", $user_id, $article_id);
    $delete->execute();
    $delete->close();

    $update = $mysqli->prepare("UPDATE articles SET likes = GREATEST(likes - 1, 0) WHERE article_id = ?");
    $update->bind_param("i", $article_id);
    $update->execute();
    $update->close();

    $like_stmt = $mysqli->prepare("SELECT likes FROM articles WHERE article_id = ?");
    $like_stmt->bind_param("i", $article_id);
    $like_stmt->execute();
    $like_stmt->bind_result($likes);
    $like_stmt->fetch();
    $like_stmt->close();

    echo json_encode(['success' => true, 'liked' => false, 'likes' => $likes, 'message' => 'Like removed']);
    $mysqli->close();
    exit();
}
$stmt->close();

// Like: insert like and increment count
$insert = $mysqli->prepare("INSERT INTO likes (user_id, article_id) VALUES (?, ?)");
$insert->bind_param("si", $user_id, $article_id);
$insert->execute();
$insert->close();

$update = $mysqli->prepare("UPDATE articles SET likes = likes + 1 WHERE article_id = ?");
$update->bind_param("i", $article_id);
$update->execute();
$update->close();

$like_stmt = $mysqli->prepare("SELECT likes FROM articles WHERE article_id = ?");
$like_stmt->bind_param("i", $article_id);
$like_stmt->execute();
$like_stmt->bind_result($likes);
$like_stmt->fetch();
$like_stmt->close();

echo json_encode(['success' => true, 'liked' => true, 'likes' => $likes, 'message' => 'Article liked']);
$mysqli->close();
?>