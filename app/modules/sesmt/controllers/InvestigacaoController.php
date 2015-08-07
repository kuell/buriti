<?php

class InvestigacaoController extends \BaseController {
	public $investigacaos;

	public function __construct(Investigacao $investigacao, Ocorrencia $ocorrencia) {
		$this->investigacaos = $investigacao;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$investigacaos = $this->investigacaos->all();

		return View::make('sesmt::investigacao.index', compact('investigacaos'));
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
			$investigacao      = $this->investigacaos->create($input);
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
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.show', compact('investigacao'));
		//$pdf = DPDF::loadView('sesmt::investigacao.show', compact('investigacao'));
		//$pdf->download();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

		return View::make('sesmt::investigacao.edit', compact('investigacao'))->with('pg', $pg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$investigacao = $this->investigacaos->find($id);

		$investigacao->delete();

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

	public function getRedirecionar($id) {
		$ocorrencia = Ocorrencia::find($id);

		return View::make('sesmt::investigacao.redirecionar', compact('ocorrencia'));
	}

	public function setRedirecionar($id) {
		$input      = Input::all();
		$ocorrencia = Ocorrencia::find($id);

		if ($ocorrencia->update($input)) {
			$ocorrencia->investigacao->delete();
		}

		return Redirect::route('sesmt.investigacao.index');
	}

}
