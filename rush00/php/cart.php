<?php
session_start();
include ("db.php"); 
$conn = connect_db();
$GLOBALS['conn'] = $conn;
mysqli_select_db($conn, $GLOBALS['db_username']);
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<div class="header">
			<a href="../">
				<div id="logo">
					<img id="logo1" src="../src/logo.png" width="10%" />
					<img id="logo2" src="../src/logo2.png" width="20%" />
				</div>
			</a>
			<div class="account">
				<div id="login">
					<form action="" method="POST">
						Username: <input type="text" name="login" value="" /><br />
						Password: <input type="text" name="login" value="" />
						<input type="submit" name="OK" value="OK" />
					</form>
				</div>
				<div>
					<a href="php/register.php">
						<i id="register" class="material-icons">account_circle</i>
						<p>Sign&nbsp;in/ Register</p>
					</a>
				</div>
				<div>
					<a href="">
						<i class="material-icons cart">local_grocery_store</i>
						<p>Cart</p>
					</a>
				</div>
			</div>
		</div>
		<div class="category">
			<a>CART</a>
		</div>
		<div class="title">
			<h1><?php echo $CATEG[$_GET["categ"]][0]; ?></h1>
			<p><?php echo $CATEG[$_GET["categ"]][1]; ?></p>
		</div>
		<div class="flex-container">
			<?php
				echo str_repeat("<div class='item'>
									<img src='src/item1.jpg'/>
									<p>\$NAME</p>
									<a>SKU: \$VAR_SKU</a>
									<p>PRICE: \$VAR_PRICE</p>
								</div>", 122);
			?>
		</div>
	</body>
</html> 