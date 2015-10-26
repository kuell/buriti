<?php

class ItensController extends \BaseController {

	public $itens;

	public function __construct(Item $item) {
		$this->itens = $item;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$itens = $this->itens->all();

		return View::make('taxas::item.index', compact('itens'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('taxas::item.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->itens->rules);

		if ($validate->passes()) {
			$this->itens->create($input);

			return Redirect::route('taxa.itens.index');
		} else {
			return Redirect::route('taxa.itens.create')
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
		$item = $this->itens->find($id);

		return View::make('taxas::item.edit', compact('item'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$this->itens->rules['descricao'] = $this->itens->rules['descricao'].','.$id;

		$validate = Validator::make($input, $this->itens->rules);

		if ($validate->passes()) {
			$item = $this->itens->find($id);
			$item->update($input);

			return Redirect::route('taxa.itens.edit', $id)->with('message', 'Registro Atualizado com Sucesso!');
		} else {
			return Redirect::route('taxa.itens.create')
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
