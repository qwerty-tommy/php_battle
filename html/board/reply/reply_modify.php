<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
</head>
<body>
  <?php
    require_once('../../../config/login_config.php');
    require_once('../../../config/input_config.php');
    $rno = sanitize_input($conn, $_GET['rno']);
    $bno = sanitize_input($conn, $_GET['bno']);
		$sql = mysqli_query($conn, "select * from reply where idx='$rno' and con_num='$bno'");
		$reply = $sql->fetch_array();
	?>
  <div>
    <form method="post" action="reply_modify_ok.php">
      <input type="hidden" name="rno" value="<?php echo $rno; ?>"/><input type="hidden" name="bno" value="<?php echo $bno; ?>">
      <input type="password" name="pw" placeholder="비밀번호"/>
      <textarea name="content"><?php echo $reply["content"]; ?></textarea>
      <input type="submit" value="수정하기">
    </form>
  </div>
</body>
</html>
