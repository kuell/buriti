<?php

class MedicamentoController extends \BaseController {
	private $medicamentos;

	public function __construct(Medicamento $medicamento) {
		$this->medicamentos = $medicamento;
	}

	/**
	 * Display a listing of the resource.
	 * GET /medicamento
	 *
	 * @return Response
	 */
	public function index() {
		$medicamentos = $this->medicamentos->all();

		return View::make('farmacia::medicamento.index', compact('medicamentos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /medicamento/create
	 *
	 * @return Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /medicamento
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->medicamentos->rules);

		if ($validate->passes()) {
			$this->medicamentos->create($input);
			return Redirect::route('farmacia.medicamentos.index');
		} else {
			return Redirect::route('farmacia.medicamentos.index')
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /medicamento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /medicamento/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$medicamento = $this->medicamentos->find($id);
		return View::make('farmacia::medicamento.index', compact('medicamento'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /medicamento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input       = Input::all();
		$medicamento = $this->medicamentos->find($id);

		$this->medicamentos->rules['descricao'] = 'required|unique:farmacia_medicamentos,descricao,id';

		$validate = Validator::make($input, $medicamento->rules);

		if ($validate->passes()) {
			$medicamento->update($input);
			return Redirect::route('farmacia.medicamentos.index');
		} else {
			return Redirect::route('farmacia.medicamentos.index')
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /medicamento/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}