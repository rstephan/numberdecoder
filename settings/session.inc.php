<?php
/**
@brief Session-Handling
@author Stephan Ruloff
@date 18.01.2017
*/

class Session
{
	const SESSION_ID = "rstephan_numberdecoder";

	private $mSchema;
	private $mSubMenu;
	private $mCurrentPage;

	private function __construct()
	{
	}

	public static function GetInstance()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (!isset($_SESSION[self::SESSION_ID])) {
			$_SESSION[self::SESSION_ID] = new self();
			session_write_close();
		}

		return $_SESSION[self::SESSION_ID];
	}

	public function Start()
	{
	}

	public function Close()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION = [];

		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
			);
		}
		session_destroy();
	}

	public function SetSchema($value)
	{
		$this->mSchema = $value;
	}

	public function GetSchema()
	{
		return $this->mSchema;
	}

	public function SetSubMenu($value)
	{
		$this->mSubMenu = $value;
	}

	public function GetSubMenu()
	{
		return $this->mSubMenu;
	}

	public function SetCurrentPage($value)
	{
		$this->mCurrentPage = $value;
	}

	public function GetCurrentPage()
	{
		return $this->mCurrentPage;
	}
}
