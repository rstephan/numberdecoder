<?php
/**
@brief Manuf-file from Wireshark
@author Stephan Ruloff
@date 24.03.2017
*/

class Manuf
{
	private $mMap;
	private $mIsLoaded;
	private $mFilename;

	function __construct()
	{
		global $cfg;

		$this->mMap = array();
		$this->mIsLoaded = FALSE;
		$this->mFilename = $cfg['mac_oui']['manuf'];
	}

	function StrToMac($str, &$m)
	{
		$w = 0;
		$mac = array();
		$ret = sscanf($str, "%02X:%02X:%02X:%02X:%02X:%02X",
			$mac[0], $mac[1], $mac[2],
			$mac[3], $mac[4], $mac[5]);
		if ($ret == 6) {
			$m = $mac;

			return TRUE;
		}

		return FALSE;
	}

	function StrToMacWidth($str, &$m, &$width)
	{
		$w = 0;
		$mac = array();
		$ret = sscanf($str, "%02X:%02X:%02X:%02X:%02X:%02X/%02d",
			$mac[0], $mac[1], $mac[2],
			$mac[3], $mac[4], $mac[5], $w);
		if ($ret == 7 && $w >= 24 && $w <= 48) {
			$width = $w;
			$m = $mac;

			return TRUE;
		}

		return FALSE;
	}

	function StrToMacHalf($str, &$m)
	{
		$w = 0;
		$mac = array();
		$ret = sscanf($str, "%02X:%02X:%02X",
			$mac[0], $mac[1], $mac[2]);
		if ($ret == 3) {
			$mac[3] = 0;
			$mac[4] = 0;
			$mac[5] = 0;
			$m = $mac;

			return TRUE;
		}

		return FALSE;
	}

	function Parse($key, $value, &$high)
	{
		$res = FALSE;
		$width = 0;
		$mac = array();
		if ($this->StrToMacWidth($key, $mac, $width)) {
			$high = $mac[0] << 16 | $mac[1] << 8 | $mac[2];
			$md['mac_lower'] = $mac[3] << 16 | $mac[4] << 8 | $mac[5];
			$md['width'] = $width;
			$md['name'] = $value;
			$res = TRUE;
		} else if ($this->StrToMacHalf($key, $mac)) {
			$high = $mac[0] << 16 | $mac[1] << 8 | $mac[2];
			$md['mac_lower'] = 0;
			$md['width'] = 24;
			$md['name'] = $value;
			$res = TRUE;
		}

		if ($res) {
			//echo $res . " " . $md['mac_lower'] . " " . $md['width'] . " '" . $md['name'] . "'\n";
			return $md;
		} else {
			return FALSE;
		}
	}

	function StrMake8(&$str)
	{
		$l = strlen($str);
		if ($l < 8) {
			$str .= substr("        ", 0, 8 - $l);
		}
	}

	function ReadManuf()
	{
		$f = fopen($this->mFilename, "r");
		if (!$f) {
			return FALSE;
		}
		while (!feof($f)) {
			$line = fgets($f);
			$pos = strpos($line, "\t");
			if ($pos !== FALSE && $pos > 0) {
				$keyStr = substr($line, 0, $pos);
				$valueStr = trim(substr($line, $pos + 1, 8));
				$this->StrMake8($valueStr);
				$macHigh = "";
				$md = $this->Parse($keyStr, $valueStr, $macHigh);
				if ($md !== FALSE) {
					$this->mMap[$macHigh][] = $md;
				}
			}
		}
		fclose($f);

		return TRUE;
	}

	function Search($mac)
	{
		$match = FALSE;
		$name = "";

		if (!$this->mIsLoaded) {
			$this->mIsLoaded = $this->ReadManuf();
		}

		//echo count($this->mMap) . "\n";
		$m = array();
		if ($this->StrToMac($mac, $m)) {
			$macHigh = $m[0] << 16 | $m[1] << 8 | $m[2];
			if (!isset($this->mMap[$macHigh])) {
				return FALSE;
			}
			$sub = $this->mMap[$macHigh];
			$width = 0;
			foreach ($sub as $md) {
				if ($md['width'] > $width) {
					$widthComp = $md['width'] - 24;
					$macLow = $m[3] << 16 | $m[4] << 8 | $m[5];
					$m1 = $macLow >> (24 - $widthComp);
					$m2 = $md['mac_lower'] >> (24 - $widthComp);
					//echo "$m1, $m2, $width\n";
					if ($m1 == $m2) {
						$name = $md['name'];
						$width = $md['width'];
						$match = TRUE;
					}
				}
			}
		}

		if ($match) {
			return $name;
		} else {
			return FALSE;
		}
	}
};
