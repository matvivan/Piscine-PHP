<?php
$error_login = NULL;
if ($_POST['submit'] === 'LOGIN') {
    $pass = $my->query("SELECT `password` FROM `users` WHERE `login`='{$_POST['login']}';")->fetch_row();
    if ($pass[0] === hash("whirlpool", $_POST['passwd']))
    {
        $_SESSION['login'] = $_POST['login'];
        header("Location: ./game.php");
    }
    else
        $error_login = "YOU DID'T PASS, SAY WORD AGAIN";
}
$error_signup = NULL;
if ($_POST['submit'] === 'REGISTRATION')
{
    $error_signup = NULL;
    if ($_POST['passwd'] !== $_POST['rp_passwd'])
        $error_signup = "fill equal passwords or die";  
    if ($_POST['login'] === "")
        $error_signup = "fill login or die";
    if (!isset($error_signup)) {
        $whirl = hash("whirlpool", $_POST['passwd']);
        if ($my->query("SELECT * FROM `users` WHERE `login`='{$_POST['login']}';")->num_rows)
            $error_signup = "choose unique login or die";
        else if (!$my->query("INSERT INTO `users` (`login`, `password`)
                                            VALUES ('{$_POST['login']}', '{$whirl}')"))
            $error_signup = $my->error;
    }
    if (!isset($error_signup))
    {
        $_SESSION['login'] = $_POST['login'];
        header("Location: ./game.php");
    }
}

?>