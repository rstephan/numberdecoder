<?php
/**
@brief Number-Decoder - Main Gate

@author Stephan Ruloff
*/

require_once("html.inc.php");

if (isset($_POST)) {
	reset($_POST);
	foreach ($_POST as $k=>$elem) {
		${"e_$k"} = $elem;
	}
}

HtmlHeader($appName);

?>
<body onLoad="try{document.fq.q.focus();}catch(e){}">

<div class="app_name center">
<center><?php echo $appName; ?></center>
</div>

<div class="searchbox center">
<center>
<form id="fq" action="search.php" method="post" enctype="application/x-www-form-urlencoded">
<div class="big_text"></div>
<input type="text" name="q" id="query" class="big_text_input">
<input type="submit" value="Search">
</form>
</center>
</div>

<script type="text/javascript">
<!--
var q = document.getElementById('query');
q.focus();
//-->
</script>

<?php
HtmlFooter();
?>
