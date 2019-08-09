<?php
class IndexModel
{
	public static function getGames()
	{
		$games = array();
		$dir = Config::get('PATH_GAMES');
		$levels = scandir($dir);
		$levels = array_slice($levels,2);
		foreach ($levels as $level)
		{
			if (is_dir(Config::get('PATH_GAMES').$level))
			{
				$dir = Config::get('PATH_GAMES').$level;
				$files = scandir($dir);
				$files = array_slice($files,2);
				foreach ($files as $file)
				{
					if (file_exists(Config::get('PATH_GAMES').$level.'/'.$file))
					{
						$games[$level][] = $file;
					}
				}
			}
		}
		return $games;
	}
}
