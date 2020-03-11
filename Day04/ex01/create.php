<?php
if ($_POST["submit"] === "OK" && $_POST["passwd"])
{
	$dir = "../htdocs/private";
	if (!file_exists($dir)) mkdir($dir, 0755, 1);
	if (file_exists($dir."/passwd"))
	{
		$arr = unserialize(file_get_contents($dir."/passwd"));
		foreach ($arr as $key => $account)
			if ($account["login"] === $_POST["login"])
			{
				echo "ERROR\n";
				exit ;
			}
	}
	else
		$key = -1;
	$whirlpool = hash("whirlpool", $_POST["passwd"]);
	$arr[$key + 1] = array("login" => $_POST["login"], "passwd" => $whirlpool);
	file_put_contents($dir."/passwd", serialize($arr));
	echo "OK\n";
}
else
	echo "ERROR\n";
?>