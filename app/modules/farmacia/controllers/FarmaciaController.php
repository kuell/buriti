<?php

class FarmaciaController extends \BaseController {

	public function index()
	{
		$menus = BaseController::getMenu(3);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}
}
