<?php

class ProdutosController extends \BaseController {

	private $produtos;

	public function __construct(Produto $produto) {
		$this->produtos = $produto;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$produtos = $this->produtos->all();

		return View::make('compras::produtos.index', compact('produtos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('compras::produtos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->produtos->rules);

		if ($validate->passes()) {
			$this->produtos->create($input);
			return Redirect::route('compras.produtos.index');

		} else {
			return Redirect::route('compras.produtos.create')
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
		$produto = $this->produtos->find($id);

		return View::make('compras::produtos.edit', compact('produto'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$validate = Validator::make($input, $this->produtos->rules);

		if ($validate->passes()) {
			$produto = $this->produtos->find($id);
			$produto->update($input);

			return Redirect::route('compras.produtos.edit', $id);

		} else {
			return Redirect::route('compras.produtos.edit', $id)
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

	public function getPedidosAbertos($id) {

	}

}
