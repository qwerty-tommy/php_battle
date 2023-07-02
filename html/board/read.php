<!doctype html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../style/style_read.css">
	<title>post</title>
</head>
<body>
	<div id="wrapper-full">
		<h4><a href="board.php">←Back</a></h4>
		<?php
		session_start();
		if (!isset($_SESSION['userid'])) {
			header('Location: ../login/login.php');
			exit();
		}	
		require_once('../../config/login_config.php');
		$bno = $_GET['idx'];
		$hit = mysqli_fetch_array(mysqli_query($conn, "select * from board where idx ='$bno'"));
		$hit = $hit['hit'] + 1;
		$fet = mysqli_query($conn, "update board set hit = '$hit' where idx = '$bno'");
		$sql = mysqli_query($conn, "select * from board where idx='$bno'");
		$board = $sql->fetch_array();
		$sql2=mysqli_query($conn, "select * from file where board_num='$bno'");
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
				<a href="/var/www/upload/<?php echo $file['file'];?>" download><?php echo $file['file']; ?></a>
				<br>
			<?php			
			}	
			?>
			<div id="user_info">
				<?php echo $board['name'];?> <?php echo $board['date']; ?> Hit:<?php echo $board['hit']; ?>
			</div>
			<div id="bo_ser" class="wrapper-button">
				<a class="button-edit" href="ck_modify.php?idx=<?php echo $board['idx']; ?>">edit</a>
				<a class="button-delete" href="ck_delete.php?idx=<?php echo $board['idx']; ?>">delete</a>
			</div>
		</div>
		
		<!--- reply list start-->
	
		<?php
		$sql3 = mysqli_query($conn, "select * from reply where post_id='$bno' order by idx desc");
		while($reply = $sql3->fetch_array()){ 
		?>
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
		<?php 
		} 
		?>

		<!--- reply input form start-->
		
		<div class="card">
			<form action="reply/reply_ok.php?idx=<?php echo $bno; ?>" method="post">
				<div style="margin-top:-10px; ">
					<textarea style="height: 20vw; " name="content" class="reply_content" id="re_content" placeholder="Content"></textarea>
				</div>
				<div class="wrapper-button">
					<button id="rep_bt" class="re_bt">reply</button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
