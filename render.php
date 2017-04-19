<?php
/**
@brief Dokuwiki to HTML Light Converter

@author Stephan Ruloff
*/

class DwLight
{
	private $RegH6 = "/[ \t]*(======)([^\n]+?)(======)[ \t]*(?=\n)/";
	private $RegH6Text = "<h4>$2</h4>";
	private $RegH5 = "/[ \t]*(=====)([^\n]+?)(=====)[ \t]*(?=\n)/";
	private $RegH5Text = "<h3>$2</h3>";
	private $RegH4 = "/[ \t]*(====)([^\n]+?)(====)[ \t]*(?=\n)/";
	private $RegH4Text = "<h2>$2</h2>";
	private $RegLinks = "/\\[\\[.+?\\]\\]/";
	private $RegLinksText = "";
	private $RegNewLineA = "/(\\\\\\\\ )/";
	private $RegNewLineB = "/(\\\\\\\\\n)/";
	private $RegNewLineText = "<br>";
	private $RegBold = "/(\\*\\*)([^\n]+?)(\\*\\*)/";
	private $RegBoldText = "<b>$2</b>";
	private $RegUnderline = "/(__)([^\n]+?)(__)/";
	private $RegUnderlineText = "<u>$2</u>";

	function ToHTML($text)
	{
		$text = preg_replace($this->RegLinks, $this->RegLinksText, $text);

		// trim
		$text = preg_replace("/^\s+/", "", $text);
		// \r\n -> \n
		$text = preg_replace("/\r\n+/", "\n", $text);

		$text = preg_replace($this->RegH6, $this->RegH6Text, $text);
		$text = preg_replace($this->RegH5, $this->RegH5Text, $text);
		$text = preg_replace($this->RegH4, $this->RegH4Text, $text);

		$text = preg_replace($this->RegNewLineA, $this->RegNewLineText, $text);
		$text = preg_replace($this->RegNewLineB, $this->RegNewLineText, $text);
		$text = preg_replace($this->RegBold, $this->RegBoldText, $text);
		$text = preg_replace($this->RegUnderline, $this->RegUnderlineText, $text);

		// only one linebreak after a headline
		$text = preg_replace("/<\/h4>\n[\n]+/", "</h4>\n", $text);
		$text = preg_replace("/<\/h3>\n[\n]+/", "</h3>\n", $text);
		$text = preg_replace("/<\/h2>\n[\n]+/", "</h2>\n", $text);

		$text = preg_replace("/\n[\n]+/", "<br><br>\n", $text);
/*
		line = Consume(RegH6, RegH6Text, line);
		line = Consume(RegH5, RegH5Text, line);
		line = Consume(RegH4, RegH4Text, line);
	   
		line = Replace(RegLinks, RegLinksText, line);
		line = Replace(RegNewLineA, RegNewLineText, line);
		line = Replace(RegNewLineB, RegNewLineText, line);
		line = Replace(RegBold, RegBoldText, line);
		line = Replace(RegUnderline, RegUnderlineText, line);
		line = Images(line);
		line = line.trim();
*/
		return $text;
	}
};

?>
