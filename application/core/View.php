<?php
class View
{
	public function render($filename, $data = null)
	{
		if ($data) {
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}
		require Config::get('PATH_VIEW') . 'templates/head.php';
		require Config::get('PATH_VIEW') . $filename . '.php';
		require Config::get('PATH_VIEW') . 'templates/footer.php';
	}
}
