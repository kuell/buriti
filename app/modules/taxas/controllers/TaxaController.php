<?php

class TaxaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$menus = BaseController::getMenu(28);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}

	public function getRelatorios() {
		return View::make('taxas::relatorios.index');
	}

	public function getRelatorioTaxas() {
		$corretor = Corretor::find(Input::get('corretor_id'));

		return View::make('taxas::relatorios.reports.taxa', compact('corretor'));
	}

}
