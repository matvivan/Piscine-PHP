#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/Paris');
	setlocale(LC_TIME, "fr_FR", "fr", "fre", "fra", "france");
	if (!empty($argv[1]))
	{
		/* that function have't leading zero in hms */
		$arr = strptime($argv[1], "%A %e %B %C%y ");
		/* that function have't strict 4-digit year and did't work with locale name of wday and month */
		$hms = date_parse_from_format("* j * Y H:i:s", $argv[1]);
		if (!empty($arr) && empty($hms["error_count"]))
		{
			print(mktime($hms["hour"], $hms["minute"], $hms["second"], 
				$arr["tm_mon"] + 1, $arr["tm_mday"], $arr["tm_year"] + 1900)."\n");
		}
		else
			print("Wrong Format\n");
	}
?>