<html>
<head>
</head>
<body>
	<fieldset>
		<div class="container">
			<legend>Login Page</legend>

			<!-- launching login_service file for validating and login the user -->

			<form action="login_service.php" method="POST"><br><br>
				Username:<input type="text" required="" name="uname"><br><br>
				Password:<input type="text" required="" name="upassword"><br><br>
				<input type="submit" value="Login" name="sub">
				<br>
				<?php
				if (isset($_REQUEST["err"]))
					$msg = "Invalid username or Password";
				?>
				<p style="color:red;">
					<?php if (isset($msg)) {
						echo $msg;
					}
					?>
				</p>

			</form>
		</div>
	</fieldset>
</body>

</html>