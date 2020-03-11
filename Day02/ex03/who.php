#!/usr/bin/php
<?php
	$str = file_get_contents("/var/run/utmpx");
	$arr = unpack("a256a/a4b/a32c/id/ie/I2f/a256g/i16h", $str);
	print_r($arr);
?>