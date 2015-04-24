<?php

class RiscoController extends \BaseController {

	private $riscos;

	public function __construct(SesmtPostoRisco $risco) {
		$this->riscos = $risco;

	}

	/**
	 * Display a listing of the resource.
	 * GET /risco
	 *
	 * @return Response
	 */
	public function index() {

		$riscos     = $this->riscos->all();
		$tipo_risco = ['Físico' => 'Fisico', 'Quimico' => 'Químico', 'Biologico' => 'Biologico', 'Ergonomico' => 'Ergonomico', 'Acidente' => 'Acidente'];

		return View::make('sesmt::risco.index', compact('riscos'))->with('tipo_risco', $tipo_risco);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /risco/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /risco
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$this->riscos->create($input);

		return Redirect::route('sesmt.risco.index');
	}

	/**
	 * Display the specified resource.
	 * GET /risco/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /risco/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /risco/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /risco/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}