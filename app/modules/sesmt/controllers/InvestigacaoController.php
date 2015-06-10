<?php

class InvestigacaoController extends \BaseController {
	public $investigacao;
	public $ocorrencias;

	public function __construct(Investigacao $investigacao, Ocorrencia $ocorrencia) {
		$this->investigacao = $investigacao;
		$this->ocorrencias  = $ocorrencia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$ocorrencias = Ocorrencia::where('tipo', '<>', 'outros')->get();

		return View::make('sesmt::investigacao.index', compact('ocorrencias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$ocorrencia = Ocorrencia::find(Input::get('ocorrencia'));

		return View::make('sesmt::investigacao.create', compact('ocorrencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$investigacao = Investigacao::where('ocorrencia_id', $input['ocorrencia_id'])->first();

		/*
		 * Verifica se ja começou a fazer a investigação
		 * 	Não -> Cria nova investigação
		 */
		if (!count($investigacao)) {
			$input['situacao'] = 'Em investigacao';
			$investigacao      = $this->investigacao->create($input);
		}

		return Redirect::route('sesmt.investigacao.edit', $investigacao->id);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$ocorrencia = $this->ocorrencias->find($id);

		return View::make('sesmt::investigacao.show', compact('ocorrencia'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$investigacao = $this->investigacao->find($id);
		$pg           = Input::get('pg');

		switch ($pg) {
			case 'organizacao':
				$epi = $investigacao->epis->count();
				print_r($epi);
				die;
				if ($epi == 0) {
					$investigacao->usava_epi = false;
				}
			default:
				$pg = 'epis';
				break;
		}

		return View::make('sesmt::investigacao.edit', compact('investigacao'))->with('pg', $pg);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), 'pg');
		$pg    = Input::get('pg');

		$investigacao = $this->investigacao->find($id);
		$res          = $investigacao->update($input);

		switch ($pg) {
			case 'epis':
				if ($investigacao->usava_epi || $input['usava_epi']) {
					if (!$investigacao->epis->count()) {
						$pg                       = 'epis';
						$investigacao->motivo_epi = null;
						$investigacao->save();

					} else {
						$pg = 'organizacao';
					}
				} else {
					if (!$investigacao->motivo_epi) {
						$investigacao->epis()->delete();
						$pg = "epis";
					} else {
						$pg = 'organizacao';
					}
				}
				break;
			case 'organizacao':
				if ($res) {
					$pg = 'ocorrencia';
				}
				break;
			case 'ocorrencia':
				if ($res) {
					$pg = 'informacao';
				}
				break;

			default:
				# code...
				break;
		}

		return View::make('sesmt::investigacao.edit', compact('investigacao'))->with('pg', $pg);
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

	public function getEpi($id) {
		$investigacao = Investigacao::find($id);

		return View::make('sesmt::investigacao.partials.epi_add', compact('investigacao'));
	}

	public function postEpi($id) {
		$input = Input::all();

		InvesticacaoEpi::create($input);
		return Redirect::route('sesmt.investigacao.epi', $id);
	}

	public function destroyEpi($id) {
		$epi = InvesticacaoEpi::find($id);
		$id  = $epi->investigacao_id;

		$epi->delete();

		return Redirect::route('sesmt.investigacao.epi', $id);
	}

}
