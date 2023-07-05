<?php
require_once('../../config/login_config.php');

mysqli_query($conn,"DELETE FROM board");
mysqli_query($conn,"DELETE FROM `file`");
mysqli_query($conn,"DELETE FROM reply");

echo '<script> history.go(-1);</script>';
?>

