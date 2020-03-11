<?php
session_start();
include("database.php");
require_once("auth.php");
?>
<html>
    <head>
        <title>42 Millenium</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta name='author' content='matvivan'>
    </head>
    <body>
    <div id="login">
        <h1>42 Millenium</h1>
        <form action="" method="POST">
            <output id="error"><?php echo $error_login; ?></output><br>
            <input type="text" name="login" placeholder="login"><br>
            <input type="password" name="passwd" placeholder="password"><br>
            <input type="submit" name="submit" value="LOGIN">
        </form>
        <hr>
        <h2>SIGN IN OR DIE</h2>
        <form action="" method="POST">
            <output id="error"><?php echo $error_signup; ?></output><br>
            <input type="text" name="login" placeholder="login"><br>
            <input type="password" name="passwd" placeholder="password"><br>
            <input type="password" name="rp_passwd" placeholder="repeat password"><br>
            <input type="submit" name="submit" value="REGISTRATION">
        </form>
    </div>
    </body>
</html>