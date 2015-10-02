<?php

class SesmtController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$menus = BaseController::getMenu(9);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}

	public function getRelatorios() {
		return View::make('sesmt::relatorios.form');
	}

	public function getColaboradorMonitoramento() {
		$setor = Setor::find(Input::get('setor'));

		return View::make('sesmt::relatorios.reports.colaborador_monitoramento', compact('setor'));
	}

}
