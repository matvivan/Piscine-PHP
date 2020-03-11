<?php
include ('connect_db.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<div class="register">
			<div>
				<a href='../index.php'>
					<img id="logo1" src="../src/logo.png" width="10%" />
					<img id="logo2" src="../src/logo2.png" width="20%" />
				</a>
			</div>
			<h1 style='font-size:larger'>Create New Customer Account</h1>
			<p style='font-size:smaller'>Creating an account is easy. Just fill in the form below.</p>
			<div>
				<div id="login">
					<form action="register.php" method="POST">
						<p>email or login: </p>
						<input type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>" />
						<p>set a magic word: </p>
						<input type="password" name="passwd" placeholder="Enter password" />
						<p>and again: </p>
						<input type="password" name="passwd2" placeholder="Confirm password" value=""><br />
						<input type="submit" name="register" value="REGISTER" />
						<p><?php include('errors.php'); ?></p>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

