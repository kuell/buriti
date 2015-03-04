<?php

class OcorrenciasController extends \BaseController {

	private $ocorrencias;
	private $rules = [];

	public function __construct(Ocorrencia $ocorrencia) {
		$this->ocorrencias = $ocorrencia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$ocorrencias = $this->ocorrencias->orderBy('data_hora')->get();

		return View::make('farmacia::ocorrencias.index', compact('ocorrencias'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('farmacia::ocorrencias.create');
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

						$datai = implode('-', array_reverse(explode('/', Input::get('datai'))));
						$dataf = implode('-', array_reverse(explode('/', Input::get('dataf'))));

						$a = Ocorrencia::getRelatorioOperacoes($datai, $dataf);

						$sheet->setAutoFilter('A6:J6');
						$sheet->setOrientation('landscape');

						$sheet->fromArray($a, null, 'A6', true);

					});
			})->export('xls');

	}

}
