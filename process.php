<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$conn = mysqli_connect('localhost', 'root', '', 'backendsample1');

if (!$conn) {
    echo json_encode(['error' => 'Connection failed']);
    exit;
}

$query = "SELECT * FROM comments";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
mysqli_close($conn);
?>
