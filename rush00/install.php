<?php
include ("php/db.php");

$conn = connect_db();
$GLOBALS['conn'] = $conn;
mysqli_select_db($conn, $GLOBALS['db_username']);

if (table_exists($conn, 'users') === FALSE)
    create_table_users($conn);
if (table_exists($conn, 'items') === FALSE)
    create_table_items($conn);
if (table_exists($conn, 'categories') === FALSE)
    create_table_categories($conn);
if (table_exists($conn, 'baskets') === FALSE)
    create_table_baskets($conn);
?>
