<?php

class ColaboradorController extends \BaseController {

	private $colaboradors;
	private $reendenize;
	private $rules = array(
		'nome'           => 'required|min:5|unique:colaboradors,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		'setor_id'       => 'required',
	);

	public function __construct(Colaborador $colaborador) {
		$this->beforeFilter('auth');
		$this->colaboradors = $colaborador;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$colaboradores = $this->colaboradors->all();

		return View::make('cadastros::colaboradores.index', compact('colaboradores'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make($this->reendenize."create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->create($input);
			return Redirect::route('colaborador.index');
		} else {
			return Redirect::route('colaboradors.create')
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$colaborador = $this->colaboradors->find($id);

		return View::make('cadastros::colaboradores.edit', compact('colaborador'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$this->rules['nome']           = $this->rules['nome'].', '.$id;
		$this->rules['codigo_interno'] = $this->rules['codigo_interno'].', '.$id;

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->find($id);
			$colaborador->update($input);

			return Redirect::route('colaboradors.index');
		} else {
			return Redirect::route('colaboradors.create')->withInput()
			                                             ->withErrors($validate)
			                                             ->with('message', 'Houve erros na validação dos dados.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	public function show($codigo_interno) {
		$input = Input::get('id');

		if ($input) {
			$colaborador = $this->colaboradors->find($input);
		} else {
			$colaborador = $this->colaboradors->where('codigo_interno', '=', $codigo_interno)->first();
		}

		return $colaborador;

		/*
	$colaborador = $this->colaboradors->where('codigo_interno', '=', $codigo_interno)->first();

	if ($colaborador->count() == 0) {
	$colaborador->find($id);

	return '0';
	} else {
	return $colaborador;
	}
	 */
	}

}
