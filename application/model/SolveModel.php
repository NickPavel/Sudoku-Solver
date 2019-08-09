<?php
class SolveModel
{
	public static function getTableOne()
	{
		$one =  Session::get('one');
		return $one;
	}
	public static function fillGame()
	{
		$post = Request::post('fill',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			session_regenerate_id(true);
			$_SESSION = array();
			$one = array();
			for ($y=1;$y<=9;$y++)
			{
				for ($x=1;$x<=9;$x++)
				{
					if ($_POST['x'.$x.'y'.$y] !== '')
					{
						$cell = $_POST['x'.$x.'y'.$y];
						if (!preg_match('/^[1-9]{1}$/', $cell)) return false;
						$one['y'.$y]['x'.$x] = $cell;
					}
					else $one['y'.$y]['x'.$x] = '';
				}
			}
			Session::set('one',$one);
			Session::set('initial',$one);
			$backs = array();
			$backs[] = Session::get('one');
			$backs[] = 'Start Point';
			$backs[] = '';
			Session::set('backs',$backs);
			Session::set('step',0);
			$guesses = array();
			Session::set('guess',$guesses);
			Session::set('end','');
			Session::set('done','no');
			return true;
		}
		else return false;
	}
	public static function editGame()
	{
		$post = Request::post('edit',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			Session::set('done','no');
			Session::set('error','');
			Session::set('change','');
			Session::set('yx','');
			$one = array();
			for ($y=1;$y<=9;$y++)
			{
				for ($x=1;$x<=9;$x++)
				{
					if ($_POST['x'.$x.'y'.$y] !== '')
					{
						$cell = $_POST['x'.$x.'y'.$y];
						if (!preg_match('/^[1-9]{1,9}$/', $cell)) return false;
						$one['y'.$y]['x'.$x] = $cell;
					}
					else $one['y'.$y]['x'.$x] = '';
				}
			}
			Session::set('one',$one);
			$backs = Session::get('backs');
			$backs[] = $one;
			$backs[] = 'edit';
			$backs[] = '';
			Session::set('backs',$backs);
			return true;
		}
		else return false;
	}
	public static function goBack()
	{
		$post = Request::post('back',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$backs = Session::get('backs');
			$step = Session::get('step');
			if ($step >= 3)
			{
				$step = $step - 3;
				$one = $step;
				$one = $backs[$one];
				$change = $step + 1;
				$change = $backs[$change];
				$yx = $step + 2;
				$yx = $backs[$yx];
				Session::set('one',$one);
				Session::set('change',$change);
				Session::set('yx',$yx);
				Session::set('step',$step);
				if (Session::get('done') == 'yes') Session::set('done','no');
			}
			return true;
		}
		else return false;
	}
	public static function goForward() 
	{
		$post = Request::post('forward',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$backs = Session::get('backs');
			$step = Session::get('step');
			$end = Session::get('end');
			if ($step < $end)
			{
				$step = $step + 3;
				$one = $step;
				$one = $backs[$one];
				$change = $step + 1;
				$change = $backs[$change];
				$yx = $step + 2;
				$yx = $backs[$yx];
				Session::set('one',$one);
				Session::set('change',$change);
				Session::set('yx',$yx);
				Session::set('step',$step);
			}
			return true;
		}
		else return false;
	}
	public static function goToBeginning() 
	{
		$post = Request::post('start',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$backs = Session::get('backs');
			$one = $backs[0];
			$change = $backs[1];
			$yx = $backs[2];
			Session::set('one',$one);
			Session::set('change',$change);
			Session::set('yx',$yx);
			Session::set('step',0);
			return true;
		}
		else return false;
	}
	public static function goToEnd() 
	{
		$post = Request::post('end',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$backs = Session::get('backs');
			$end = Session::get('end');
			$one = $end;
			$one = $backs[$one];
			$change = $end + 1;
			$change = $backs[$change];
			$yx = $end + 2;
			$yx = $backs[$yx];
			Session::set('one',$one);
			Session::set('change',$change);
			Session::set('yx',$yx);
			Session::set('step',$end);
			return true;
		}
		else return false;
	}
	public static function resetGame() 
	{
		$post = Request::post('reset',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$one = Session::get('initial');
			$level = Session::get('level');
			$game = Session::get('game');
			$_SESSION = array();
			Session::set('one',$one);
			Session::set('initial',$one);
			Session::set('done','no');
			Session::set('end','');
			Session::set('level',$level);
			Session::set('game',$game);
			$guesses = array();
			Session::set('guess',$guesses);
			$backs = array();
			$backs[] = Session::get('one');
			$backs[] = 'Start Point';
			$backs[] = '';
			Session::set('backs',$backs);
			return true;
		}
		else return false;
	}
	public static function newGame() 
	{
		$post = Request::post('new',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			$_SESSION = array();
			return true;
		}
		else return false;
	}
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
	public static function loadGame() 
	{
		$post = Request::post('load',true);
		if (preg_match('/^[1-9]{2}$/', $post))
		{
			$games = self::getGames();
			foreach ($games as $levels => $level)
			{
				if (substr($levels,0,1) == substr($post,0,1)) $top = $levels;
				foreach ($level as $game)
				{
					if (substr($game,0,1) == substr($post,1,1)) $bottom = $game;
				}
			}
			$level = ucfirst(substr($top,1));
			$game = substr($bottom,0,1);
			Session::set('level',$level);
			Session::set('game',$game);
			require Config::get('PATH_GAMES').$top.'/'.$bottom;
			Session::set('one',$one);
			Session::set('initial',$one);
			Session::set('done','no');
			Session::set('end','');
			Session::set('error','');
			Session::set('step',0);
			$backs = array();
			$backs[] = $one;
			$backs[] = 'Start Point';
			$backs[] = '';
			Session::set('backs',$backs);
			return true;
		}
		else return false;
	}
	//public static function saveGame($level,$id)
	//{
		//$one = Session::get('one');
		//$newGame = fopen('../application/games/'.$level.'/'.$id.'.php','w');
		//$txt = '<?php $one = '.var_export($one,TRUE).';';
		//fwrite($newGame,$txt);
		//fclose($newGame);
		//return true;
	//}
	public static function fillEmpties()
	{
		$z = false;
		$one = Session::get('one');
		for ($y=1;$y<=9;$y++)
		{
			for ($x=1;$x<=9;$x++)
			{
				if ($one['y'.$y]['x'.$x] == '')
				{
					$a = $one['y'.$y];
					$a = array_filter($a);
					$b = array_column($one,'x'.$x);
					$b = array_filter($b);
					$c = array();
					if ($x <= 3) $xa = 1;
					if (($x >= 4) && ($x <= 6)) $xa = 4;
					if ($x >= 7) $xa = 7;
					if ($y <= 3) $ya = 1;
					if (($y >= 4) && ($y <= 6)) $ya = 4;
					if ($y >= 7) $ya = 7;
					for ($f=$ya;$f<=$ya+2;$f++)
					{
						for ($g=$xa;$g<=$xa+2;$g++)
						{
							$c[] = $one['y'.$f]['x'.$g];
						}
					}
					$c = array_filter($c);
					$d = array(1,2,3,4,5,6,7,8,9);
					$v = array_diff($d,$a,$b,$c);
					$v = array_values($v);
					if (count($v) == 1)
					{
						$one['y'.$y]['x'.$x] = $v[0];
						$z = true;
					}
					elseif (count($v) > 1)
					{
						$v = implode('',$v);
						$one['y'.$y]['x'.$x] = $v;
						$z = true;
					}
				}
			}
		}
		if ($z == true)
		{
			Session::set('one',$one);
			$backs = Session::get('backs');
			$backs[] = $one;
			$backs[] = 'Filled Up';
			$backs[] = '';
			Session::set('backs',$backs);
		}
	}
	public static function countSingles()
	{
		$singles = 0;
		$one = Session::get('one');
		foreach ($one as $row)
		{
			foreach ($row as $value)
			{
				if (strlen($value) == 1)
				{
					$singles++;
				}
			}
		}
		return $singles;
	}
	public static function errorChecker()
	{
		$rows = self::getRows();
		foreach ($rows as $row)
		{
			$values = array();
			foreach ($row as $key => $value)
			{
				if (strlen($value) == 1) $values[] = $value;
			}
			if (count($values) > count(array_unique($values)))
			{
				$i = substr($key,1,1);
				Session::set('error','Row '.$i.' is wrong!');
				return false;
			}
		}
		$columns = self::getColumns();
		foreach ($columns as $column)
		{
			$values = array();
			foreach ($column as $key => $value)
			{
				if (strlen($value) == 1) $values[] = $value;
			}
			if (count($values) > count(array_unique($values)))
			{
				$i = substr($key,3,1);
				Session::set('error','Column '.$i.' is wrong!');
				return false;
			}
		}
		$i = 0;
		$squares = self::getSquares();
		foreach ($squares as $square)
		{
			$i++;
			$values = array();
			foreach ($square as $key => $value)
			{
				if (strlen($value) == 1) $values[] = $value;
			}
			if (count($values) > count(array_unique($values)))
			{
				Session::set('error','Square '.$i.' is wrong!');
				return false;
			}
		}
		Session::set('error','');
		return true;
	}
	public static function getRows()
	{
		$one = Session::get('one');
		$row1 = array(); $row2 = array(); $row3 = array();
		$row4 = array(); $row5 = array(); $row6 = array();
		$row7 = array(); $row8 = array(); $row9 = array(); 
		foreach ($one as $y => $row)
		{
			$yy = substr($y,1);
			foreach ($row as $x => $v)
			{
				$xx = substr($x,1);
				if ($yy == 1) $row1[$y.$x] = $v;
				elseif ($yy == 2) $row2[$y.$x] = $v;
				elseif ($yy == 3) $row3[$y.$x] = $v;
				elseif ($yy == 4) $row4[$y.$x] = $v;
				elseif ($yy == 5) $row5[$y.$x] = $v;
				elseif ($yy == 6) $row6[$y.$x] = $v;
				elseif ($yy == 7) $row7[$y.$x] = $v;
				elseif ($yy == 8) $row8[$y.$x] = $v;
				elseif ($yy == 9) $row9[$y.$x] = $v;
			}
		}
		$rows = array($row1,$row2,$row3,$row4,$row5,$row6,$row7,$row8,$row9);
		return $rows;
	}
	public static function getColumns()
	{
		$one = Session::get('one');
		$column1 = array(); $column2 = array(); $column3 = array();
		$column4 = array(); $column5 = array(); $column6 = array();
		$column7 = array(); $column8 = array(); $column9 = array();
		foreach ($one as $y => $row)
		{
			$yy = substr($y,1);
			foreach ($row as $x => $v)
			{
				$xx = substr($x,1);
				if ($xx == 1) $column1[$y.$x] = $v;
				elseif ($xx == 2) $column2[$y.$x] = $v;
				elseif ($xx == 3) $column3[$y.$x] = $v;
				elseif ($xx == 4) $column4[$y.$x] = $v;
				elseif ($xx == 5) $column5[$y.$x] = $v;
				elseif ($xx == 6) $column6[$y.$x] = $v;
				elseif ($xx == 7) $column7[$y.$x] = $v;
				elseif ($xx == 8) $column8[$y.$x] = $v;
				elseif ($xx == 9) $column9[$y.$x] = $v;
			}
		}
		$columns = array($column1,$column2,$column3,$column4,$column5,$column6,$column7,$column8,$column9);
		return $columns;
	}
	public static function getSquares()
	{
		$one = Session::get('one');
		$square1 = array(); $square2 = array(); $square3 = array();
		$square4 = array(); $square5 = array(); $square6 = array();
		$square7 = array(); $square8 = array(); $square9 = array(); 
		foreach ($one as $y => $row)
		{
			$yy = substr($y,1);
			foreach ($row as $x => $v)
			{
				$xx = substr($x,1);
				if (($yy < 4) AND ($xx < 4)) $square1[$y.$x] = $v;
				elseif (($yy < 4) AND ($xx > 3) AND ($xx < 7)) $square2[$y.$x] = $v;
				elseif (($yy < 4) AND ($xx > 6)) $square3[$y.$x] = $v;
				elseif (($yy > 3) AND ($yy < 7) AND ($xx < 4)) $square4[$y.$x] = $v;
				elseif (($yy > 3) AND ($yy < 7) AND ($xx > 3) AND ($xx < 7)) $square5[$y.$x] = $v;
				elseif (($yy > 3) AND ($yy < 7) AND ($xx > 6)) $square6[$y.$x] = $v;
				elseif (($yy > 6) AND ($xx < 4)) $square7[$y.$x] = $v;
				elseif (($yy > 6) AND ($xx > 3) AND ($xx < 7)) $square8[$y.$x] = $v;
				elseif (($yy > 6) AND ($xx > 6)) $square9[$y.$x] = $v;
			}
		}
		$squares = array($square1,$square2,$square3,$square4,$square5,$square6,$square7,$square8,$square9);
		return $squares;
	}
	public static function inRowsNakedSingles()
	{
		$rows = self::getRows();
		$z = false;
		$one = Session::get('one');
		foreach ($rows as $row)
		{
			foreach ($row as $k => $v)
			{
				if (strlen($v) == 1)
				{
					foreach ($row as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$v) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = str_replace($v,'',$v1);
							$row[$yx] = $one[$y][$x];
							Session::set('one',$one);
							$change = $v.' already single in row: '.$v1.' to '.$one[$y][$x];
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inColumnsNakedSingles()
	{
		$columns = self::getColumns();
		$z = false;
		$one = Session::get('one');
		foreach ($columns as $column)
		{
			foreach ($column as $k => $v)
			{
				if (strlen($v) == 1)
				{
					foreach ($column as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$v) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = str_replace($v,'',$v1);
							$column[$yx] = $one[$y][$x];
							Session::set('one',$one);
							$change = $v.' already single in column: '.$v1.' to '.$one[$y][$x];
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inSquaresNakedSingles()
	{
		$z = false;
		$squares = self::getSquares();
		$one = Session::get('one');
		foreach ($squares as $square)
		{
			foreach ($square as $k => $v)
			{
				if (strlen($v) == 1)
				{
					foreach ($square as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$v) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = str_replace($v,'',$v1);
							$square[$yx] = $one[$y][$x];
							Session::set('one',$one);
							$change = $v.' already single in square: '.$v1.' to '.$one[$y][$x];
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inRowsUniquesInStrings()
	{
		$rows = self::getRows();
		$z = false;
		$one = Session::get('one');
		foreach ($rows as $row)
		{
			$string = '';
			foreach ($row as $v)
			{
				$string = $string.$v;
			}
			for ($n=1;$n<=9;$n++)
			{
				if (substr_count($string,$n) == 1)
				{
					foreach ($row as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$n) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = $n;
							$row[$yx] = $n;
							Session::set('one',$one);
							$change = $n.' unique in row: '.$v1.' to '.$n;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inColumnsUniquesInStrings()
	{
		$columns = self::getColumns();
		$z = false;
		$one = Session::get('one');
		foreach ($columns as $column)
		{
			$string = '';
			foreach ($column as $v)
			{
				$string = $string.$v;
			}
			for ($n=1;$n<=9;$n++)
			{
				if (substr_count($string,$n) == 1)
				{
					foreach ($column as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$n) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = $n;
							$column[$yx] = $n;
							Session::set('one',$one);
							$change = $n.' unique in column: '.$v1.' to '.$n;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inSquaresUniquesInStrings()
	{
		$z = false;
		$squares = self::getSquares();
		$one = Session::get('one');
		foreach ($squares as $square)
		{
			$string = '';
			foreach ($square as $v)
			{
				$string = $string.$v;
			}
			for ($n=1;$n<=9;$n++)
			{
				if (substr_count($string,$n) == 1)
				{
					foreach ($square as $yx => $v1)
					{
						if ((strlen($v1) > 1) AND (substr_count($v1,$n) == 1))
						{
							$y = substr($yx,0,2);
							$x = substr($yx,2,2);
							$one[$y][$x] = $n;
							$square[$yx] = $n;
							Session::set('one',$one);
							$change = $n.' unique in square: '.$v1.' to '.$n;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $yx;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inRowsNakedTwinPairs()
	{
		$rows = self::getRows();
		$z = false;
		$one = Session::get('one');
		foreach ($rows as $row)
		{
			$array = array();
			foreach ($row as $v)
			{
				if (strlen($v) == 2) $array[] = $v;
			}
			$unique = array_unique($array);
			if ((count($array) > 1) AND ((count(array_unique($array))) < count($array)))
			{
				$n1 = implode(',',$row);
				$n2 = $n1;
				$pairs = array_diff_assoc($array,array_unique($array));
				foreach ($pairs as $v1)
				{
					$split = str_split($v1);
					foreach ($split as $v2)
					{
						foreach ($row as $yx => $v3)
						{
							if (($v1 != $v3) AND (strlen($v3) > 1) AND (substr_count($v3,$v2) == 1))
							{
								$y = substr($yx,0,2);
								$x = substr($yx,2,2);
								$one[$y][$x] = str_replace($v2,'',$v3);
								$row[$yx] = $one[$y][$x];
								Session::set('one',$one);
								$n2 = implode(',',$one[$y]);
								$change = 'Pairs of '.$v1.' in row. Before change: '.$n1;
								$backs = Session::get('backs');
								$backs[] = $one;
								$backs[] = $change;
								$backs[] = $yx;
								Session::set('backs',$backs);
								$z = true;
							}
						}
					}
					if ($n1 != $n2) return true;
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inColumnsNakedTwinPairs()
	{
		$columns = self::getColumns();
		$z = false;
		$one = Session::get('one');
		foreach ($columns as $column)
		{
			$array = array();
			foreach ($column as $v)
			{
				if (strlen($v) == 2) $array[] = $v;
			}
			$unique = array_unique($array);
			if ((count($array) > 1) AND ((count(array_unique($array))) < count($array)))
			{
				$n1 = implode(',',$column);
				$n2 = $n1;
				$pairs = array_diff_assoc($array,array_unique($array));
				foreach ($pairs as $v1)
				{
					$split = str_split($v1);
					foreach ($split as $v2)
					{
						foreach ($column as $yx => $v3)
						{
							if (($v1 != $v3) AND (strlen($v3) > 1) AND (substr_count($v3,$v2) == 1))
							{
								$y = substr($yx,0,2);
								$x = substr($yx,2,2);
								$one[$y][$x] = str_replace($v2,'',$v3);
								$column[$yx] = $one[$y][$x];
								Session::set('one',$one);
								$n2 = implode(',',$one[$y]);
								$change = 'Pairs of '.$v1.' in column. Before change: '.$n1;
								$backs = Session::get('backs');
								$backs[] = $one;
								$backs[] = $change;
								$backs[] = $yx;
								Session::set('backs',$backs);
								$z = true;
							}
						}
					}
					if ($n1 != $n2) return true;
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inSquaresNakedTwinPairs()
	{
		$z = false;
		$squares = self::getSquares();
		$one = Session::get('one');
		$sq = 0;
		foreach ($squares as $square)
		{
			$sq++;
			$array = array();
			foreach ($square as $v)
			{
				if (strlen($v) == 2) $array[] = $v;
			}
			$unique = array_unique($array);
			if ((count($array) > 1) AND ((count(array_unique($array))) < count($array)))
			{
				$n1 = implode(',',$square);
				$n2 = $n1;
				$pairs = array_diff_assoc($array,array_unique($array));
				foreach ($pairs as $v1)
				{
					$split = str_split($v1);
					foreach ($split as $v2)
					{
						foreach ($square as $yx => $v3)
						{
							if (($v1 != $v3) AND (strlen($v3) > 1) AND (substr_count($v3,$v2) == 1))
							{
								$y = substr($yx,0,2);
								$x = substr($yx,2,2);
								$one[$y][$x] = str_replace($v2,'',$v3);
								$square[$yx] = $one[$y][$x];
								Session::set('one',$one);
								$n2 = implode(',',$one[$y]);
								$change = 'Pairs of '.$v1.' in square. Before change: '.$n1;
								$backs = Session::get('backs');
								$backs[] = $one;
								$backs[] = $change;
								$backs[] = $yx;
								Session::set('backs',$backs);
								$z = true;
							}
						}
					}
					if ($n1 != $n2) return true;
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inRowsTwinPairsInStrings()
	{
		$rows = self::getRows();
		$z = false;
		$one = Session::get('one');
		foreach ($rows as $row)
		{
			foreach ($row as $v)
			{
				$implode = implode($row);
				$doubles = '';
				for ($a=1;$a<=9;$a++)
				{
					if (substr_count($implode,$a) == 2) $doubles = $doubles.$a;
				}
				if (strlen($doubles) > 1)
				{
					$split = str_split($doubles);
					$pairs = array();
					foreach ($split as $v1)
					{
						foreach ($split as $v2)
						{
							if ($v1 < $v2) $pairs[] = $v1.$v2;
							if ($v1 > $v2) $pairs[] = $v2.$v1;
						}
					}
					$pairs = array_unique($pairs);
					foreach ($pairs as $pair)
					{
						$keys = array();
						$v1 = substr($pair,0,1);
						$v2 = substr($pair,1,1);
						foreach ($row as $yx => $v4)
						{
							if (strlen($v4) > 2)
							{
								if ((substr_count($v4,$v1) == 1) AND (substr_count($v4,$v2) == 1)) $keys[] = $yx;
							}
						}
						if (count($keys) == 2)
						{
							$key0 = $keys[0];
							$y = substr($key0,0,2);
							$x = substr($key0,2,2);
							$n1 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$row[$key0] = $pair;
							$key1 = $keys[1];
							$y = substr($key1,0,2);
							$x = substr($key1,2,2);
							$n2 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$row[$key1] = $pair;
							Session::set('one',$one);
							$change = 'Pairs of '.$pair.' in row: '.$n1.' to '.$pair.' and '.$n2.' to '.$pair;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $key1;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inColumnsTwinPairsInStrings()
	{
		$columns = self::getColumns();
		$z = false;
		$one = Session::get('one');
		foreach ($columns as $column)
		{
			foreach ($column as $v)
			{
				$implode = implode($column);
				$doubles = '';
				for ($a=1;$a<=9;$a++)
				{
					if (substr_count($implode,$a) == 2) $doubles = $doubles.$a;
				}
				if (strlen($doubles) > 1)
				{
					$split = str_split($doubles);
					$pairs = array();
					foreach ($split as $v1)
					{
						foreach ($split as $v2)
						{
							if ($v1 < $v2) $pairs[] = $v1.$v2;
							if ($v1 > $v2) $pairs[] = $v2.$v1;
						}
					}
					$pairs = array_unique($pairs);
					foreach ($pairs as $pair)
					{
						$keys = array();
						$v1 = substr($pair,0,1);
						$v2 = substr($pair,1,1);
						foreach ($column as $yx => $v4)
						{
							if (strlen($v4) > 2)
							{
								if ((substr_count($v4,$v1) == 1) AND (substr_count($v4,$v2) == 1)) $keys[] = $yx;
							}
						}
						if (count($keys) == 2)
						{
							$key0 = $keys[0];
							$y = substr($key0,0,2);
							$x = substr($key0,2,2);
							$n1 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$column[$key0] = $pair;
							$key1 = $keys[1];
							$y = substr($key1,0,2);
							$x = substr($key1,2,2);
							$n2 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$column[$key1] = $pair;
							Session::set('one',$one);
							$change = 'Pairs of '.$pair.' in column: '.$n1.' to '.$pair.' and '.$n2.' to '.$pair;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $key1;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inSquaresTwinPairsInStrings()
	{
		$z = false;
		$squares = self::getSquares();
		$one = Session::get('one');
		foreach ($squares as $square)
		{
			foreach ($square as $v)
			{
				$implode = implode($square);
				$doubles = '';
				for ($a=1;$a<=9;$a++)
				{
					if (substr_count($implode,$a) == 2) $doubles = $doubles.$a;
				}
				if (strlen($doubles) > 1)
				{
					$split = str_split($doubles);
					$pairs = array();
					foreach ($split as $v1)
					{
						foreach ($split as $v2)
						{
							if ($v1 < $v2) $pairs[] = $v1.$v2;
							if ($v1 > $v2) $pairs[] = $v2.$v1;
						}
					}
					$pairs = array_unique($pairs);
					foreach ($pairs as $pair)
					{
						$keys = array();
						$v1 = substr($pair,0,1);
						$v2 = substr($pair,1,1);
						foreach ($square as $yx => $v4)
						{
							if (strlen($v4) > 2)
							{
								if ((substr_count($v4,$v1) == 1) AND (substr_count($v4,$v2) == 1)) $keys[] = $yx;
							}
						}
						if (count($keys) == 2)
						{
							$key0 = $keys[0];
							$y = substr($key0,0,2);
							$x = substr($key0,2,2);
							$n1 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$square[$key0] = $pair;
							$key1 = $keys[1];
							$y = substr($key1,0,2);
							$x = substr($key1,2,2);
							$n2 = $one[$y][$x];
							$one[$y][$x] = $pair;
							$square[$key1] = $pair;
							Session::set('one',$one);
							$change = 'Pairs of '.$pair.' in square: '.$n1.' to '.$pair.' and '.$n2.' to '.$pair;
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = $key1;
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inRowsConnectDoubles()
	{
		$rows = self::getRows();
		$z = false;
		$one = Session::get('one');
		for ($n=1;$n<=9;$n++)
		{
			$ys = array();
			$xs = array();
			$allkeys = array();
			foreach ($rows as $key => $row)
			{
				$implode = implode($row);
				if (substr_count($implode,$n) == 2)
				{
					$keys = array();
					$count = 0;
					foreach ($row as $yixi => $cell)
					{
						if ((substr_count($cell,$n) == 1) AND (strlen($cell) > 1))
						{
							$keys[] = $yixi;
							$count++;
						}
					}
					if (count($keys) == 2)
					{
						$ys[] = substr($keys[0],1,1);
						$ys[] = substr($keys[1],1,1);
						$xs[] = substr($keys[0],3,1);
						$xs[] = substr($keys[1],3,1);
						$allkeys[] = substr($keys[0],1,1).substr($keys[0],3,1);
						$allkeys[] = substr($keys[1],1,1).substr($keys[1],3,1);
					}
				}
			}
			if ((count($ys) >= 2) AND (count($ys) == count($xs)))
			{
				// eliminate single line(s) (not part of polygon)
				$counted = array_count_values($xs);
				foreach ($counted as $x => $v)
				{
					if ($v == 1)
					{
						$xs = array_filter($xs, function ($filter) use ($x) {return ($filter != $x);});
						foreach ($allkeys as $yx)
						{
							if (substr($yx,1,1) == $x)
							{
								$y = substr($yx,0,1);
								$ys = array_filter($ys, function ($filter) use ($y) {return ($filter != $y);});
							}
						}
					}
				}
				$ys = array_unique($ys);
				$xs = array_unique($xs);
				$strxs = implode(',',$xs);
				$strys = implode(',',$ys);
			}
			// trim allkeys
			$keys = array();
			foreach ($allkeys as $v1)
			{
				$y = substr($v1,0,1);
				$x = substr($v1,1,1);
				foreach ($ys as $v2)
				{
					foreach ($xs as $v3)
					{
						if (($y == $v2) AND ($x == $v3)) $keys[] = $v1;
					}
				}
			}
			if ((count($ys) >= 2) AND (count($ys) == count($xs)))
			{
				$ysnx = array();
				foreach ($keys as $k1 => $v1)
				{
					foreach ($keys as $k2 => $v2)
					{
						if ($k1 != $k2)
						{
							$str = '';
							$y1 = substr($v1,0,1);
							$x1 = substr($v1,1,1);
							$y2 = substr($v2,0,1);
							$x2 = substr($v2,1,1);
							if ($x1 == $x2)
							{
								if ($y1 < $y2) $str = $str.$y1.$y2.$x1;
								if ($y1 > $y2) $str = $str.$y2.$y1.$x1;
								$ysnx[] = $str;
							}
						}
					}
				}
				$ysnx = array_unique($ysnx);
				foreach ($ysnx as $vertical)
				{
					$x = substr($vertical,2,1);
					$y1 = substr($vertical,0,1);
					$y2 = substr($vertical,1,1);
					$column = array_column($one,'x'.$x);
					foreach ($column as $k => $v)
					{
						$y = $k + 1;
						if (($y != $y1) AND ($y != $y2) AND (substr_count($v,$n) == 1))
						{
							$one['y'.$y]['x'.$x] = str_replace($n,'',$v);
							$column[$k] = $one['y'.$y]['x'.$x];
							Session::set('one',$one);
							$change = 'Polygon on '.$n.'s in rows '.$strys.' and columns '.$strxs.'. Removed all other '.$n.'s in columns.';
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = '';
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function inColumnsConnectDoubles()
	{
		$columns = self::getColumns();
		$z = false;
		$one = Session::get('one');
		for ($n=1;$n<=9;$n++)
		{
			$ys = array();
			$xs = array();
			$allkeys = array();
			foreach ($columns as $key => $column)
			{
				$implode = implode($column);
				if (substr_count($implode,$n) == 2)
				{
					$keys = array();
					$count = 0;
					foreach ($column as $yixi => $cell)
					{
						if ((substr_count($cell,$n) == 1) AND (strlen($cell) > 1))
						{
							$keys[] = $yixi;
							$count++;
						}
					}
					if (count($keys) == 2)
					{
						$ys[] = substr($keys[0],1,1);
						$ys[] = substr($keys[1],1,1);
						$xs[] = substr($keys[0],3,1);
						$xs[] = substr($keys[1],3,1);
						$allkeys[] = substr($keys[0],1,1).substr($keys[0],3,1);
						$allkeys[] = substr($keys[1],1,1).substr($keys[1],3,1);
					}
				}
			}
			if ((count($xs) >= 2) AND (count($ys) == count($xs)))
			{
				// eliminate single line(s) (not part of polygon)
				$counted = array_count_values($ys);
				foreach ($counted as $y => $v)
				{
					if ($v == 1)
					{
						$ys = array_filter($ys, function ($filter) use ($y) {return ($filter != $y);});
						foreach ($allkeys as $yx)
						{
							if (substr($yx,0,1) == $y)
							{
								$x = substr($yx,1,1);
								$xs = array_filter($xs, function ($filter) use ($x) {return ($filter != $x);});
							}
						}
					}
				}
				$ys = array_unique($ys);
				$xs = array_unique($xs);
				$strxs = implode(',',$xs);
				$strys = implode(',',$ys);
			}
			// trim allkeys
			$keys = array();
			foreach ($allkeys as $v1)
			{
				$y = substr($v1,0,1);
				$x = substr($v1,1,1);
				foreach ($ys as $v2)
				{
					foreach ($xs as $v3)
					{
						if (($y == $v2) AND ($x == $v3)) $keys[] = $v1;
					}
				}
			}
			if ((count($xs) >= 2) AND (count($ys) == count($xs)))
			{
				$xsny = array();
				foreach ($keys as $k1 => $v1)
				{
					foreach ($keys as $k2 => $v2)
					{
						if ($k1 != $k2)
						{
							$str = '';
							$y1 = substr($v1,0,1);
							$x1 = substr($v1,1,1);
							$y2 = substr($v2,0,1);
							$x2 = substr($v2,1,1);
							if ($y1 == $y2)
							{
								if ($x1 < $x2) $str = $str.$x1.$x2.$y1;
								if ($x1 > $x2) $str = $str.$x2.$x1.$y1;
								$xsny[] = $str;
							}
						}
					}
				}
				$xsny = array_unique($xsny);
				foreach ($xsny as $xxy)
				{
					$y = substr($xxy,2,1);
					$x1 = substr($xxy,0,1);
					$x2 = substr($xxy,1,1);
					$row = $one['y'.$y];
					foreach ($row as $k => $v)
					{
						$x = substr($k,1,1);
						if (($x != $x1) AND ($x != $x2) AND (substr_count($v,$n) == 1))
						{
							$one['y'.$y]['x'.$x] = str_replace($n,'',$v);
							$column[$k] = $one['y'.$y]['x'.$x];
							Session::set('one',$one);
							$change = 'Polygon on '.$n.'s in columns '.$strys.' and rows '.$strxs.'. Removed all other '.$n.'s in rows.';
							$backs = Session::get('backs');
							$backs[] = $one;
							$backs[] = $change;
							$backs[] = '';
							Session::set('backs',$backs);
							$z = true;
						}
					}
				}
			}
		}
		return ($z == true) ? true : false;
	}
	public static function guessOnPair()
	{
		$guesses = Session::get('guess');
		$count = count($guesses);
		$rows = self::getRows();
		$backs = Session::get('backs');
		foreach ($rows as $row)
		{
			foreach ($row as $yx => $v)
			{
				if (strlen($v) == 2)
				{
					$step = count($backs);
					$guesses[] = $step;
					Session::set('guess',$guesses);
					$one = Session::get('one');
					$v1 = substr($v,0,1);
					$v2 = substr($v,1,1);
					$y = substr($yx,0,2);
					$x = substr($yx,2,2);
					$one[$y][$x] = $v1;
					$row[$yx] = $v1;
					Session::set('one',$one);
					$change = 'Guessed: '.$v.' to '.$v1;
					$backs[] = $one;
					$backs[] = $change;
					$backs[] = $yx;
					Session::set('backs',$backs);
				}
			}
		}
	}
	public static function reverseGuess()
	{
		Session::set('error','');
		$backs = Session::get('backs');
		$guesses = Session::get('guess');
		$i = 1;
		while ($i < 2)
		{
			$count = count($guesses);
			$count1 = $count - 1;
			$count2 = $count - 2;
			if ($guesses[$count1] == $guesses[$count2]):
				array_pop($guesses);
				array_pop($guesses);
			else: $i = 2;
			endif;
		}
		$step = $guesses[$count1];
		$one = $step - 3;
		$one = $backs[$one];
		$yx = $step + 2;
		$yx = $backs[$yx];
		$y = substr($yx,0,2);
		$x = substr($yx,2,2);
		$v = $one[$y][$x];
		$v2 = substr($v,1,1);
		$change = 'Guessed: '.$v.' to '.$v2;
		$one[$y][$x] = $v2;
		Session::set('one',$one);
		$backs = array_slice($backs,0,$step);
		$backs[] = $one;
		$backs[] = $change;
		$backs[] = $yx;
		Session::set('backs',$backs);
		$guesses[] = $step;
		Session::set('guess',$guesses);
	}
	public static function solveGame()
	{
		$post = Request::post('solve',true);
		if (preg_match('/^[yes]{3}$/', $post))
		{
			Session::set('error','');
			Session::set('change','');
			Session::set('yx','');
			self::fillEmpties();
			$i = 0;
			$singles = self::countSingles();
			while ($singles < 81)
			{
				$p = 1;
				// Naked Singles
				if (self::inRowsNakedSingles()): $p++;
				elseif (self::inColumnsNakedSingles()): $p++;
				elseif (self::inSquaresNakedSingles()): $p++;
				// Uniques In Strings
				elseif (self::inRowsUniquesInStrings()): $p++;
				elseif (self::inColumnsUniquesInStrings()): $p++;
				elseif (self::inSquaresUniquesInStrings()): $p++;
				// Naked Twin Pairs
				elseif (self::inRowsNakedTwinPairs()): $p++;
				elseif (self::inColumnsNakedTwinPairs()): $p++;
				elseif (self::inSquaresNakedTwinPairs()): $p++;
				// Twin Pairs In Strings
				elseif (self::inRowsTwinPairsInStrings()): $p++;
				elseif (self::inColumnsTwinPairsInStrings()): $p++;
				elseif (self::inSquaresTwinPairsInStrings()): $p++;
				// connect multiple doubles
				elseif (self::inRowsConnectDoubles()): $p++;
				elseif (self::inColumnsConnectDoubles()): $p++;
				// stop if more than 1000 backs
				elseif ($i > 1000): $singles = 81;
				// if all fails, just guess
				elseif (self::errorChecker() AND (self::countSingles() < 81)): self::guessOnPair();
				// if error, reverse last single guess
				elseif (!self::errorChecker()): self::reverseGuess();
				else: $singles = 81;
				endif;
				$i++;
			}
			if ($i > 1000):
				Session::set('error','Not enough numbers!');
			elseif (self::errorChecker() AND (self::countSingles() == 81)):
				Session::set('done','yes');
				$backs = Session::get('backs');
				$count = count($backs) - 3;
				Session::set('step',$count);
				Session::set('end',$count);
				$steps = count($backs) / 3;
				Session::set('steps',$steps);
				return true;
			else:
				return false;
			endif;
		}
		else return false;
	}
}
