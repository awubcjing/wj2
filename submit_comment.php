<?php
// submit_comment.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $comment = strip_tags($_POST['comment']);

    if (!empty($name) && !empty($email) && !empty($comment)) {
        // 连接数据库
        $conn = new mysqli("localhost", "username", "password", "database");

        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        }

        // 插入评论
        $stmt = $conn->prepare("INSERT INTO comments (name, email, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $comment);
        $stmt->execute();

        echo "评论已提交！";
        $stmt->close();
        $conn->close();
    } else {
        echo "所有字段都是必填项。";
    }
}
?>