<?php
/**
@brief Number-Decoder - Example configuration

@author Stephan Ruloff
*/

$appName = "Number-Decoder";

/* MySQL server */
$cfg['db']['host'] = "localhost";
$cfg['db']['name'] = "nd";
$cfg['db']['user'] = "php";
$cfg['db']['pass'] = "php";


/* Schema (folder inside "schema") */
$i = 0;
$schema[$i] = "mac_oui";
$i++;

/* Schema config */
$cfg['mac_oui']['manuf'] = "manuf";


/* name of the folder inside "template" */
$style = "default";
