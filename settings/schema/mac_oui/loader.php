<?php
/**
@brief Example: MAC-OUI

@author Stephan Ruloff
*/

require_once $ND_DIR . "/config.inc.php";
require_once $ND_DIR . "/settings/schema/mac_oui/show.php";
require_once $ND_DIR . "/settings/schema/mac_oui/manuf.inc.php";
require_once $ND_DIR . "/render.php";
require_once $ND_DIR . "/settings/schema_base.php";

class mac_oui extends SchemaBase
{
	private $mManuf;

	function __construct()
	{
		global $cfg;

		$this->mManuf = new Manuf($cfg['mac_oui']['manuf']);
	}

	function GetManuf($mac)
	{
		$res = $this->mManuf->Search($mac);

		return $res;
	}

	function ValidCode($code)
	{
		$mac = array();
		$code = strtoupper($code);

		return $this->mManuf->StrToMac($code, $mac);
	}

	function Search($code)
	{
		$output = "";
		$code = str_replace("-", ":", $code);
		if ($this->ValidCode($code)) {
			$n = new DwLight;
			$ret = $this->GetManuf($code);

			$output .= "<table>\n";
			$output .= "<tr><td>MAC:</td><td>" . $code . "</td></tr>\n";
			$output .= "<tr><td>Manufacturer:</td>";
			if ($ret !== FALSE) {
				$output .= "<td>" . $n->ToHTML($ret) . "</td>";
			} else {
				$output .= "<td><span class=\"red\">No manufacturer found.</span></td>";
			}
			$output .= "</tr>\n</table>\n";
		}

		return $output;
	}

	function GetEditElements()
	{
		return array();
	}

	function GetColumns($mode)
	{
		$n = new MacOuiShow;

		return $n->GetColumns($mode);
	}

	function Show($mode, $viewOptions)
	{
		$n = new MacOuiShow;

		return $n->Show($mode, $viewOptions);
	}

};
