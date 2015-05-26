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

		switch ($input['tipo']) {
			case 'admissional':
				$validate = Validator::make($input, $this->asos->rules['admissional']['create']);
				if ($validate->passes()) {
					$input['colaborador_nome'] = strtoupper($input['colaborador_nome']);

					$aso = $this->asos->create($input);
					return Redirect::route('farmacia.aso.index', ['id' => $aso->id]);
				} else {
					return Redirect::route('farmacia.aso.create')
						->withInput()
						->withErrors($validate)
						->with('message', 'Erro na inclusão das informações!');
				}
				break;

			default:
				$validate = Validator::make($input, $this->asos->rules['periodico']);

				if ($validate->passes()) {
					$colaborador = Colaborador::find($input['colaborador_id']);

					$input = $input+[
						'colaborador_nome'            => strtoupper($colaborador->nome),
						'colaborador_sexo'            => $colaborador->sexo,
						'colaborador_data_nascimento' => $colaborador->data_nascimento,
						'colaborador_setor_id'        => $colaborador->setor_id
					];

					$aso = $this->asos->create($input);
					return Redirect::route('farmacia.aso.index', ['id' => $aso->id]);
				} else {
					return Redirect::route('farmacia.aso.create')
						->withInput()
						->withErrors($validate)
						->with('message', 'Erro na inclusão das informações!');
				}
				break;
		}

		// Inclui os riscos a aso incluida
		if (!empty($input['posto_id'])) {
			foreach (SesmtPostoRisco::where('posto_id', $input['posto_id'])->get() as $risco) {
				if (AsoRisco::where('aso_id', $aso->id)->where('risco_id', $risco->id)->count() < 1) {
					$insert = ['aso_id' => $aso->id, 'risco_id' => $risco->id];
					AsoRisco::create($insert);
				}
			}
		}

		// --- Fim Inclui os riscos a aso incluida

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

		$aso = $this->asos->find($id);

		switch ($aso->tipo) {
			case 'admissional':
				$validate = Validator::make($input, $this->asos->rules['admissional']['update']);

				if ($validate->passes()) {
					$aso->update($input);
					return Redirect::route('farmacia.aso.edit', $id);

				} else {
					return Redirect::route('farmacia.aso.edit', $id)
						->withInput()
						->withErrors($validate)
						->with('message', 'Erro na atualização das informações!');
				}
				break;

			default:
				# code...
				break;
		}

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

	public function setRisco($tipo) {
		if ($tipo == 'true') {
			return AsoRisco::create(Input::all());
		} else {
			$risco = AsoRisco::where('aso_id', Input::get('aso_id'))->where('risco_id', Input::get('risco_id'))->first();

			return $risco->delete();
		}
	}

	public function getExames($aso_id) {
		$aso = $this->asos->find($aso_id);
		return View::make('farmacia::aso.partials._exames', compact('aso'));
	}

	public function setExames($aso_id) {
		$input               = Input::all();
		$input['relacao_id'] = $aso_id;
		$input['tipo_exame'] = 'ASO';

		Exame::create($input);

		return Redirect::route('farmacia.aso.exames', $aso_id);
	}

	public function destroyExame($id) {
		$exame  = Exame::find($id);
		$aso_id = $exame->relacao_id;
		$exame->delete();

		return Redirect::route('farmacia.aso.exames', $aso_id);
	}

	public function setConfirma($id) {
		$input = Input::all();

		$aso         = $this->asos->find($input['aso']);
		$aso->status = $input['classifica'];

		// Se tipo do aso é admissional e a classificação é a apto //

		if ($input['aso'] == 'admissional' && $input['classifica'] == 'apto') {

			$colaborador = [
				'nome'            => $aso->colaborador_nome,
				'codigo_interno'  => $aso->colaborador_matricula,
				'setor_id'        => $aso->colaborador_setor_id,
				'data_nascimento' => $aso->colaborador_data_nascimento,
				'sexo'            => $aso->colaborador_sexo,
				'interno'         => false
			];

			$validate = Validator::make($colaborador, $aso->colaborador->rules);

			if ($validate->passes()) {
				$c                   = Colaborador::create($colaborador);
				$aso->colaborador_id = $c->id;
				return Redirect::route('farmacia.aso.index');
			} else {
				return Redirect::route('farmacia.aso.edit', $id)
					->withInput()
					->withErrors($validate)
					->with('message', 'Erro na inclusão das informações do Colaborador!');
			}

		}
		// Se não se, tipo do aso é demissional e a classificação é apto //
		 elseif ($aso->tipo == 'demissional' && $input['classifica'] == 'apto') {
			$colaborador           = $aso->colaborador;
			$colaborador->situacao = 'demitido';
			$colaborador->obs      = 'Demitido em :'.date('d/m/Y H:i:s').' - Aso: '.$aso->id;
			$colaborador->save();

		}

		print_r($aso->save());
	}

}