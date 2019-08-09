<?php
class Controller
{
	public $View;
	function __construct()
	{
		Session::init();
		$this->View = new View();
	}
}
