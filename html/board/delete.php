<?php	
session_start();
$uid=$_SESSION['userid'];
if (!isset($uid)) {
	header('Location: ../login/login.php');
	exit();
}	
$bno = $_GET['bno'];
require_once('../../config/login_config.php');
$sql = mysqli_query($conn, "select name from board where idx='$bno';");
$board = $sql->fetch_array();
if($uid==$board['name']){
	mysqli_query($conn, "delete from board where idx='$bno';");
	mysqli_query($conn, "delete from reply where post_id='$bno';");
	mysqli_query($conn, "delete from `file` where post_id='$bno';");
	echo "<script>location.href='./board.php';</script>";
}else{
	echo "<script type='text/javascript'>alert('Authenticationfailed.. :(');history.back();</script>";
}?>	
