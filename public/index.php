<?php
require('../application/autoload.php');
ini_set('session.cookie_httponly', 1);
error_reporting(E_ALL);
if (Environment::get() == 'development')
{
	ini_set('display_errors', 1);
} else {
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
}
new Application();
