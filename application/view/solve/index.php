<?php require Config::get('PATH_VIEW') . 'templates/header.php'; ?>
<?php if (Session::get('level') != '') { ?>
			<h4><?= Session::get('level') ?> Level, Game <?= Session::get('game') ?></h4>
			<br>
<?php } ?>
<?php if ((Session::get('done') == 'yes') AND (Session::get('step') == Session::get('end'))) { ?>
			<p style="color:green;font-weight:bold;">Done in <?= Session::get('steps') ?> steps!</p>
<?php if (Session::get('guess') != array()) { ?>
			<p style="color:red;font-weight:bold;">Had to guess <?= count(Session::get('guess')) ?> times.</p>
<?php } ?>
			<br>
			<table>
				<tr>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/goBack">
							<input type="hidden" name="back" value="yes">
							<input type="submit" value="BACK">
						</form>
					</td>
				</tr>
			</table>
			<br>
<?php } ?>
<?php if ((Session::get('done') == 'no') AND (Session::get('end') != '')) { ?>
			<table>
<?php if (Session::get('step') > 0) { ?>
				<tr>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/goToBeginning">
							<input type="hidden" name="start" value="yes">
							<input type="submit" value=" << ">
						</form>
					</td>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/goBack">
							<input type="hidden" name="back" value="yes">
							<input type="submit" value=" < ">
						</form>
					</td>
<?php } if (Session::get('step') < Session::get('end')) { ?>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/goForward">
							<input type="hidden" name="forward" value="yes">
							<input type="submit" value=" > ">
						</form>
					</td>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/goToEnd">
							<input type="hidden" name="end" value="yes">
							<input type="submit" value=" >> ">
						</form>
					</td>
				</tr>
<?php } ?>
			</table>
			<br>
<?php } ?>
<?php if ((Session::get('done') == 'no') AND (Session::get('end') == '')) { ?>
			<table>
				<tr>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/solveGame">
							<input type="hidden" name="solve" value="yes">
							<input type="submit" value="SOLVE">
						</form>
					</td>
				</tr>
			</table>
			<br>
<?php } ?>
<?php if (Session::get('change') != '') { ?>
			<p style="color:green;font-weight:bold;"><?= Session::get('change') ?></p>
			<br>
<?php } ?>
<?php if (Session::get('error') != '') { ?>
			<p style="color:red;font-weight:bold;"><?= Session::get('error') ?></p>
			<br>
<?php } ?>
			<table>
<?php for ($y=1; $y<=9; $y++) { ?>
				<tr>
<?php for ($x=1; $x<=9; $x++) { 
	if ((($x <= 3) AND ($y <= 3)))
	{ 
		$z = 'c';  
	} elseif ((($x >= 7) AND ($y <= 3)))
	{ 
		$z = 'c';
	} elseif ((($x <= 3) AND ($y >= 7)))
	{ 
		$z = 'c';
	} elseif ((($x >= 7) AND ($y >= 7)))
	{ 
		$z = 'c';
	} elseif ((($x >= 4) AND ($x <= 6)) AND (($y >= 4) AND ($y <= 6)))
	{ 
		$z = 'c';
	} else {
		$z = 'd';
	} if (Session::get('yx') != '') {$yx = Session::get('yx'); $a = substr($yx,3,1); $b = substr($yx,1,1);} ?>
					<td id="<?= ((Session::get('yx') != '') AND ($a == $x) AND ($b == $y)) ? $z.'c' : $z ?>"><?= ($this->one['y'.$y]['x'.$x] == NULL) ? '&ensp;' : $this->one['y'.$y]['x'.$x] ?></td>
<?php } ?>
				</tr>
<?php } ?>
			</table>
			<br>
			<table>
				<tr>
<?php if ((Session::get('done') == 'no') AND (Session::get('end') == '')) { ?>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/editGame">
							<input type="hidden" name="edit" value="yes">
							<input type="submit" value="EDIT">
						</form>
					</td>
<?php } ?>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/resetGame">
							<input type="hidden" name="reset" value="yes">
							<input type="submit" value="RESET">
						</form>
					</td>
					<td>
						<form method="post" action="<?= Config::get('URL') ?>solve/newGame">
							<input type="hidden" name="new" value="yes">
							<input type="submit" value="NEW">
						</form>
					</td>
				</tr>
			</table>
