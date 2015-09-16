<?php

class AsoController extends \BaseController {

	private $asos;
	private $colaborador;

	public function __construct(Aso $aso) {
		$this->asos        = $aso;
		$this->colaborador = new Colaborador();
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

		$asos = $this->asos->abertos()->get();

		return View::make('farmacia::aso.index', compact('asos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /aso/create
	 *
	 * @return Response
	 */
	public function create() {
		$aso       = $this->asos;
		$aso->tipo = Input::get('tipo');

		if (!empty(Input::get('tipo')) && !empty(Input::get('colaborador_id'))) {
			$colaborador                      = Colaborador::find(Input::get('colaborador_id'));
			$aso->colaborador_sexo            = $colaborador->sexo;
			$aso->colaborador_data_nascimento = $colaborador->data_nascimento;
			$aso->colaborador_rg              = $colaborador->rg;
			$aso->colaborador_orgao_emissor   = $colaborador->emissor;
			$aso->colaborador_setor_id        = $colaborador->setor_id;
			$aso->posto_id                    = $colaborador->posto_id;
			$aso->colaborador_funcao_id       = $colaborador->funcao_id;
			$aso->colaborador_data_admissao   = $colaborador->data_admissao;

			return View::make('farmacia::aso.form', compact('aso'));
		} else {
			return View::make('farmacia::aso.create', compact('aso'));
		}

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /aso
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->asos->rules['outros']);

		if ($validate->passes()) {
			$colaborador       = Colaborador::find($input['colaborador_id']);
			$input['posto_id'] = $colaborador->posto_id;

			$aso = $this->asos->create($input);

			if (!empty($input['colaborador_rg']) or !empty($input['colaborador_orgao_emissor'])) {
				$colaborador->rg      = $input['colaborador_rg'];
				$colaborador->emissor = $input['colaborador_orgao_emissor'];
				$colaborador->save();
			}

			// Inclui os riscos a aso incluida
			if (!empty($input['posto_id'])) {
				foreach (SesmtPostoRisco::where('posto_id', $input['posto_id'])->get() as $risco) {
					if (AsoRisco::where('aso_id', $aso->id)->where('risco_id', $risco->id)->count() < 1) {
						$insert = ['aso_id' => $aso->id, 'risco_id' => $risco->id];
						AsoRisco::create($insert);
					}
				}

				return Redirect::route('farmacia.aso.index', ['id' => $aso->id]);

			}
		} else {
			echo "Ola";
			print_r($validate->errors());
			die;

		}
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
		$input = array_except(Input::all(), '_method');

		$validate = Validator::make($input, $this->asos->rules['admissional']);

		if ($validate->passes()) {
			$aso = $this->asos->find($id);
			$aso->update($input);

			return Redirect::route('farmacia.aso.edit', $id);
		} else {

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
		$aso = $this->asos->find($id);

		$aso->status   = 'inapto';
		$aso->situacao = 'fechado';
		$aso->obs      = 'ASO REPROVADA POR '.Auth::user()->user;
		$aso->save();

		if (count($aso->ficha)) {
			$ficha           = $aso->ficha;
			$ficha->situacao = 2;
			$ficha->save();
		}

		return Redirect::route('farmacia.aso.index');
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

		AsoExame::create($input);

		return Redirect::route('farmacia.aso.exames', $aso_id);
	}

	public function destroyExame($id) {
		$exame  = AsoExame::find($id);
		$aso_id = $exame->relacao_id;
		$exame->delete();

		return Redirect::route('farmacia.aso.exames', $aso_id);
	}

}