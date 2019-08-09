<?php
return array(
	'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
	'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/application/controller/',
	'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/application/view/',
	'PATH_GAMES' => realpath(dirname(__FILE__).'/../../') . '/application/games/',
	'DEFAULT_CONTROLLER' => 'index',
	'DEFAULT_ACTION' => 'index'
);
