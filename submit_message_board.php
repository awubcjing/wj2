<?php
// submit_message_board.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $name = strip_tags($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = strip_tags($_POST['message']);
    
    // 准备文件路径
    $filePath = "messages.txt";
    
    // 写入文件
    if (!empty($name) && !empty($email) && !empty($message)) {
        $data = "Name: $name\nEmail: $email\nMessage: $message\n\n\n";
        if (file_put_contents($filePath, $data, FILE_APPEND | LOCK_EXCL) !== false) {
            echo "留言已保存。";
        } else {
            echo "保存留言时出错。";
        }
    } else {
        echo "所有字段都是必填项。";
    }
}
?>