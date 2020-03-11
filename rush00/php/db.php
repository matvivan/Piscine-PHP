<?php
$GLOBALS['server'] = 'remotemysql.com:3306';
$GLOBALS['db_username'] = 'LaWsYh3Pc4';
$GLOBALS['db_passwd'] = 'AhHRXEXpHr';

function connect_db() {
    $conn = mysqli_connect($GLOBALS['server'], $GLOBALS['db_username'], $GLOBALS['db_passwd']);
    if (!$conn)
        die('Could not connect: ' . mysqli_error());
    mysqli_select_db($conn, $GLOBALS['db_username']);
    return $conn;
}

function table_exists($conn, $tbl_name) {
    $sql = "SHOW TABLES LIKE $tbl_name";
    $result = $conn->query($sql);
    return ($result > 0);
}

function create_table_users($conn) {
    $sql = "CREATE TABLE users( " .
            "id INT AUTO_INCREMENT PRIMARY KEY, " .
            "username VARCHAR(100) NOT NULL, " .
            "password VARCHAR(128) NOT NULL )";
    mysqli_query($conn, $sql)
    or die('Could not create table: ' . mysqli_error($conn));
}

function add_user($conn, $username, $passwd) {
    $sql = "INSERT INTO users " .
            "(username, password) " . "VALUES" .
            "('$username','$passwd')";
    mysqli_query($conn, $sql)
    or die('Could not enter data: ' . mysqli_error($conn));
}

function create_table_items($conn) {
    $sql = "CREATE TABLE items( " .
            "id INT AUTO_INCREMENT PRIMARY KEY, " .
            "name VARCHAR(100) NOT NULL, " .
            "img VARCHAR(255) NOT NULL, " .
            "price DOUBLE(10,2) NOT NULL )";
    mysqli_query($conn, $sql)
    or die('Could not create table: ' . mysqli_error($conn));
}

function add_item($conn, $name, $price, $img, $category) {
    $sql = "INSERT INTO items " .
            "(name, price, img)" . "VALUES" .
            "('$name', '$price', '$img')";
    mysqli_query($conn, $sql)
    or die('Could not enter item data: ' . mysqli_error($conn));
    $result = mysqli_query($conn, 'SELECT LAST_INSERT_ID()');
    $row = mysqli_fetch_array($result);
    $id = $row[0];
    add_category($conn, $category, $id);
}

function create_table_categories($conn) {
    $sql = "CREATE TABLE categories( " .
            "id INT AUTO_INCREMENT PRIMARY KEY, " .
            "category VARCHAR(100) NOT NULL, " .
            "item_id INT, " .
            "FOREIGN KEY(item_id) REFERENCES items(id) )";
    mysqli_query($conn, $sql)
    or die('Could not create table: ' . mysqli_error($conn));
}

function add_category($conn, $category, $item_id) {
    $sql = "INSERT INTO categories " .
            "(category, item_id) " . "VALUES" .
            "('$category','$item_id')";
    mysqli_query($conn, $sql)
    or die('Could not enter data: ' . mysqli_error($conn) . ' item_id value = ' . $item_id);
}

function create_table_baskets($conn) {
    $sql = "CREATE TABLE baskets( " .
            "id INT AUTO_INCREMENT PRIMARY KEY, " .
            "user_id INT, " .
            "item_id INT, " .
            "FOREIGN KEY(user_id) REFERENCES users(id), " .
            "FOREIGN KEY(item_id) REFERENCES items(id) )";
    mysqli_query($conn, $sql)
    or die('Could not create table: ' . mysqli_error($conn));
}

?>
