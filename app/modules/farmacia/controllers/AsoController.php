<?php

class AsoController extends \BaseController {

	private $asos;

	public function __construct(Aso $aso) {
		$this->asos = $aso;
	}

	/**
	 * Display a listing of the resource.
	 * GET /aso
	 *
	 * @return Response
	 */
	public function index() {

		if (!empty(Input::get('id'))) {
			echo "<script>window.open('/farmacia/aso/".Input::get('id')."', 'print','changemode=yes');</script>";
		}

		$asos = $this->asos->all();

		return View::make('farmacia::aso.index', compact('asos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aso/create
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('farmacia::aso.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aso
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		if ($input['tipo'] == 'admissional') {
			$colaborador = [
				'nome'            => $input['nome'],
				'setor_id'        => $input['setor_id'],
				'data_nascimento' => $input['data_nascimento'],
				'sexo'            => $input['sexo'],
				'interno'         => false,
				'codigo_interno'  => 0
			];

			$input['colaborador_id'] = Colaborador::create($colaborador)->id;

			unset($input['nome']);
			unset($input['data_nascimento']);
			unset($input['sexo']);
			unset($input['setor_id']);
		} else {
			$colaborador = Colaborador::where('codigo_interno', $input['codigo_interno'])->first();

			$input['colaborador_id'] = $colaborador->id;
			unset($input['setor_id']);
			unset($input['codigo_interno']);
			unset($input['data_nascimento']);
			unset($input['sexo']);
		}

		if (empty($input['posto_id'])) {
			$input['posto_id'] = 0;
		}

		$postoColaborador = ['posto_id' => $input['posto_id'], 'colaborador_id' => $input['colaborador_id']];
		ColaboradorPosto::create($postoColaborador);

		$input['data'] = date('Y-m-d');
		$input['medico'];
		$input['situacao'] = 'aberto';

		$aso = $this->asos->create($input);

		return Redirect::route('farmacia.aso.index', ['id' => $aso->id]);

	}

	/**
	 * Display the specified resource.
	 * GET /aso/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$aso = $this->asos->find($id);

		return View::make('farmacia::aso.show', compact('aso'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /aso/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$aso = $this->asos->find($id);

		return View::make('farmacia::aso.edit', compact('aso'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /aso/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /aso/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}