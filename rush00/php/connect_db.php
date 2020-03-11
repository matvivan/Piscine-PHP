<?php
include ("db.php");
session_start();
$conn = connect_db();
$errors = [];
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $passwd = hash("Whirlpool", mysqli_real_escape_string($conn, $_POST['passwd']));
    $passwd2 = hash("Whirlpool", mysqli_real_escape_string($conn, $_POST['passwd2']));
    if (empty($username))
        array_push($errors, "Username is required!");
    if (empty($passwd))
        array_push($errors, "Password is required!");
    if ($passwd != $passwd2)
        array_push($errors, "Passwords do not match!");
    $getit = "SELECT * FROM users WHERE username='$username'"; 
    $rows = mysqli_query($conn, $getit);
    if (mysqli_num_rows($rows) == 1)
        array_push($errors, "User already exists!");
    if (count($errors) == 0){
        add_user($conn, $username, $passwd);
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = 'You are now logged in.';
        header("Location: ../index.php");
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    setcookie($_SESSION['username'], 0);
    unset($_SESSION['username']);
    header("location: index.php");
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $passwd = hash("Whirlpool", mysqli_real_escape_string($conn, $_POST['passwd']));

    if (empty($username))
        array_push($errors, "Username is required!");
    if (empty($passwd))
        array_push($errors, "Password is required!");
    if (count($errors == 0)) {
        $getit = "SELECT * FROM users WHERE username='$username' AND passwd='$passwd'"; 
        $rows = mysqli_query($conn, $getit);
        if (!$rows)
            die(mysqli_error($conn));
        if (mysqli_num_rows($rows) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = 'You are now logged in.';
            header("Location: index.php");
        }
        else
            array_push($errors, "Wrong username/password!");
    }
   
}

if (isset($_POST['add_item'])) {
    $item_name = mysqli_real_escape_string($conn, $_POST['name']);
    $item_price = mysqli_real_escape_string($conn, $_POST['price']);
    $img = mysqli_real_escape_string($conn, $_POST['img-url']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    if (empty($item_name))
        array_push($errors, "Item name is required!");
    if (empty($item_price))
        array_push($errors, "Item name is required!");
    if (empty($img))
        array_push($errors, "Image url is required!");
    if (count($errors) == 0) {
        add_item($conn, $item_name, $item_price, $category);
        echo "You added new item\n";
        header("Location: add_item.php");
    }
}


?>