<?php

class QueixasController extends \BaseController {

	protected $queixas;

	public function __construct(Queixa $queixa) {
		$this->queixas = $queixa;
	}
	/**
	 * Display a listing of the resource.
	 * GET /queixas
	 *
	 * @return Response
	 */
	public function index() {
		$queixas = $this->queixas->all();

		return View::make('farmacia::queixas.index', compact('queixas'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /queixas/create
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /queixas
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		if ($input['descricao']) {
			$this->queixas->create($input);

		} else {
			echo '<script type="text/javascript">
					alert("Erro na inclusão das informações!")
				</script>';
		}

		return Redirect::route('farmacia.queixas.index');
	}

	/**
	 * Display the specified resource.
	 * GET /queixas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /queixas/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$queixa  = $this->queixas->find($id);
		$queixas = $this->queixas->all();

		return View::make('farmacia::queixas.index', compact('queixa'), compact('queixas'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /queixas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), '_method');

		if ($input['descricao']) {
			$queixa = $this->queixas->find($id);

			$queixa->update($input);

		} else {
			echo '<script type="text/javascript">
					alert("Erro na inclusão das informações!")
				</script>';
		}

		return Redirect::route('farmacia.queixas.index');

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /queixas/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}