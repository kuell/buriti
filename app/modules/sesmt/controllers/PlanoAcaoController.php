<?php

class PlanoAcaoController extends \BaseController {

	protected $ocorrencias;

	public function __construct(Ocorrencia $ocorrencia) {
		$this->ocorrencias = $ocorrencia;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$ocorrencias = $this->ocorrencias->finalizadas()->get();

		return View::make('sesmt::plano_acao.index', compact('ocorrencias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$ocorrencia = $this->ocorrencias->find(Input::get('id'));

		return View::make('sesmt::plano_acao.form', compact('ocorrencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input      = Input::all();
		$ocorrencia = $this->ocorrencias->find($input['ocorrencia_id']);

		unset($input['id']);

		$ocorrencia->planoAcaos()->create($input);

		return Redirect::route('sesmt.plano_acao.create', ['id' => $ocorrencia->id]);

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

		return View::make('sesmt::plano_acao.plano_acao', compact('ocorrencia'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$plano      = PlanoAcao::find($id);
		$ocorrencia = $plano->ocorrencia;
		$plano->update(['situacao' => 'Finalizado']);

		return Redirect::route('sesmt.plano_acao.create', ['id' => $ocorrencia->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$plano      = PlanoAcao::find($id);
		$ocorrencia = $plano->ocorrencia;
		$plano->delete();

		return Redirect::route('sesmt.plano_acao.create', ['id' => $ocorrencia->id]);
	}

}
