<?php
header("Content-Type: image/png");
header("Content-Disposition: attachment; filename=\"42.png\"");
readfile("../img/42.png");
?>