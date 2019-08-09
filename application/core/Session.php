<?php
class Session
{
	public static function init()
	{
		if (session_id() == '')
		{
			session_start();
		}
	}
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	public static function get($key)
	{
		if (isset($_SESSION[$key]))
		{
			$value = $_SESSION[$key];
			return Filter::XSSFilter($value);
		}
	}
	public static function destroy()
	{
		session_unset();
		session_destroy();
	}
}
