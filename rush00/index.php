<?php
session_start();
include ("php/db.php"); 
$conn = connect_db();
$GLOBALS['conn'] = $conn;
mysqli_select_db($conn, $GLOBALS['db_username']);
$CATEG = array("newborn" => array("Toys for young infants—birth through 6 months", "Babies like to look at people—following them with their eyes. Typically, they prefer faces and bright colors. Babies can reach, be fascinated with what their hands and feet can do, lift their heads, turn their heads toward sounds, put things in their mouths, and much more!"),
	"infant" => array("Toys for older infants—7 to 12 months", "Older babies are movers—typically they go from rolling over and sitting, to scooting, bouncing, creeping, pulling themselves up, and standing. They understand their own names and other common words, can identify body parts, find hidden objects, and put things in and out of containers."),
	"1 year" => array("Toys for 1-year-olds", "One-year-olds are on the go! Typically they can walk steadily and even climb stairs. They enjoy stories, say their first words, and can play next to other children (but not yet with!). They like to experiment—but need adults to keep them safe."),
	"toddler" => array("Toys for 2-year-olds (toddlers)", "Toddlers are rapidly learning language and have some sense of danger. Nevertheless they do a lot of physical “testing”: jumping from heights, climbing, hanging by their arms, rolling, and rough-and-tumble play. They have good control of their hands and fingers and like to do things with small objects."),
	"preschool/kids" => array("Toys for 3- to 6-year-olds (preschoolers and kindergarteners)", "Preschoolers and kindergartners have longer attention spans than toddlers. Typically they talk a lot and ask a lot of questions. They like to experiment with things and with  their still-emerging physical skills. They like to play with friends—and don’t like to lose! They can take turns—and sharing one toy by two or more children is often possible  for older preschoolers and kindergarteners."));
// $CATEG = 
?>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	</head>
	<body>
		<div class="header">
			<div id="logo">
				<a href='index.php'>
					<img id="logo1" src="src/logo.png" width="10%" />
					<img id="logo2" src="src/logo2.png" width="20%" />
				</a>
			</div>
			<div class="account">
				<?php 
					if (!$_SESSION['username']) {
						echo ('
								<div id="login-form">
									<form action="index.php" method="POST">
										<input type="text" name="username" placeholder="username" value="" /><br />
										<input type="password" name="passwd" placeholder="password" value="" />
										<input id="login" type="submit" name="login" value="LOGIN" />
									</form>
									<a href="php/register.php"><button id="register">REGISTER</button></a>
								</div>');
					}
					else {
						echo ('
							<div id="logout">
								<form action="php/logout.php" method="POST">
									<i class="material-icons">account_circle</i>
									<input type="submit" name="logout" value="LOGOUT">
								</form>
							</div>');
					}
				?>
				<div>
					<a href="">
						<i class="material-icons cart">local_grocery_store</i>
						<p>Cart</p>
					</a>
				</div>
			</div>
		</div>
		<div class="category">
			<?php
			$color = "style='color:#15325C' ";
				foreach ($CATEG as $NAME => $VAL)
					if ($_GET['categ'] === $NAME)
						echo "<a $color href='?categ=$NAME'>$NAME</a>";
					else
						echo "<a href='?categ=$NAME'>$NAME</a>";
			?>
		</div>
		<div class="title">
			<h1><?php 
				if ($_GET['categ'])
					echo $CATEG[$_GET["categ"]][0]; 
				else
					echo "<img src='src/landing.jpg' />";
				?></h1>
			<p><?php echo $CATEG[$_GET["categ"]][1]; ?></p>
		</div>
		<div class="flex-container">
			<?php
				echo str_repeat("<div class='item'>
								<form method='POST' action='php/addtocart'>
									<img src='src/item1.jpg'/>
									<p>\$NAME</p>
									<p>PRICE: \$VAR_PRICE</p>
									<input type='submit' name='buy' value='BUY'>
								</form>
								</div>", 12);
			?>
		</div>
	</body>
</html> 