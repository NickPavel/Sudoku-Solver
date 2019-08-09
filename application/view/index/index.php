<?php require Config::get('PATH_VIEW') . 'templates/header.php'; ?>
			<h3>Choose Game,</h3>
			<br>
<?php if ($this->games) { ?>
			<form method="post" action="<?= Config::get('URL') ?>solve/loadGame">
				<table class="games">
<?php foreach ($this->games as $levels => $level) { ?>
					<tr>
						<td class="games"><?= ucfirst(substr($levels,1)) ?></td>
<?php foreach ($level as $game) { ?>
						<td class="games"><input type="radio" name="load" value="<?= substr($levels,0,1).substr($game,0,1) ?>"> <?= substr($game,0,1) ?></td>
<?php } ?>
					</tr>
<?php } ?>
				
				</table>
				<br>
				<input type="submit" value="SUBMIT">
			</form>
<?php } else { ?>
			<p>No games!</p>
<?php } ?>
			<br>
			<h3>Or Fill In Game Numbers</h3>
			<br>
			<form method="post" action="<?= Config::get('URL') ?>solve/fillGame">
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
						<td><input id="<?= $z ?>" type="text" name="<?= 'x'.$x.'y'.$y ?>" size="1" maxlength="1" pattern="[1-9]{1}"></td>
<?php } ?>
					</tr>
<?php } ?>
				</table>
				<br>
				<input type="hidden" name="fill" value="yes">
				<input type="submit" value="SUBMIT">
			</form>
