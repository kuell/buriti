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

			// Se o colaborador não tiver rg e emissor cadastrado //
			if (!empty($input['colaborador_rg']) or !empty($input['colaborador_orgao_emissor'])) {
				$colaborador->rg      = $input['colaborador_rg'];
				$colaborador->emissor = $input['colaborador_orgao_emissor'];
				$colaborador->save();
			}
			// FIM Se o colaborador não tiver rg e emissor cadastrado //

			// Se a aso for mudança de função, salva o setor antigo //
			if ($input['tipo'] == 'mudanca de funcao') {
				$setor = [
					'setor_id' => $colaborador->setor_id,
					'posto_id' => $colaborador->posto_id,
					'aso_id'   => $aso->id];
				$colaborador->setors()->create($setor);
			}
			//FIM Se a aso for mudança de função, salva o setor antigo //

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

		$validate = Validator::make($input, $this->asos->rules[$aso->tipo]);

		if ($validate->passes()) {
			$aso                       = $this->asos->find($id);
			$input['colaborador_nome'] = utf8_decode($input['colaborador_nome']);

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

	public function getFinalizar($id) {
		$aso = $this->asos->find($id);

		return View::make('farmacia::aso.finalizar', compact('aso'));
	}

	public function setFinalizar($id) {
		$input = Input::all();
		$aso   = $this->asos->find($id);

		$aso->update($input);

		if ($input['status'] == 'apto') {

			switch ($aso->tipo) {
				case 'admissional':
					$colaborador = $aso->newColaborador()->toArray()+['interno' => 0];

					$validate = Validator::make($colaborador, $this->colaborador->rules);

					if ($validate->passes()) {

						$col = Colaborador::create($colaborador);

						$aso->update(['situacao' => 'fechado', 'colaborador_id' => $col->id, 'status' => 'apto']);
						return "Aso finalizada \n Colaborador incluido com sucesso! \n :)";
					} else {
						return "Houve erros na inclusão do colaborador! \n Possiveis erros: \n\n ".implode("\n", $validate->errors()->all());
					}

					break;

				case 'demissional':
					$aso->update(['situacao'                => 'fechado', 'status'                => 'apto']);
					$aso->colaborador()->update(['situacao' => 'demitido']);

					return "Aso finalizada \n Colaborador demitido com sucesso! \n :)";

					break;
				case 'mudanca de funcao':
					$colaborador           = $aso->colaborador;
					$colaborador->setor_id = $aso->colaborador_setor_id;
					$colaborador->posto_id = $aso->posto_id;
					$colaborador->save();

					$colaborador->funcaos()->create(['funcao_id' => $aso->colaborador_funcao_id, 'data_mudanca' => $aso->created_at]);

					$aso->update(['situacao' => 'fechado', 'status' => 'apto']);

					return "Aso finalizada \n Alterada a função do colaborador! \n :)";

					break;

				default:
					$aso->update(['situacao' => 'fechado', 'status' => 'apto']);

					return "Aso finalizada com sucesso! \n :)";

					break;
			}

		} else {

			switch ($aso->tipo) {
				case 'admissional':
					$aso->update(['situacao' => 'fechado', 'status' => $input['status']]);

					if ($aso->ficha) {
						$aso->ficha()->update(['situacao' => 2]);
					}

					return 'ASO finalizada com sucesso!';

					break;
				case 'mudanca de funcao':
					$colaborador           = $aso->colaborador;
					$colaborador->setor_id = $aso->colaborador_setor_id;
					$colaborador->posto_id = $aso->posto_id;
					$colaborador->save();

					$colaborador->funcaos()->create(['funcao_id' => $aso->colaborador_funcao_id, 'data_mudanca' => $aso->created_at]);

					$aso->update(['situacao' => 'fechado', 'status' => 'apto']);

					return "Aso finalizada \n Alterada a função do colaborador! \n :)";

					break;

				default:
					$aso->update(['situacao' => 'fechado', 'status' => 'inapto']);

					return "Aso finalizada com sucesso! \n :)";

					break;
			}

		}
	}
}