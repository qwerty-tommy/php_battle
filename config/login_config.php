<?php
require_once('mysql_info.php');
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$conn) {
    die('DB connection error: ' . mysqli_connect_error());
}
?>

