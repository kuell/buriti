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
		$analises = Ocorrencia::whereRaw('monitoramento = false or monitoramento is null');

		if (!empty(Input::get('periodo'))) {
			$periodo    = explode(' - ', Input::get('periodo'));
			$periodo[0] = implode('-', array_reverse(explode('/', $periodo[0])));
			$periodo[1] = implode('-', array_reverse(explode('/', $periodo[1])));

			$analises = $analises->whereRaw("date(data_hora) between ? and ?", $periodo);
		} else {
			$analises = $analises->whereRaw("date(data_hora) between ? and ?", [date('Y-m-d'), date('Y-m-d')]);

		}

		$analises = $analises->get();

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

		if (empty($input['queixa_id'])) {
			unset($input['queixa_id']);
		}

		// Se a ocorrência tiver uma investigação e o tipo informado for diferente de 7 //

		if (!empty($analise->investigacao->id) && $input['tipo'] != 7) {
			$input['sesmt'] = false;
			$analise->investigacao()->delete();
		}

		// Se a ocorrencia não tiver uma investigação e o tipo == 7 //

		if (empty($analise->investigacao->id) && $input['tipo'] == 7) {
			$input['sesmt'] = true;
			$analise->investigacao()->create(['situacao' => 'Em Investigacao']);
		}

		if (!empty(Input::get('pg'))) {
			$pg = Input::get('pg');
		} else {
			$pg = null;
		}

		unset($input['pg']);

		$analise->update($input);

		if (!empty($pg)) {

			switch ($pg) {
				case 'investigacao':

					return Redirect::route('sesmt.investigacao.index');

					break;

				default:
					# code...
					break;
			}

		} else {
			return Redirect::route('sesmt.analise.index');
		}
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

}