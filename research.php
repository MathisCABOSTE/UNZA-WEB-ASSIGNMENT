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
$stmt = $mysqli->prepare("SELECT article_id, title, author, content FROM articles WHERE title LIKE CONCAT('%', ?, '%') OR content LIKE CONCAT('%', ?, '%') ORDER BY datetime DESC LIMIT 10");
$stmt->bind_param("ss", $search, $search);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "No articles found.";
    $stmt->close();
    $mysqli->close();
    exit();
}

// Add this line to show the number of results and the search term
echo "Provid provided you {$stmt->num_rows} results for search '" . htmlspecialchars($search) . "'<br><br>";

$stmt->bind_result($article_id, $title, $author, $content);

// Output results as clickable cards
while ($stmt->fetch()) {
    $preview = htmlspecialchars(mb_substr($content, 0, 120)) . (mb_strlen($content) > 120 ? "..." : "");
    echo "<a href='article.php?id=" . urlencode($article_id) . "' style='text-decoration:none;color:inherit;'>";
    echo "<div class='card mb-3' style='cursor:pointer;'>";
    echo "  <div class='card-body'>";
    echo "    <h2 class='card-title' style='font-size:2rem;'>" . htmlspecialchars($title) . "</h2>"; // Changed from h5 to h2 and increased font size
    echo "    <h6 class='card-subtitle mb-2 text-muted'>By <b>" . htmlspecialchars($author) . "</b></h6>";
    echo "    <p class='card-text'>" . $preview . "</p>";
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