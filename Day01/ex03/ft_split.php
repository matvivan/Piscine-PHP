#!/usr/bin/php
<?php
function ft_split(string $str) : array
{
	$str_arr = preg_split("/[\s]+/", $str, 0, PREG_SPLIT_NO_EMPTY);
	sort($str_arr);
	return ($str_arr);
}
?>