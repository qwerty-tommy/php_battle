<!doctype html>
<head>
  <link rel="stylesheet" href="../style/style_write.css">
  <meta charset="UTF-8">
  <title>board</title>
  <?php
	session_start();
	if (!isset($_SESSION['userid'])) {
		header('Location: ../login/login.php');
		exit();
	}
	?>	
  <script>
    function handleFileSelect(event) {
      var input = event.target;
      var fileName = input.files[0].name;
      var fileNameDisplay = document.getElementById("file-name-display");
      fileNameDisplay.textContent = fileName;
    }
  </script>
</head>
<body>
  <div id="board_write">
  	<div id="container-back">
  		<h4><a href="board.php">←Back</a></h4>
  	</div>
    <h4>Upload posting</h4>
    <div id="write_area">
      <form action="write_ok.php" method="post" enctype="multipart/form-data">
        <hr>
        <div id="in_file">
				  <label for="file-upload" class="custom-file-upload">Upload File</label>
				  <input type="file" id="file-upload" name="b_file[]" multiple="multiple" style="display:none;" onchange="handleFileSelect(event)">
				  <span class="file-name" id="file-name-display"></span>
				</div>
		    <div id="in_title">
		      <textarea name="title" id="utitle" rows="1" cols="55" placeholder="Title" maxlength="100" required></textarea>
		    </div>
		    <div id="in_content">
		      <textarea name="content" id="ucontent" placeholder="Content" required></textarea>
		    </div>
		    <div id="in_submit">
		    	<button type="submit">Go!</button>
		    </div>
      </form>
    </div>
  </div>
</body>
</html>

