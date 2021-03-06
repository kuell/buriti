<?php

class ColaboradorController extends \BaseController {

	private $colaboradors;
	private $reendenize;
	private $rules = array(
		'nome'           => 'required|min:5|unique:v_colaboradors_ativos,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		'setor_id'       => 'required',
	);

	public function __construct(Colaborador $colaborador) {
		$this->beforeFilter('auth');
		$this->colaboradors = $colaborador;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$colaboradores = $this->colaboradors;

		if (!empty(Input::get('situacao'))) {
			$colaboradores = $colaboradores->where('situacao', Input::get('situacao'));
		}

		$colaboradores = $colaboradores->get();

		return View::make('cadastros::colaboradores.index', compact('colaboradores'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make("cadastros::colaboradores.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();
		unset($input['funcao']);

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->create($input);
			return Redirect::route('colaboradors.index');
		} else {
			return Redirect::route('colaboradors.create')
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$colaborador = $this->colaboradors->find($id);

		return View::make('cadastros::colaboradores.edit', compact('colaborador'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$this->rules['nome']           = $this->rules['nome'].','.$id;
		$this->rules['codigo_interno'] = $this->rules['codigo_interno'].', '.$id;

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->find($id);

			$colaborador->update($input);

			return Redirect::route('colaboradors.index');
		} else {
			return Redirect::route('colaboradors.edit', $id)->withInput()
			                                                ->withErrors($validate)
			                                                ->with('message', 'Houve erros na validação dos dados.');
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

	public function getDemitir($id) {
		$colaborador = $this->colaboradors->find($id);

		return View::make('cadastros::colaboradores.demitir', compact('colaborador'));
	}

	public function setDemitir($id) {
		$input             = Input::all();
		$input['situacao'] = 'demitido';

		$colaborador = $this->colaboradors->find($id);

		$colaborador->update($input);

		return Redirect::route('colaboradors.index');

	}

	public function show($id) {

		$colaborador = $this->colaboradors->find($id);
		/**
		 * Verifica se existe filtro de datas
		 * se existir filtra as informaçõe do colaborador
		 **/
		if (!empty(Input::get('periodo'))) {

			$periodo = explode('-', str_replace(' ', '', Input::get('periodo')));

			$datai = implode('-', array_reverse(explode('/', $periodo[0]))).' 00:00:00';
			$dataf = implode('-', array_reverse(explode('/', $periodo[1]))).' 23:59:59';

			$colaborador->ocorrencias = $colaborador->ocorrencias($datai, $dataf);
			$colaborador->atestados   = $colaborador->atestados($datai, $dataf);

		}

		/** **/

		return View::make('cadastros::colaboradores.show', compact('colaborador'));
	}

	public function getAso($id, $aso_tipo) {
		$colaborador = $this->colaboradors->find($id);
		$asos        = $colaborador->asos()->where('tipo', $aso_tipo)->get();

		if (count($asos) == 0) {
			return 0;
		} else {
			return $asos;
		}
	}

	public function colaboradorPorPosto() {

		Excel::create('Planilha de Colaboradores Por Posto de Trabalho', function ($excel) {
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

						$a = [];

						$colaboradors = $this->colaboradors->orderBy('setor_id')->get();

						foreach ($colaboradors as $colaborador) {
							$a[] = [
								'Nome'              => $colaborador->nome,
								'Data de Admissão' => $colaborador->data_admissao,
								'Setor'             => $colaborador->setor_descricao,
								'Posto de Trabalho' => empty($colaborador->posto_trabalho->descricao)?null:$colaborador->posto_trabalho->descricao
							];
						}

						$sheet->setAutoFilter('A6:d6');
						$sheet->setOrientation('landscape');
						$sheet->fromArray($a, null, 'A6', true);
					});
			})->export('xls');

	}
}
