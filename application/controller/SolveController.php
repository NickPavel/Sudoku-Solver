<?php
class SolveController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->View->render('solve/index', array('one' => SolveModel::getTableOne()));
	}
	public function fillGame()
	{
		(SolveModel::fillGame()) ? Redirect::to('solve/index') : Redirect::to('index/index');
	}
	public function editGame()
	{
		$this->View->render('solve/editGame', array('one' => SolveModel::getTableOne()));
	}
	public function editGame_action()
	{
		(SolveModel::editGame()) ? Redirect::to('solve/index') : Redirect::to('solve/editGame');
	}
	//public function saveGame($level,$id)
	//{
		//(SolveModel::saveGame($level,$id)) ? Redirect::to('solve/index') : Redirect::to('solve/index');
	//}
	public function goBack()
	{
		(SolveModel::goBack()) ? Redirect::to('solve/index') : Redirect::to('solve/index');
	}
	public function goForward()
	{
		(SolveModel::goForward()) ? Redirect::to('solve/index') : Redirect::to('solve/index');
	}
	public function goToBeginning()
	{
		(SolveModel::goToBeginning()) ? Redirect::to('solve/index') : Redirect::to('solve/index');
	}
	public function goToEnd()
	{
		(SolveModel::goToEnd()) ? Redirect::to('solve/index') : Redirect::to('solve/index');
	}
	public function resetGame()
	{
		(SolveModel::resetGame()) ? Redirect::to('solve/index') : Redirect::to('index/index');
	}
	public function newGame()
	{
		(SolveModel::newGame()) ? Redirect::to('index/index') : Redirect::to('solve/index');
	}
	public function solveGame()
	{
		(SolveModel::solveGame()) ? Redirect::to('solve/index') : Redirect::to('solve/editGame');
	}
	public function loadGame()
	{
		(SolveModel::loadGame()) ? Redirect::to('solve/index') : Redirect::to('index/index');
	}
}
