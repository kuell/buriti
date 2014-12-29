<?php

class AtestadoController extends \BaseController {

	private $atestados;
	private $reendenise = "farmacia::atestados.";
	private $rules      = [];

	public function __construct(Atestado $atestado) {
		$this->atestados = $atestado;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$atestados = $this->atestados->orderBy('id')->get();

		return View::make($this->reendenise.'index', compact('atestados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make($this->reendenise.'create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = array_except(Input::all(), 'codigo_interno');

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$this->atestados = $this->atestados->create($input);

			return Redirect::route('farmacia.atestados.index');
		} else {
			print_r($validate->errors());
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$atestado = $this->atestados->find($id);

		return View::make($this->reendenise.'edit', compact('atestado'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), 'codigo_interno');

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$atestado = $this->atestados->find($id);
			$atestado->update($input);

			return Redirect::route('farmacia.atestados.index');
		} else {
			print_r($validate->error());
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
}
