<?php

class AtestadoController extends \BaseController {

	private $atestados;
	protected $layout = 'layouts.modulo';
	private $rules      = [];

	public function __construct(Atestado $atestado) {
		$this->atestados = $atestado;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param $data
	 * @return Response
	 */
	public function index() {

		if(!Input::get('data')){
			$data = [date('Y-m-d'), date('Y-m-d')];
		}
		else{
			$data = explode(' - ', Input::get('data'));
		}
		$atestados = $this->atestados->orderBy('id')->get();
		return $this->layout = View::make('farmacia::atestados.index', compact('atestados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('farmacia::atestados.create');
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
			$this->atestados = $this->atestados->create($input);

			return Redirect::route('farmacia.atestados.index');
		} else {
			print_r($validate->errors());
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
		$atestado = $this->atestados->find($id);

		return View::make('farmacia::atestados.edit', compact('atestado'));
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
			$atestado = $this->atestados->find($id);
			$atestado->update($input);

			return Redirect::route('farmacia.atestados.index');
		} else {
			print_r($validate->error());
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

	public function relatorioOperacoes(){
		$input = array_except(Input::all(), '_token');

		Excel::create('Planilha de Controle da Farmacia - Atestado / Cesta Básica', function($excel) {
			$excel->sheet('Excel sheet', function($sheet) {

				$sheet->mergeCells('A1:J5');
				$sheet->setHeight(1, 50);

				$sheet->row(1, function ($row) {
					$row->setFontFamily('Arial');
					$row->setFontSize(20);
				});

				$sheet->cell('A1', function($cell) {
					$cell->setAlignment('center');
				});

				$sheet->row(1, array('Frizelo Frigorificos Ltda.'));

				$input = array_except(Input::all(),'_token');

				$a = new Atestado();
				$a->inicio_afastamento 	= implode('-', array_reverse(explode('/',$input['datai'])));
				$a->fim_afastamento 	= implode('-', array_reverse(explode('/',$input['dataf'])));

				$sheet->setAutoFilter('A6:J6');
				$sheet->setOrientation('landscape');

				$sheet->fromArray($a->listaAtestados($a), null, 'A6', true);

			});
		})->export($input['tipo_arquivo']); 
	}

	public function relatorioRh(){
		$input = array_except(Input::all(), '_token');

		$a = new Atestado();
		$a->inicio_afastamento 	= implode('-', array_reverse(explode('/',$input['datai'])));
		$a->fim_afastamento 	= implode('-', array_reverse(explode('/',$input['dataf'])));

		$dados = $a->atestadoTipo($a);
		return View::make('farmacia::atestados.relatorio_rh', compact('dados'));
	}

	public function exportExcel(){

		Excel::create('Relatorio de Atestados / Cesta Básica', function($excel) {
			$excel->sheet('Excel sheet', function($sheet) {

				$sheet->mergeCells('A1:J5');
				$sheet->setHeight(1, 50);

				$sheet->row(1, function ($row) {
					$row->setFontFamily('Arial');
					$row->setFontSize(20);
				});

				$sheet->cell('A1', function($cell) {
					$cell->setAlignment('center');
				});

				$dados = $this->relatorio_rh();

				$sheet->row(1, array('Frizelo Frigorificos Ltda.'));

				$sheet->loadView('farmacia::atestados.relatorio_rh');

			});
		})->export($input['tipo_arquivo']); 

	}
}
