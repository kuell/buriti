<?php

class AsoAjustesController extends \BaseController {

	public $asos;

	public function __construct(Aso $aso) {
		$this->asos = $aso;
	}

	/**
	 * Display a listing of the resource.
	 * GET /asoajustes
	 *
	 * @return Response
	 */
	public function index() {
		$asos = $this->asos->ajustes()->get();

		return View::make('farmacia::aso_ajustes.index', compact('asos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /asoajustes/create
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('farmacia::aso_ajustes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /asoajustes
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, [
				'colaborador_id'            => 'required',
				'data'                      => 'required',
				'colaborador_data_admissao' => 'required'
			]);
		if ($validate->passes()) {

			$colaborador = Colaborador::find($input['colaborador_id']);

			$input['colaborador_nome'] = $colaborador->nome;
			$input['colaborador_sexo'] = $colaborador->sexo;

			if (!empty($colaborador->data_nascimento)) {
				$input['colaborador_data_nascimento'] = Format::dbDate($colaborador->data_nascimento);
			}

			$input['colaborador_setor_id']  = $colaborador->setor_id;
			$input['posto_id']              = $colaborador->posto_id;
			$input['colaborador_matricula'] = $colaborador->codigo_interno;
			$input['status']                = 'apto';
			$input['colaborador_funcao_id'] = $colaborador->funcao_id;

			$aso = $this->asos->create($input);

			$aso->save();
			return Redirect::route('farmacia.aso.edit', $aso->id);
		} else {

			return Redirect::route('farmacia.aso_ajustes.index');
		}

	}

	/**
	 * Display the specified resource.
	 * GET /asoajustes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /asoajustes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /asoajustes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$aso           = $this->asos->find($id);
		$aso->situacao = 'fechado';

		$return = $aso->save();

		return true;

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /asoajustes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}