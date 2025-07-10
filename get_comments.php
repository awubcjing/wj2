<?php
// get_comments.php
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$sql = "SELECT c.id, c.name, c.comment, c.created_at, COUNT(l.id) AS likes_count 
        FROM comments c 
        LEFT JOIN likes l ON c.id = l.comment_id 
        GROUP BY c.id 
        ORDER BY c.created_at DESC";
$result = $conn->query($sql);

$comments = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}

echo json_encode($comments);
$conn->close();
?>