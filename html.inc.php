<?php
/**
@brief Number-Decoder - HTML Output

@author Stephan Ruloff
@date Dec. 2016
*/

require_once "config.inc.php";

function HtmlHeader($title, $styleDir = "")
{
	global $style;

	header("Content-Type: text/html; charset=UTF-8");
	echo "<!DOCTYPE html>\n";
	echo "<html><head>\n<title>$title</title>\n\n";
	echo "<!-- https://github.com/rstephan/numberdecoder -->\n\n";
	echo "<meta charset=\"utf-8\">";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $styleDir . "template/$style/style.css\"></head>\n";
}

function HtmlFooter()
{
	echo "<center><div class=\"copyright footer\">&copy; 2016-2017 by rstephan &bull; GPLv2 &bull; <a href=\"https://github.com/rstephan/numberdecoder\">Number-Decoder</a></div></center>";
	echo "\n</body></html>\n";
}
