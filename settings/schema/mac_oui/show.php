<?php
/**
@brief MAC-OUI, decode the manufacturer of a MAC address

@author Stephan Ruloff
@date Apr 2017
*/

require_once $ND_DIR . "/config.inc.php";
require_once $ND_DIR . "/show_base.inc.php";

class MacOuiShow extends ShowBase
{
	private $mLastError;
	private $mManufFile;
	private $mFstat;

	function __construct()
	{
		global $cfg;

		$this->mManufFile = $cfg['mac_oui']['manuf'];
	}

	function Status()
	{
		$fp = FALSE;
		if (file_exists($this->mManufFile)) {
			$fp = fopen($this->mManufFile, "r");
		}
		if ($fp) {
			$this->mFstat = fstat($fp);
			fclose($fp);
		} else {
			$this->mFstat = FALSE;
		}
	}

	function GetStatus()
	{
		$out = "";
		$this->Status();
		if ($this->mFstat !== FALSE) {
			$out .= "<table><tr><th>Mac</th><th>Description</th></tr>";
			$out .= "<tr><td colspan=\"2\"> File: " . $this->mManufFile . "</td></tr>";
			$out .= "<tr><td colspan=\"2\"> Size: " . $this->mFstat['size'] . " Bytes</td></tr>";
			$out .= "</table>\n";
		} else {
			$out = "<div class=\"orange\">" . 'Check $cfg[\'mac_oui\'][\'manuf\']' . "</div>\n";
		}
		$res = array();
		$res['header'] = "MAC OUI";
		$res['output'] = $out;
		$res['count'] = 0;
		$res['columns'] = array("mac", "description");

		return $res;
	}

	function Show($mode, $viewOptions)
	{
		//$this->mViewOption = $viewOptions;

		return $this->GetStatus();
	}

};

?>
