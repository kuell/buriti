<?php

class CorretorsController extends \BaseController {

	private $corretors;

	public function __construct(Corretor $corretor) {
		$this->corretors = $corretor;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$corretors = $this->corretors->all();

		return View::make('taxas::corretor.index', compact('corretors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('taxas::corretor.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->corretors->rules);

		if ($validate->passes()) {
			$this->corretors->create($input);

			return Redirect::route('taxa.corretors.index');
		} else {
			return Redirect::route('taxa.corretors.create')
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
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
		$corretor = $this->corretors->find($id);

		return View::make('taxas::corretor.edit', compact('corretor'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input                                    = Input::all();
		$this->corretors->rules['nome']           = $this->corretors->rules['nome'].','.$id;
		$this->corretors->rules['codigo_interno'] = $this->corretors->rules['codigo_interno'].','.$id;

		$validate = Validator::make($input, $this->corretors->rules);

		if ($validate->passes()) {
			$corretor = $this->corretors->find($id);
			$corretor->update($input);

			return Redirect::route('taxa.corretors.edit', $id)->with('message', 'Registro atualizado com sucesso.');
			;
		} else {
			return Redirect::route('taxa.corretors.edit', $id)
				->withInput()
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

}
