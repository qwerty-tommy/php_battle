<?php
  require_once('../../../config/login_config.php');
  $bno = $_GET['idx'];
  session_start();
  $uid=$_SESSION['userid'];
  
	if (!$uid) {
		header('Location: ../login/login.php');
		exit();
	}	
  
  if($bno && $_POST['content']){
    $sql = mysqli_query($conn, "insert into reply(post_id,name,content) values('".$bno."','".$uid."','".$_POST['content']."')");
    echo "<script>location.href='../read.php?idx=$bno';</script>";
  }else{
    echo "<script>alert('Something\'s wrong.. :('); 
    history.back();</script>";
  }
	
?>
