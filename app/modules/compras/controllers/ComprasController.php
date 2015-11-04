<?php

class ComprasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$menus = BaseController::getMenu(16);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}

}
