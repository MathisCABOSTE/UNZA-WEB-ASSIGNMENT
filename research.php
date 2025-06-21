<?php
// Connect to the database
$mysqli = new mysqli("localhost", "providence", "bb1wy", "Providence");
if ($mysqli->connect_errno) {
    http_response_code(500);
    echo "Database connection failed.";
    exit();
}

// Get the search input
$search = isset($_GET['si']) ? trim($_GET['si']) : '';
if ($search === '') {
    echo "Please enter a search term.";
    exit();
}

// Prepare and execute the query
$stmt = $mysqli->prepare("SELECT article_id, title, author, content, likes, datetime FROM articles WHERE title LIKE CONCAT('%', ?, '%') OR content LIKE CONCAT('%', ?, '%') ORDER BY datetime DESC LIMIT 10");
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "No articles found.";
    $stmt->close();
    $mysqli->close();
    exit();
}

echo "Provid provided you {$stmt->num_rows} results for search '" . htmlspecialchars($search) . "'<br><br>";

// Add datetime to bind_result
$stmt->bind_result($article_id, $title, $author, $content, $likes, $datetime);

// Helper function for "time ago"
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp + 60 * 60 * 2; // Adjust for timezone difference (2 hours)

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
    echo "    <span class='badge bg-primary'>Likes: " . htmlspecialchars($likes) . "</span>";
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