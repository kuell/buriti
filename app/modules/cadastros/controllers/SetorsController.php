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

			return Redirect::route('cadastro.setors.index');
		}

		return Redirect::route('cadastro.setor.create')
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

			return Redirect::route('cadastro.setors.index');
		}

		return Redirect::route('cadastro.setors.edit', $id)
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

}
