<?php

class TipoOcorrenciaController extends \BaseController {

	private $tipos;

	public function __construct(TipoOcorrencia $tipo) {
		$this->tipos = $tipo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tipoocorrencia
	 *
	 * @return Response
	 */
	public function index() {
		$tipos = $this->tipos->all();
		$tipo  = new TipoOcorrencia();

		return View::make('farmacia::tipo_ocorrencia.index', compact('tipos'), compact('tipo'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tipoocorrencia/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tipoocorrencia
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->tipos->rules);

		if ($validate->passes()) {
			$this->tipos->create($input);

			return Redirect::route('farmacia.tipo_ocorrencia.index');
		} else {
			return Redirect::route('farmacia.tipo_ocorrencia.index')
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}

	}

	/**
	 * Display the specified resource.
	 * GET /tipoocorrencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tipoocorrencia/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$tipos = $this->tipos->all();
		$tipo  = $tipos->find($id);

		return View::make('farmacia::tipo_ocorrencia.index', compact('tipos'), compact('tipo'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tipoocorrencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$validate = Validator::make($input, $this->tipos->rules);

		if ($validate->passes()) {
			$tipo = $this->tipos->find($id);
			$tipo->update($input);

			return Redirect::route('farmacia.tipo_ocorrencia.index');
		} else {
			return Redirect::route('farmacia.tipo_ocorrencia.index')
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tipoocorrencia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	public function getSubTipo($id) {
		return TipoOcorrencia::where('pai_id', $id)->get();
	}

}