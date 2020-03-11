<?php
session_start();
include("db.php");

$conn = connect_db();
$GLOBALS["conn"] = $conn;
mysqli_select_db($conn, $GLOBALS["dbuser"]);


if ($_SESSION["username"])
{
    session_destroy();
    unset($_SESSION['username']);
    // clear_cart_table($conn);
}
header("location: ../");
?>