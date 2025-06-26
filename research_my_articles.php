<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_SESSION['admin'])){
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];    
    }
}

// Connect to the database
$mysqli = new mysqli("localhost", "providence", "bb1wy", "Providence");
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo "Database connection failed.";
    exit();
}

$query = "SELECT a.article_id, a.title, a.author, a.content, a.likes, a.datetime
          FROM articles a
          WHERE a.author LIKE \"$user_id\"
          ";
$params = [$user_id];
$types = "s";

$query .= " ORDER BY a.datetime DESC LIMIT 10;";

$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    if ((isset($_SESSION['admin'])) && (isset($_GET['id']))) {
        echo "@$user_id wrote no articles.";
    } else {
        echo "You wrote no articles.";
    }
    $stmt->close();
    $mysqli->close();
    exit();
}

if (isset($_SESSION['admin'])){
    echo "@$user_id wrote {$stmt->num_rows} articles.<br><br>";
} else {
    echo "You wrote {$stmt->num_rows} articles.<br><br>";
}

$stmt->bind_result($article_id, $title, $author, $content, $likes, $datetime);

// Helper function for "time ago"
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 60) {
        $unit = ($diff == 1) ? "second" : "seconds";
        return $diff . " $unit ago";
    }
    $diff = round($diff / 60);
    if ($diff < 60) {
        $unit = ($diff == 1) ? "minute" : "minutes";
        return $diff . " $unit ago";
    }
    $diff = round($diff / 60);
    if ($diff < 24) {
        $unit = ($diff == 1) ? "hour" : "hours";
        return $diff . " $unit ago";
    }
    $diff = round($diff / 24);
    if ($diff < 7) {
        $unit = ($diff == 1) ? "day" : "days";
        return $diff . " $unit ago";
    }
    $diff = round($diff / 7);
    if ($diff < 4) {
        $unit = ($diff == 1) ? "week" : "weeks";
        return $diff . " $unit ago";
    }
    return date("M d, Y", $timestamp);
}

// Output results as clickable cards
while ($stmt->fetch()) {
    $preview = htmlspecialchars(mb_substr($content, 0, 120)) . (mb_strlen($content) > 120 ? "..." : "");
    $ago = timeAgo($datetime);
    echo "<a href='article.php?id=" . urlencode($article_id) . "' style='text-decoration:none;color:inherit;'>";
    echo "<div class='card mb-3' style='cursor:pointer;'>";
    echo "  <div class='card-body'>";
    echo "    <h2 class='card-title' style='font-size:2rem;'>" . htmlspecialchars($title) . "</h2>";
    echo "    <h6 class='card-subtitle mb-2 text-muted'>By <b>" . htmlspecialchars($author) . "</b> &middot; <span style='font-weight:normal;'>$ago</span></h6>";
    echo "    <p class='card-text'>" . $preview . "</p>";
    echo "    <span class='badge bg-dark'>Likes: " . htmlspecialchars($likes) . "</span>";
    echo "  </div>";
    echo "</div>";
    echo "</a>";
}

$stmt->close();
$mysqli->close();
?>
<style>
.card.mb-3 {
    transition: background-color 0.2s;
}
.card.mb-3:hover {
    background-color: #f8f9fa;
}
</style>