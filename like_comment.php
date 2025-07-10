<?php
// like_comment.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_id = intval($_POST['comment_id']);
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // 连接数据库
    $conn = new mysqli("localhost", "username", "password", "database");

    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 检查是否已经点赞
    $stmt = $conn->prepare("SELECT * FROM likes WHERE comment_id = ? AND ip_address = ?");
    $stmt->bind_param("is", $comment_id, $ip_address);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // 插入点赞记录
        $stmt = $conn->prepare("INSERT INTO likes (comment_id, ip_address) VALUES (?, ?)");
        $stmt->bind_param("is", $comment_id, $ip_address);
        $stmt->execute();
        echo "点赞成功！";
    } else {
        echo "您已经点过赞了！";
    }

    $stmt->close();
    $conn->close();
}
?>