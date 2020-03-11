<?php
if ($_POST["submit"] === "OK" && $_POST["oldpw"] && $_POST["newpw"])
{
	$arr = unserialize(file_get_contents("../htdocs/private/passwd"));
	foreach ($arr as $key => $account)
		if ($account["login"] === $_POST["login"] &&
			$account["passwd"] === hash("whirlpool", $_POST["oldpw"]))
			{
				$arr[$key]["passwd"] = hash("whirlpool", $_POST["newpw"]);
				file_put_contents("../htdocs/private/passwd", serialize($arr));
				echo "OK\n";
				exit ;
			}
}
echo "ERROR\n";
?>