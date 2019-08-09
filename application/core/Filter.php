<?php
class Filter
{
	public static function XSSFilter(&$value)
	{
		if (is_string($value))
		{
			$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		}
	return $value;
	}
}
