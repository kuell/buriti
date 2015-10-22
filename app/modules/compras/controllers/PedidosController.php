<?php

class PedidosController extends \BaseController {

	private $pedidos;

	public function __construct(Pedido $pedido) {
		$this->pedidos = $pedido;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$pedidos = $this->pedidos->all();

		return View::make('compras::pedidos.index', compact('pedidos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('compras::pedidos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->pedidos->rules);

		if ($validate->passes()) {
			$pedido = $this->pedidos->create($input);

			return Redirect::route('compras.pedidos.edit', $pedido->id);
		} else {
			return Redirect::route('compras.pedidos.create')
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
		$pedido = $this->pedidos->find($id);

		return View::make('compras::pedidos.edit', compact('pedido'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		$validate = Validator::make($input, $this->pedidos->rules);

		if ($validate->passes()) {
			$pedido = $this->pedidos->find($id);
			$pedido->update($input);

			return Redirect::route('compras.pedidos.edit', $pedido->id);
		} else {
			return Redirect::route('compras.pedidos.create')
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

	public function getProdutos($id) {
		$pedido = $this->pedidos->find($id);

		return View::make('compras::pedidos.produtos', compact('pedido'));
	}

	public function setProdutos($id) {
		$input  = Input::all();
		$pedido = $this->pedidos->find($id);
		$rules  = new PedidoProduto();

		$validate = Validator::make($input, $rules->rules);

		if ($validate->passes()) {
			$pedido->produtos()->create($input);
			return Redirect::route('compras.pedidos.produtos', $id);
		} else {
			return Redirect::route('compras.pedidos.produtos', $id)
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}

	}

	public function destroyProdutos($id) {
		$pedido = $this->pedidos->find($id)->produtos->find(Input::get('produto_id'))->delete();

		return 'Produto excluido com sucesso!';

	}

}
