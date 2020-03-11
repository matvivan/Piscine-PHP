<?php
    require_once('./Blue.class.php');
    require_once('./Red.class.php');
    session_start();

    if (!isset($_SESSION['turn']))
    {
        $_SESSION['red_fleet'] = new Red;
        $_SESSION['blue_fleet'] = new Blue;
        $_SESSION['turn'] = 1;
    }
    if (isset($_POST['movement'])) {
        $_SESSION[$_POST['movement']]->x += $_POST['x'] * $_POST['pp'] * $_SESSION[$_POST['movement']]->speed;
        $_SESSION[$_POST['movement']]->y += $_POST['y'] * $_POST['pp'] * $_SESSION[$_POST['movement']]->speed;
        if ($_SESSION[$_POST['movement']]->x > 99 || $_SESSION[$_POST['movement']]->x < 0)
            $_SESSION[$_POST['movement']]->health = 0;
        if ($_SESSION[$_POST['movement']]->y > 149 || $_SESSION[$_POST['movement']]->y < 0)
            $_SESSION[$_POST['movement']]->health = 0;
    }
    if (isset($_POST['shooting']) && $_POST['pp'] > 0) {
        $area_x = $_SESSION[$_POST['shooting']]->x + $_POST['x'] * $_POST['pp'] * $_SESSION[$_POST['shooting']]->gun->damage;
        $area_y = $_SESSION[$_POST['shooting']]->y + $_POST['y'] * $_POST['pp'] * $_SESSION[$_POST['shooting']]->gun->damage;
        if (abs($_SESSION['blue_fleet']->x - $area_x) < 5 && abs($_SESSION['blue_fleet']->y - $area_y) < 5)
            $_SESSION['blue_fleet']->health -= $_SESSION['red_fleet']->gun->damage;
        if (abs($_SESSION['red_fleet']->x - $area_x) < 5 && abs($_SESSION['red_fleet']->y - $area_y) < 5)
            $_SESSION['red_fleet']->health -= $_SESSION['blue_fleet']->gun->damage;
    }
?>
<html>
    <head>
        <title>42 Millenium</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <meta name="author" content="matvivan" />
    </head>
<?php
    echo "<style>";
    echo "\n".$_SESSION['red_fleet']."\n";
    echo "\n".$_SESSION['blue_fleet']."\n";
    if ($_SESSION['red_fleet']->health < 1)
        echo "#red > div {color: black; pointer-events: none;}";
    if ($_SESSION['blue_fleet']->health < 1)
        echo "#blue > div {color: black; pointer-events: none;}";
    echo "</style>";
?>
    <body>
        <div class='control' id="blue">
            <h1>BLUE</h1>
            <?php
                echo "<h2>\n";
                if ($_SESSION['blue_fleet']->health > 0)
                    echo $_SESSION['blue_fleet']->health." HP";
                else
                    echo "DIE";
                echo "</h2>\n";
                echo "x: ".$_SESSION['blue_fleet']->x." y: ".$_SESSION['blue_fleet']->y;
            ?>
            <div class='phase'><h2>phase</h2>
                <form oninput="val.value=parseInt(pp.value)" action='' method='POST'>
                    <output name="val" for="pp">0</output> PP<br>
                    <input type="range" name="pp" min="0" max="10" value="0"><br>
                    <button type="submit" name="movement" value="blue_fleet">MOVE</button>
                    <button type="submit" name="shooting" value="blue_fleet">SHOOT</button><br>
                    -X<input type="range" name="x" min="-2" max="2" value="0">X<br>
                    -Y<input type="range" name="y" min="-2" max="2" value="0">Y<br>
                </form>
                <?php
                    echo "speed: ".$_SESSION['blue_fleet']->speed."<br>";
                    echo "gun power: ".$_SESSION['blue_fleet']->gun->damage."<br>";
                ?>
            </div>
        </div>
        <div id='control'>
        </div>
        <div id='arena'>
            <table align="center">
                <caption>behold! - arena</caption>
                <tbody>
                    <tr>
<?php
    $arr = range(1, 15000);
    foreach($arr as $i => $val) {
        if ($i && $i % 150 == 0)
            echo "\t\t\t\t\t</tr>\n\t\t\t\t\t<tr>\n";
        echo "\t\t\t\t\t\t<td id='x".(int)($i / 150)."y".($i % 150)."'></td>\n";
}
?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class='control' id="red">
            <h1>RED</h1>
            <?php
                echo "<h2>\n";
                if ($_SESSION['red_fleet']->health > 0)
                    echo $_SESSION['red_fleet']->health." HP";
                else
                    echo "DIE";
                echo "</h2>\n";
                echo "x: ".$_SESSION['red_fleet']->x." y: ".$_SESSION['red_fleet']->y."<br>";
            ?>
            <div class='phase'><h2>phase</h2>
                <form oninput="val.value=parseInt(pp.value)" action='' method='POST'>
                    <output name="val" for="pp">0</output> PP<br>
                    <input type="range" name="pp" min="0" max="10" value="0"><br>
                    <button type="submit" name="movement" value="red_fleet">MOVE</button>
                    <button type="submit" name="shooting" value="red_fleet">SHOOT</button><br>
                    -X<input type="range" name="x" min="-2" max="2" value="0">X<br>
                    -Y<input type="range" name="y" min="-2" max="2" value="0">Y<br>
                </form>
                <?php
                    echo "speed: ".$_SESSION['red_fleet']->speed."<br>";
                    echo "gun power: ".$_SESSION['red_fleet']->gun->damage."<br>";
                ?>
            </div>
        </div>
        <div>
        <?php
            if (isset($_POST['shooting']) && $_POST['pp'] > 0) {
                echo "WATCH OUT! SHOT NEAR [x ";
                echo $area_x." y ".$area_y."]";
            }
        ?>
        </div>
    </body>
<html>