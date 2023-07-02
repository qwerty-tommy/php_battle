<?php
	$username = $_POST['name'];
	$userpw = $_POST['pw'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$maxfilesize = (int)$_POST['MAX_FILE_SIZE']; 
	$upload_count = count($_FILES['b_file']['name']);

	$special_pattern = "/[`~@#$%^&*|\\\'\";:\/?^=^+_()<>]/";
	if( preg_match($special_pattern, $username)||preg_match($special_pattern, $userpw)||preg_match($special_pattern, $content)||preg_match($special_pattern, $title)||preg_match($special_pattern, $maxfilesize) ){ 
		echo "<script>
		alert('Attack Detected! :(');
		history.back();</script>"; 
		exit;      
	}

	if($upload_count>5){ 
		echo "<script>
		alert('File can only be uploaded up to 5 at a time.');
		history.back();</script>";
		exit;              
	}

	for($i=0;$i<$upload_count;$i++){
		$filename = $_FILES['b_file']['name'][$i];

		$ext = explode(".", strtolower($filename),2);

		if(!($ext[1]==null)&&!($ext[1]=="txt"||$ext[1]=="png"||$ext[1]=="jpg")){
			echo "<script>
			alert('Unsupported extension :(');
			history.back();</script>"; 
			exit;	
		}     
		if($_FILES['b_file']['size'][$i] > $maxfilesize){ 
		    echo "<script>
			alert(($i+1)+'st file has exceeded the maximum file size limit!');
			history.back();</script>";
			exit;              
		}
	}
	
	require_once('../../config/login_config.php');
	mysqli_query($conn, "INSERT INTO board (name, pw, title, content, date, hit) VALUES ('$username', '$userpw', '$title', '$content', NOW(), 0)"); 

	$sql=mysqli_query($conn, "select max(idx) from board");
	$sql2=mysqli_fetch_row($sql);
	$board_num=(int)$sql2[0];

	for($i=0;$i<$upload_count;$i++){   
		$tmpfile =  $_FILES['b_file']['tmp_name'][$i];
		$filename = $_FILES['b_file']['name'][$i];
		$folder = "../../upload/".$filename;
		move_uploaded_file($tmpfile,$folder);
		mysqli_query($conn, "insert into file(idx, board_num, file) values(0,'$board_num','$filename')");
	}
?>
<script type="text/javascript">
    alert("Post ok!");
    location.href = "board.php";
</script>

