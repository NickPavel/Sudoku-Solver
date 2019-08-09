<?php require Config::get('PATH_VIEW') . 'templates/header.php'; ?>
			<h3>Edit Numbers</h3>
			<br>
<?php if (Session::get('level') != '') { ?>
			<h4><?= Session::get('level') ?> Level, Game <?= Session::get('game') ?></h4>
			<br>
<?php } ?>
<?php if (Session::get('error') != '') { ?>
			<p style="color:red;font-weight:bold;"><?= Session::get('error') ?></p>
			<br>
<?php } ?>
<?php if (Session::get('change') != '') { ?>
			<p style="color:green;font-weight:bold;"><?= Session::get('change') ?></p>
			<br>
<?php } ?>
			<form method="post" action="<?= Config::get('URL') ?>solve/editGame_action">
				<table>
<?php for ($y=1; $y<=9; $y++) { ?>
					<tr>
<?php for ($x=1; $x<=9; $x++) { 
	if ((($x <= 3) AND ($y <= 3)))
	{ 
		$z = 'a';  
	} elseif ((($x >= 7) AND ($y <= 3)))
	{ 
		$z = 'a';
	} elseif ((($x <= 3) AND ($y >= 7)))
	{ 
		$z = 'a';
	} elseif ((($x >= 7) AND ($y >= 7)))
	{ 
		$z = 'a';
	} elseif ((($x >= 4) AND ($x <= 6)) AND (($y >= 4) AND ($y <= 6)))
	{ 
		$z = 'a';
	} else {
		$z = 'b';
	} ?>
						<td><input id="<?= $z ?>" type="text" name="<?= 'x'.$x.'y'.$y ?>" size="7" value="<?= $this->one['y'.$y]['x'.$x] ?>" pattern="[1-9]{1,9}"></td>
<?php } ?>
					</tr>
<?php } ?>
				</table>
				<br>
				<input type="hidden" name="edit" value="yes">
				<input type="submit" value="SUBMIT">
			</form>

