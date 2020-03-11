<?php
if ($_REQUEST['action'] === "set")
	setcookie($_REQUEST['name'], $_REQUEST['value'], time() + 3600);
if ($_REQUEST["action"] === "del")
	setcookie($_REQUEST['name'], $_REQUEST['value'], time() - 1);
/*	unset($_COOKIE[$_REQUEST['name']]);	*/
if ($_REQUEST["action"] === "get" && isset($_COOKIE[$_REQUEST['name']]))
	echo $_COOKIE[$_REQUEST['name']]."\n";
?>