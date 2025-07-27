<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'backendsample1');
if (!$conn) {
    echo json_encode(['error' => 'Connection failed']);
    exit;
}


//PHP TO JAVASCRIPT
//USING OBJECT
header("Content-Type: application/javascript");
$try1="test";
echo "var dataFromPHP = {'asd':'$try1'};";

//USING ARRAY, retrieve comments from database
echo "let phpComments = [];";
$query = "SELECT * FROM comments";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $commentCol = $row['comment_text'];
    echo "phpComments.push('$commentCol');";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment = $_POST['comment'] ?? '';
    if(($_POST['submit'] ?? '')=="1"){
        if (!empty($comment)) {
            // Prepare the comment to prevent SQL injection
            $comment = mysqli_real_escape_string($conn, $comment);
            
            // Insert the comment
            $query = "INSERT INTO comments (comment_text, created_at) VALUES ('$comment', NOW())";
            
            if (mysqli_query($conn, $query)) {
                //DEVELOPMENT
                header("location: http://127.0.0.1:5500/index.html");

                //PRODUCTION
                // header("location: https://vercel-x-infinity-free.vercel.app/");
            } else {
                echo json_encode(['error' => 'Failed to add comment: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['error' => 'Comment cannot be empty']);
        }
    }else{
        echo "Here is the other action";
    }
    
    
}

mysqli_close($conn);
?>
