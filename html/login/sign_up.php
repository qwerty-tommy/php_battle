<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Sign up</title>
	<link rel="stylesheet" href="../style/style_login.css">
	<script>
		function validateForm() {
		  var userid = document.getElementById("userid").value;
		  var userpw = document.getElementById("userpw").value;
		  var errorContainer = document.getElementById("error-messages");
		  var errorMessages = [];

		  if (userid.length < 6) {
		    errorMessages.push("Username must be at least 6 characters long.");
			}

			if (userpw.length < 8) {
				  errorMessages.push("Password must be at least 8 characters long.");
			}

			if (!/[!@#$%^&*]/.test(userpw)) {
					errorMessages.push("Password must include at least one special character.\nspecial character : !@#$%^&*");
			}

		  errorContainer.innerHTML = errorMessages.join("<br>");

		  if (errorMessages.length > 0) {
		    errorContainer.style.display = "block";
		    return false;
		  } else {
		    errorContainer.style.display = "none";
		    return true;
		  }
		}
	</script>
</head>
<body>
	<form method="post" action="sign_up_ok.php" onsubmit="return validateForm()">
		<h1>Sign-up</h1>
		<fieldset>
			<table>
				<tr>
					<td>ID</td>
					<td><input type="text" size="35" name="userid" id="userid" placeholder="id" required></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" size="35" name="userpw" id="userpw" placeholder="pw" required></td>
				</tr>
			</table>
			<input type="submit" value="Go!" />		
		</fieldset>
		<div class="error-container">
			<span id="error-messages"></span>
		</div>
	</form>
</body>
</html>

