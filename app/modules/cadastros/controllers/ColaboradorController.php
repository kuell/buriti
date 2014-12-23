<?php

class ColaboradorController extends \BaseController {

	private $colaboradors;
	private $reendenize;
	private $rules = array(
		'nome'           => 'required|min:5|unique:colaboradors,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		);

	public function __construct(Colaborador $colaborador) {
		$this->colaboradors = $colaborador;
		$this->reendenize   = "cadastros::colaboradores.";
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$colaboradores = $this->colaboradors->all();

		return View::make($this->reendenize.'index', compact('colaboradores'));
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
			return Redirect::route('cadastro.colaborador.index');
		} else {
			print_r($validate->errors());
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

		return View::make($this->reendenize.'edit', compact('colaborador'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$this->rules['nome'] = $this->rules['nome'].', '.$id;
		$this->rules['codigo_interno'] = $this->rules['codigo_interno'].', '.$id;

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->find($id);
			$colaborador->update($input);

			return Redirect::route('cadastro.colaborador.index');
		} else {
			print_r($validate->errors());
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
		$colaborador = $this->colaboradors->where('codigo_interno', '=', $codigo_interno)->first();

		if ($colaborador->count() == 0) {
			return '0';
		} else {
			return $colaborador;
		}
	}

}
