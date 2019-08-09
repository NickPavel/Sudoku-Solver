<?php
class Environment
{
	public static function get()
	{
		return (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : "development");
	}
}
