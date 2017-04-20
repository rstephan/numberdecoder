<?php
/**
@brief Number-Decoder

@author Stephan Ruloff
@date Feb 2017
*/

require_once "config.inc.php";
require_once "loader.php";
require_once "html.inc.php";

$e_q = HttpGetPost("q");

$output = "";
$re_input = "";
$code = "";
if (isset($e_q)) {
	$code = strtoupper($e_q);
	$re_input = $code;

	HtmlHeader($appName . " - " . $code);
	echo "<body>\n";

	foreach ($schema as $s) {
		$n = new $s;
		$output .= $n->Search($code);
	}

	$form_classes = "";
} else {
	HtmlHeader($appName);
	echo "<body>\n";

	$form_classes = "screen_center";
}
?>

<div class="headline">
	<div class="block_left">
		<div class="app_name"><a href="index.php" id="no"><?php echo $appName; ?></a></div>
		<div class="<?php echo $form_classes; ?>">
			<form action="search.php" method="get">
			<div class="spacer">
			<input type="text" name="q" id="query" class="big_text_input" value="<?php echo $re_input; ?>">
			<input type="submit" value="Search">
			</div>
			</form>
		</div>
	</div>
	<div class="block_right">
		<div class="settings"><a href="#" title="Settings (Nothing to do)" class="settings">&vellip;</a></div>
	</div>
</div>

<?php

if ($code) {
	//echo "<div class=\"code\">Code: $code</div>";
	if ($output) {
		echo "<div class=\"output\">$output</div>\n";
	} else {
		echo "<div class=\"output red\">No match.</div>\n";
	}
}
?>

<script type="text/javascript">
<!--
var q = document.getElementById('query');
q.focus();
//-->
</script>

<?php
HtmlFooter();
?>
