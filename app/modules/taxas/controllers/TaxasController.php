<?php

class TaxasController extends \BaseController {

	public $taxas;

	public function __construct(Taxa $taxa) {
		$this->taxas = $taxa;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$taxas = $this->taxas->periodo();

		if (!empty(Input::get('corretor_id'))) {
			$taxas = $taxas->corretor();
		}
		$taxas = $taxas->get();

		return View::make('taxas::taxa.index', compact('taxas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('taxas::taxa.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->taxas->rules);

		if ($validate->passes()) {
			$taxa = $this->taxas->create($input);

			return Redirect::route('taxa.taxas.edit', $taxa->id);
		} else {
			return Redirect::route('taxa.taxas.create')
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
		$taxa = $this->taxas->find($id);

		return View::make('taxas::taxa.edit', compact('taxa'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
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

	public function getItens($id) {
		$taxa = $this->taxas->find($id);

		return View::make('taxas::taxa.itens', compact('taxa'));
	}

	public function setItem($id) {
		$taxa = $this->taxas->find($id);
		$item = new TaxaItem();

		$input = Input::all();

		$validate = Validator::make($input, $item->rules);

		if ($validate->passes()) {
			$taxa->itens()->create($input);

			return Redirect::route('taxa.taxas.itens', $id);
		} else {
			return Redirect::route('taxa.taxas.itens')
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}

	}

	public function destroyItem($id) {
		$taxa = $this->taxas->find($id);
		$taxa->itens->find(Input::get('item_id'))->delete();
	}

}
