<?php
    require_once('./Ship.class.php');
    require_once('./Blue.class.php');
    require_once('./Red.class.php');
    session_start();

function board($unit) {
    echo <<<END
<div class='control' id=$unit->light>
    <h1>BLUE</h1>
    <h2>
END;
        if ($unit->health > 0)
            echo $unit->health." HP";
        else
            echo "DIE";
        echo <<<END
    </h2>x: $unit->x  y: $unit->y
    <div class='phase'><h2>phase</h2>
        <form oninput="val.value=parseInt(pp.value)" action='' method='POST'>
            <output name="val" for="pp">0</output> PP / 10PP<br>
            <input type="range" name="pp" min="0" max="10" value="0"><br>
            <button type="submit" name="movement" value="{$unit->light}_fleet">MOVE</button>
            <button type="submit" name="shooting" value="{$unit->light}_fleet">SHOOT</button>
            <br><br><br><br>
                <input type="range" name="y" min="-2" max="2" value="0">
                <input id="vert" type="range" name="x" min="-2" max="2" value="0">
            <br><br><br>
        </form>
        speed: $unit->speed x PP<br>
        gun power: $unit->gun x PP<br>
        cover radius: $unit->gun
    </div>
</div>
END;
}

    if (!isset($_SESSION['turn']))
    {
        $_SESSION['red_fleet'] = new Red;
        $_SESSION['blue_fleet'] = new Blue;
        $_SESSION['turn'] = 1;
    }
    if (isset($_POST['movement'])) {
        $_SESSION[$_POST['movement']]->movement( $_POST['x'], $_POST['y'], $_POST['pp'] );
    }
    if (isset($_POST['shooting']) && $_POST['pp'] > 0) {
        if ($_POST['shooting'] === 'red_fleet')
            $target = $_SESSION['blue_fleet'];
        if ($_POST['shooting'] === 'blue_fleet')
            $target = $_SESSION['red_fleet'];
        $area = $_SESSION[$_POST['shooting']]->shooting(
            $_POST['x'],
            $_POST['y'],
            $_POST['pp'],
            $target
        );
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

    if (isset($_POST['shooting']) && $_POST['pp'] > 0)
    {
        echo "\t\t#x".$area['x']."y".$area['y']." {
            \t\tbackground-image: url('./src/explode.png');
            \t\tbackground-size: 100%;\n\t\t}\n";
        $cover_x = range(-5, 5);
        $cover_y = range(-5, 5);
        foreach ($cover_x as $a)
            foreach ($cover_y as $b)
                if ($a * $a + $b * $b <= 25)
                    echo "\t\t#x".($area['x'] + $a)."y".($area['y'] + $b).", ";
        echo "#end { background-color: #070f0f; }\n";
    }
    echo "\t\t#vert { margin-top: -18px; transform: rotate(90deg); }\n";
    echo "\t</style>\n";
?>
    <body>
        <?php board($_SESSION['blue_fleet']); ?>
        <div id='arena'>
            <table align="center">
                <caption>behold<?php echo ", {$_SESSION['login']}"; ?>! - arena</caption>
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
        <?php board($_SESSION['red_fleet']); ?>
        <div>
        <?php
            if (isset($_POST['shooting']) && $_POST['pp'] > 0) {
                echo "WATCH OUT! SHOT NEAR [x ";
                echo $area['x']." y ".$area['y']."]";
            }
        ?>
        </div>
    </body>
<html>