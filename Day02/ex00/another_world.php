#!/usr/bin/php
<?php
	if (!empty($argv[1]))
	{
		$argv[1] = preg_replace("/[\s]+/", " ", $argv[1]);
		$argv[1] = preg_replace(array("/^\s/", "/\s$/"), "", $argv[1]);
		print($argv[1]."\n");
	}
?>