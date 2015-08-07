<?php

class AnaliseController extends \BaseController {
	private $analises;

	public function __construct(AnaliseOcorrencia $analise) {
		$this->analises = $analise;
	}

	/**
	 * Display a listing of the resource.
	 * GET /analise
	 *
	 * @return Response
	 */
	public function index() {
		$analises = Ocorrencia::where('situacao', '<>', 'finalizada')->limit(100)->get();

		return View::make('sesmt::analises.index', compact('analises'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /analise/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /analise
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 * GET /analise/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /analise/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$ocorrencia = Ocorrencia::find($id);

		return View::make('sesmt::analises.edit', compact('ocorrencia'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /analise/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

		$input   = array_except(Input::all(), '_method')+['usuario_analise' => Auth::user()->nome];
		$analise = $this->analises->find($id);

		$analise->update($input);

		if ($analise->tipoOcorrencia == 'ACIDENTE') {
			$analise->investigacao()->create(['situacao' => 'Em Investigacao']);
		}

		return Redirect::route('sesmt.analise.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /analise/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	public function setFinalizar($id) {
		$input   = Input::all()+['usuario_finalizacao' => Auth::user()->nome];
		$analise = $this->analises->find($id);

		if (empty($analise->tipo_id) or empty($analise->queixa_id) or empty($analise->sub_tipo_id)) {
			return $analise;
		} else {
			$analise->update($input);
			return $analise;
		}
	}

}