<?php

class OrdemInternaController extends \BaseController {

	private $osis;

	public function __construct(OrdemInterna $osi) {
		$this->osis = $osi;
	}
	/**
	 * Display a listing of the resource.
	 * GET /ordeminterna
	 *
	 * @return Response
	 */
	public function index() {
		$osis = $this->osis->all();

		return View::make('manutencao::osi.index', compact('osis'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ordeminterna/create
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('manutencao::osi.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ordeminterna
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 * GET /ordeminterna/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$osi = $this->osis->find($id);

		return View::make('manutencao::osi.show', compact('osi'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ordeminterna/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$osi = $this->osis->find($id);

		return View::make('manutencao::osi.edit', compact('osi'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /ordeminterna/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /ordeminterna/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	public function getServicos($osi) {
		$osi = $this->osis;

	}

}