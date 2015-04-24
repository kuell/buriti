<?php

class SetorsController extends \BaseController {

	private $rules = array(
		'descricao' => 'required|unique:setors,descricao',
	);
	private $setors;

	public function __construct(Setor $setor) {
		$this->setors = $setor;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$setors = $this->setors->orderBy('descricao')->get();

		return View::make('cadastros::setors.index', compact('setors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('cadastros::setors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$this->setors->create($input);

			return Redirect::route('setors.index');
		}

		return Redirect::route('setors.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$setor = Setor::all();

		foreach ($setor as $i) {
			echo $i->descricao.'<br />';
			echo '<ul>';
			foreach ($setor->internos as $s) {
				echo '<li>'.$s->nome.'<li />';
			}

			echo '</ul>';
		}

		die;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$setor = $this->setors->find($id);

		return View::make('cadastros::setors.edit', compact('setor'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), '_method');

		$this->rules = array('descricao' => 'required|unique:setors,descricao,'.$id);

		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$setor = $this->setors->find($id);
			$setor->update($input);

			return Redirect::route('setors.index');
		}

		return Redirect::route('setors.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
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

	public function getFuncao($id) {

		$funcaos = $this->setors->find($id)->funcaos;

		return View::make('cadastros::setors.elementos.funcao', compact('funcaos'));

	}

	public function getPosto($id) {
		$setor = $this->setors->find($id);

		return View::make('cadastros::setors.elementos.posto_trabalho', compact('setor'));
	}

	public function postPosto($id) {
		$input = Input::all()+['setor_id' => $id];

		SetorPosto::create($input);

		return Redirect::route('setors.posto', $id);

	}

	public function destroyPosto($posto_id) {
		$posto = SetorPosto::find($posto_id);
		$setor = $posto->setor_id;

		$posto->delete();

		return Redirect::route('setors.posto', $setor);

	}

	public function getAtividades($id) {
		$posto = SetorPosto::find($id);

		return View::make('cadastros::setors.elementos.posto_atividades', compact('posto'));
	}

	public function postAtividades($id) {
		$input = Input::all()+['posto_id' => $id];

		SetorPostoAtividade::create($input);

		return Redirect::route('setors.posto.atividades', $id);
	}

	public function destroyAtividade($atividade_id) {
		$atividade = SetorPostoAtividade::find($atividade_id);
		$posto     = $atividade->posto_id;

		$atividade->delete();

		return Redirect::route('setors.posto.atividades', $posto);

	}

}
