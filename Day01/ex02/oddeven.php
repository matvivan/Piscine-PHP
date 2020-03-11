#!/usr/bin/php
<?php
while (!feof(STDIN))
{
	print("Enter a number: ");
	fscanf(STDIN, "%s", $s);
	sscanf($s, "%d\0", $d);
	if (is_int($d))
		print("The number $d is ".($d % 2 ? "odd" : "even")."\n");
	else if (!is_int($d))
		print("'$s' is not a number\n");
	else 
		exit();
	unset($d);
	unset($s);
}

?>