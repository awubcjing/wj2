<?php
// display_messages.php
if (file_exists("messages.txt")) {
    // 读取文件内容
    $messages = file_get_contents("messages.txt");
    echo "<h2>留言板</h2>";
    echo "<div class='messages'>$messages</div>";
}
?>