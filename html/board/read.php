<!doctype html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../style/style_read.css">
	<title>post</title>
</head>
<body>
	<div id="nav">
	  <?php
	  session_start();
	  $uid=$_SESSION['userid'];
	  if (isset($uid)) {
      echo '<a href="./logout.php">Logout :(</a>';
		  echo '<a id="hello-name">'.$uid.'</a>';
	  } else {
      echo '<a href="../login/login.php">Login:)</a>';
	  }
	  ?>
	</div>
	<div id="wrapper-full">
		<h4><a href="board.php">←Back</a></h4>
		<!-- <h4><a href="javascript:history.go(-1)">←Back</a></h4> -->
		<?php
		session_start();
		if (!isset($uid)) {
			header('Location: ../login/login.php');
			exit();
		}	
		require_once('../../config/login_config.php');
		require_once('../../config/input_config.php');
		$bno = sanitize_input($conn, $_GET['idx']);
		$hit = mysqli_fetch_array(mysqli_query($conn, "select * from board where idx ='$bno'"));
		$hit = $hit['hit'] + 1;
		$fet = mysqli_query($conn, "update board set hit = '$hit' where idx = '$bno'");
		$sql = mysqli_query($conn, "select * from board where idx='$bno'");
		$board = $sql->fetch_array();
		$sql2=mysqli_query($conn, "select file_name from file where post_id='$bno'");
		?>
		
		<!--- main post start-->
		
		<div class="post_view card">
			<h2><?php echo $board['title']; ?></h2>
			<div id="bo_line"></div>
			<div id="bo_content">
				<?php echo nl2br("$board[content]"); ?>
			</div>
			<?php
			while($file= mysqli_fetch_array($sql2)) {
			?>
				<a href="../upload/<?php echo $file['file_name'];?>" download><?php echo $file['file_name']; ?></a>
				<br>
			<?php			
			}	
			?>
			<div id="user_info">
				<?php echo $board['name'];?> <?php echo $board['date']; ?> Hit:<?php echo $board['hit']; ?>
			</div>
			<div id="bo_ser" class="wrapper-button">
        <a class="button-edit" href="edit.php?bno=<?php echo $board['idx']; ?>">edit</a>
        <a class="button-delete" href="delete.php?bno=<?php echo $board['idx']; ?>">delete</a>
    	</div>
		</div>
		
		<!--- reply list start-->
	
		<?php
		$sql3 = mysqli_query($conn, "select * from reply where post_id='$bno' order by idx desc");
		while($reply = $sql3->fetch_array()){ 
		?>
		<div>
			<div class="reply_view card">
				<div>
					<h4><?php echo nl2br("$reply[content]");?></h4>
				</div>
				<div id="user_info">
					<?php echo $reply['name'];?> <?php echo $reply['date']; ?>
				</div>
				<div class="wrapper-button">
					<a class="button-edit" href="reply/reply_modify.php?rno=<?php echo $reply['idx']; ?>">edit</a>
					<a class="button-delete" href="reply/reply_delete.php?rno=<?php echo $reply['idx']; ?>">delete</a>
				</div>
			</div>
		</div>
		<?php 
		} 
		?>

		<!--- reply input form start-->
		
		<div class="card">
			<form action="reply/reply_ok.php?idx=<?php echo $bno; ?>" method="post">
				<div style="margin-top:-10px; ">
					<textarea name="content" class="reply_content" id="re_content" placeholder="Content"></textarea>
				</div>
				<div class="wrapper-button">
					<button id="rep_bt" class="re_bt">reply</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
