<?php

class ManutencaoController extends \BaseController {

	public function index() {
		$menus = BaseController::getMenu(14);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}
}
