<?php
/**
@brief HTML Helper

@author Stephan Ruloff
@date Dec. 2016
*/

class HtmlHelperBase
{
	protected $mViewOption;

	function SqlHelperViewOptions()
	{
		$options = "";

		if ($this->mViewOption['order']) {
			$options .= " ORDER BY " . $this->mViewOption['order'] . " " . ($this->mViewOption['is_up'] ? "ASC" : "DESC");
		}
		if ($this->mViewOption['from'] != -1) {
			$options .= " LIMIT " . $this->mViewOption['from'] . "," . $this->mViewOption['displaymax'];
		}

		return $options;
	}

	function Render($d)
	{
		$o = "";

		foreach ($d as $l) {
			switch ($l[0]) {
			case "form":
				if ($l[2] == "post") {
					$o .= "<form action=\"" . $l[1] . "\" method=\"post\" enctype=\"application/x-www-form-urlencoded\" accept-charset=\"UTF-8\">\n";
				} else {
					$o .= "<form action=\"" . $l[1] . "\" method=\"get\" accept-charset=\"UTF-8\">\n";
				}
				break;
			case "formend":
				$o .= "</form>\n";
				break;
			case "hidden":
				$o .= "<input type=\"hidden\" name=\"$l[1]\" value=\"$l[2]\">\n";
				break;
			case "label":
				$o .= "<div class=\"form_label\">$l[1]</div>\n";
				break;
			case "big_label":
				$o .= "<div class=\"big_label\">$l[1]</div>\n";
				break;
			case "text":
				$o .= "<input type=\"text\" name=\"$l[1]\" value=\"$l[2]\"><br>\n";
				break;
			case "textarea":
				$o .= "<textarea name=\"$l[1]\" class=\"description\">$l[2]</textarea><br>\n";
				break;
			case "button":
				$o .= "<input type=\"button\" name=\"$l[1]\" value=\"$l[2]\"><br>\n";
				break;
			case "submit":
				$o .= "<input type=\"submit\" name=\"$l[1]\" value=\"$l[2]\"><br>\n";
				break;
			}
		}

		return $o;
	}
};

function HttpGet($n)
{
	if (isset($_GET[$n])) {
		return htmlspecialchars(trim($_GET[$n]), ENT_COMPAT | ENT_HTML5, "UTF-8");
	} else {
		return "";
	}
}

function HttpPost($n)
{
	if (isset($_POST[$n])) {
		//return htmlspecialchars(trim($_POST[$n]), ENT_COMPAT | ENT_HTML5, "UTF-8");
		return (trim($_POST[$n]));
	} else {
		return "";
	}
}

function HttpGetPost($n)
{
	if (isset($_POST[$n])) {
		//return htmlspecialchars(trim($_POST[$n]), ENT_COMPAT | ENT_HTML5, "UTF-8");
		return (($_POST[$n]));
	}
	if (isset($_GET[$n])) {
		return htmlspecialchars(trim($_GET[$n]), ENT_COMPAT | ENT_HTML5, "UTF-8");
	}

	return "";
}
