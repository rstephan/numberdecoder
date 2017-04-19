<?php
/**
@brief Number-Decoder

@author Stephan Ruloff
@date Dec. 2016
*/

$ND_DIR = dirname(__FILE__);

//echo "$ND_DIR\n";
foreach ($schema as $s) {
	require_once($ND_DIR . "/settings/schema/$s/loader.php");
}
