<?php

class OcorrenciasController extends \BaseController {

	private $ocorrencias;
	private $reedenise = 'farmacia::ocorrencias.';
	private $rules     = [];

	public function __construct(Ocorrencia $ocorrencia) {
		$this->ocorrencias = $ocorrencia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$ocorrencias = $this->ocorrencias->orderBy('data_hora','desc')->get();

		return View::make($this->reedenise.'index', compact('ocorrencias'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make($this->reedenise.'create');
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
			$this->ocorrencias = $this->ocorrencias->create($input);
			return Redirect::route('farmacia.ocorrencias.index');
		} else {
			return "Erro";
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
		$ocorrencia = $this->ocorrencias->find($id);

		return View::make($this->reedenise.'edit', compact('ocorrencia'));
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
			$ocorrencia = $this->ocorrencias->find($id);
			$ocorrencia->update($input);

			return Redirect::route("farmacia.ocorrencias.index");
		} else {
			return "Erro";
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
