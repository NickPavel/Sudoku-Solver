<?php
function load_core($class)
{
	$coreDir = '../application/core/';
	$myclass = $coreDir . $class . '.php';
	if (is_file($myclass)) require($myclass);
}
spl_autoload_register('load_core');
function load_controller($class)
{
	$controllerDir = '../application/controller/';
	$myclass = $controllerDir . $class . '.php';
	if (is_file($myclass)) require($myclass);
}
spl_autoload_register('load_controller');
function load_model($class)
{
	$modelDir = '../application/model/';
	$myclass = $modelDir . $class . '.php';
	if (is_file($myclass)) require($myclass);
}
spl_autoload_register('load_model');
