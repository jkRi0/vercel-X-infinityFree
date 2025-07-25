<?php 
// Database connection
$db = new mysqli('localhost', 'root', '', 'backendsample1');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Add new comment
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["comment"])) {
    $comment = $db->real_escape_string($_POST["comment"]);
    $query = "INSERT INTO comments (comment_text) VALUES ('$comment')";
    
    if (!$db->query($query)) {
        echo "Error: " . $db->error;
    }
}

// Retrieve all comments
$query = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $db->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment-box'>";
        echo htmlspecialchars($row["comment_text"]);
        echo "<div class='timestamp'>" . $row["created_at"] . "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No comments yet.</p>";
}

$db->close();
?>