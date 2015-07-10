<?php

class OcorrenciasController extends \BaseController {

	private $ocorrencias;

	public function __construct(Ocorrencia $ocorrencia) {
		$this->ocorrencias = $ocorrencia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$ocorrencias = $this->ocorrencias;

		if (!empty(Input::get('id'))) {
			$ocorrencias = $ocorrencias->where('id', Input::get('id'))->get();
		} else {
			$periodo = 'date(data_hora) = date(now())';
			if (!empty(Input::get('periodo'))) {
				$periodo    = explode(' - ', Input::get('periodo'));
				$periodo[0] = implode('-', array_reverse(explode('/', $periodo[0])));
				$periodo[1] = implode('-', array_reverse(explode('/', $periodo[1])));

				$periodo = "date(data_hora) between '".$periodo[0]."' and '".$periodo[1]."'";
			}
			$ocorrencias = $this->ocorrencias->whereRaw($periodo);

			if (empty(Input::get('colaborador_id'))) {
				$ocorrencias = $ocorrencias->get();
			} else {
				$ocorrencias = $ocorrencias->where('colaborador_id', Input::get('colaborador_id'))->get();
			}
		}

		return View::make('farmacia::ocorrencias.index', compact('ocorrencias'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$ocorrencia = $this->ocorrencias;

		return View::make('farmacia::ocorrencias.create', compact('ocorrencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$input = array_except($input, 'codigo_interno');

		$validate = Validator::make($input, $this->ocorrencias->rules);

		if ($validate->passes()) {
			$ocorrencia = $this->ocorrencias = $this->ocorrencias->create($input);

			//-- Se o campo 'Encaminhar para sesmt' for true --//
			if($ocorrencia->sesmt){
				$ocorrencia->investigacao()->create(['situacao'=>'Em investigacao']);
			}
			//-- FIM Se o campo 'Encaminhar para sesmt' for true --//

			return Redirect::route('farmacia.ocorrencias.edit', $ocorrencia->id);
		} else {
			return Redirect::route('farmacia.ocorrencias.create')
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$ocorrencia = $this->ocorrencias->find($id);

		return View::make('farmacia::ocorrencias.edit', compact('ocorrencia'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), 'codigo_interno');

		$validate = Validator::make($input, $this->ocorrencias->rules);

		if ($validate->passes()) {
			$ocorrencia = $this->ocorrencias->find($id);
			$ocorrencia->update($input);

			return Redirect::route("farmacia.ocorrencias.edit", $id);
		} else {
			return Redirect::route('farmacia.ocorrencias.edit', $id)
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
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

	/**
	 *	Relatorio de Ocorrencias
	 * @return  excel lista de ocorrencias do periodo
	 */
	public function getRelatorio() {

		Excel::create('Planilha de Controle da Farmacia - Ocorrencias', function ($excel) {
				$excel->sheet('Ref. ', function ($sheet) {

						$sheet->mergeCells('A1:J5');
						$sheet->setHeight(1, 50);

						$sheet->row(1, function ($row) {
								$row->setFontFamily('Arial');
								$row->setFontSize(20);
							});

						$sheet->cell('A1', function ($cell) {
								$cell->setAlignment('center');
							});
						$sheet->getStyle('D')->getAlignment()->setWrapText(true);

						$sheet->row(1, array('Frizelo Frigorificos Ltda.'));

						$data = explode('-', Input::get('periodo'));

						$datai = implode('-', array_reverse(explode('/', $data[0])));

						$dataf = implode('-', array_reverse(explode('/', $data[1])));

						$a = Ocorrencia::getRelatorioOperacoes(str_replace(' ', '', $datai), str_replace(' ', '', $dataf));

						$sheet->setAutoFilter('A6:J6');
						$sheet->setOrientation('landscape');

						$sheet->fromArray($a, null, 'A6', true);

					});
			})->export('xls');

	}
	public function getElemento($id) {
		$elementos = FarmaciaElemento::find($id);
		return $elementos->elementos_filho()->get()->toJson();
	}

	public function getElementos() {
		$elementos = FarmaciaElemento::whereNull('elemento_pai')->get();

		return View::make('farmacia::ocorrencias.elementos.index', compact('elementos'));
	}

	public function postElementos() {
		$input = Input::all();

		foreach ($input['form'] as $elemento) {
			if ($elemento['name'] != 'elemento_add' && $elemento['value'] != null) {
				$e = ['elemento_pai' => $elemento['value']];
			}
		}
		$e = $e+['descricao' => $input['form'][count($input['form'])-1]['value']];

		return FarmaciaElemento::create($e);

	}

	public function getMedicamentos($id) {
		$ocorrencia = $this->ocorrencias->find($id);

		return View::make('farmacia::ocorrencias.elementos.medicamento', compact('ocorrencia'));
	}

	public function addMedicamento($ocorrencia_id) {
		$input       = Input::all()+['ocorrencia_id' => $ocorrencia_id];
		$ocorrencia  = $this->ocorrencias->find($ocorrencia_id);
		$medicamento = new OcorrenciaMedicacao();

		$validate = Validator::make($input, $medicamento->rules);

		if ($validate->passes()) {
			OcorrenciaMedicacao::create($input);

			return Redirect::route('farmacia.ocorrencias.medicamentos', $ocorrencia_id);
		} else {
			return Redirect::route('farmacia.ocorrencias.medicamentos', $ocorrencia_id)
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}

	}

	public function destroyMedicamento($medicamento_id) {
		$medicamento   = OcorrenciaMedicacao::find($medicamento_id);
		$ocorrencia_id = $medicamento->ocorrencia_id;

		$medicamento->delete();

		return Redirect::route('farmacia.ocorrencias.medicamentos', $ocorrencia_id);

	}

	public function getAtestados($id) {
		$ocorrencia = $this->ocorrencias->find($id);
		$atestado   = new OcorrenciaAtestado();
		$lista      = true;

		if (!empty(Input::get('lista'))) {
			$lista = false;
		} else if (!empty(Input::get('id'))) {
			$atestado = $ocorrencia->atestados()->find(Input::get('id'));
		}

		return View::make('farmacia::ocorrencias.elementos.atestados', compact('ocorrencia'), compact('atestado'))->with('lista', $lista);
	}

	public function addAtestados($id) {
		$input                       = Input::all();
		$ocorrencia                  = $this->ocorrencias->find($id);
		$periodo                     = explode(' - ', $input['periodo_afastamento']);
		$input['inicio_afastamento'] = $periodo[0];
		$input['fim_afastamento']    = $periodo[1];
		unset($input['periodo_afastamento']);

		if (!empty(Input::get('atestado_id'))) {
			$atestado = $ocorrencia->atestados()->find(Input::get('atestado_id'));
			unset($input['atestado_id']);
			$atestado->update($input);

		} else {
			$ocorrencia->atestados()->create($input);
		}

		return Redirect::route('farmacia.ocorrencias.atestados', [$id, 'lista' => $id]);

	}

	public function getReport($tipo = null) {

		switch ($tipo) {
			case 's':
				$dados = DB::select('Select
										extract(month from data_hora) as mes,
										extract(year from data_hora) as ano,
										c.id as setor,
										b.nome,
										count(*) as total
									from
										farmacia_ocorrencias a
										inner join colaboradors b on a.colaborador_id = b.id
										inner join setors c on b.setor_id = c.id
									where
										extract(year from data_hora) = ?
									group by
										c.id, b.id, extract(month from data_hora), extract(year from data_hora)
									order by
										extract(month from data_hora), count(*) desc'	, ['2015']);

				foreach ($dados as $val) {
					$returns[$val->setor][$val->nome][$val->ano][$val->mes] = $val->total;
				}
			case 'c':

				break;
			case 'sc':

				break;

			default:

				return Ocorrencia::all();
				break;
		}

		return View::make('farmacia::ocorrencias.report', compact('returns'));

	}

}
