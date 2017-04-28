<?php
/**
@brief Number-Decoder - Main Gate

@author Stephan Ruloff
@date 28.04.2017
*/

/*
Number-Decoder
Copyright (C) 2017  Stephan Ruloff

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; in version 2 only
of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

require_once "html.inc.php";

HtmlHeader($appName);

?>
<body onLoad="try{document.fq.q.focus();}catch(e){}">

<div class="app_name center">
<center><?php echo $appName; ?></center>
</div>

<div class="searchbox center">
<center>
<form name="fq" action="search.php" method="get">
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
