<?php
require_once('../../config/login_config.php');

for ($i = 1; $i <= 1000; $i++) {
    $title = "paging test title$i";
    $content = "paging test content$i";
    
    $sql = "INSERT INTO board (title, name, content, date, hit) VALUES ('$title', 'admin', '$content', NOW(), 0)";
    mysqli_query($conn, $sql);
}

echo '<script> history.go(-1);</script>';
?>

