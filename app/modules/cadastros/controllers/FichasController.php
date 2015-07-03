<?php
class FichasController extends BaseController {

	/**
	 * Ficha Repository
	 *
	 * @var Ficha
	 */
	protected $ficha;

	public function __construct(Ficha $ficha) {
		$this->ficha = $ficha;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$fichas = $this->ficha->all();

		return View::make('cadastros::fichas.index', compact('fichas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$ficha = new Ficha();
		return View::make('cadastros::fichas.create', compact('ficha'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input      = Input::all()+array('situacao' => 1);
		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$id = $this->ficha->create($input);
			return Redirect::route('fichas.edit', $id->id);
		}

		return Redirect::route('fichas.create')
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
		$ficha = $this->ficha->findOrFail($id);
		$pdf   = PDF::loadView('fichas.show2', compact('ficha'));

		return $pdf->stream();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$ficha = $this->ficha->find($id);

		if (is_null($ficha)) {
			return Redirect::route('fichas.index');
		}

		return View::make('fichas.edit', compact('ficha'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), '_method');

		$this->rules['nome'] = 'required|unique:fichas,nome,'.$id;
		$this->rules['rg']   = 'required|unique:fichas,rg,'.$id;

		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$ficha = $this->ficha->find($id);
			$ficha->update($input);
			return Redirect::route('fichas.edit', $id)
				->with('message', 'Registro gravado com sucesso!');
		}

		return Redirect::route('fichas.edit', $id)
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
		$this->ficha->find($id)->delete();

		return Redirect::route('fichas.index');
	}

	/**
	 * Busca as informações sobre o RG digitado
	 *
	 */

	public function getInstrucao($id) {
		$ficha = $this->ficha->find($id);

		return View::make('fichas.instrucao.index', compact('ficha'));
	}

	public function setInstrucao($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(
			'descricao' => 'required',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->passes()) {
			$instrucao = new FichaInstrucao();
			$instrucao->create($input);

			return Redirect::route('fichas.instrucao', $id);

		}
		return Redirect::route('fichas.instrucao', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	public function destroyInstrucao($id) {
		$instrucao = FichaInstrucao::find($id);
		$ficha_id  = $instrucao->ficha_id;

		$instrucao->delete();

		return Redirect::route('fichas.instrucao', $ficha_id);
	}

	public function getCursos($id) {
		$ficha = $this->ficha->find($id);

		return View::make('fichas.cursos.index', compact('ficha'));
	}

	public function setCursos($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(
			'descricao' => 'required',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->passes()) {
			$curso = new FichaCurso();
			$curso->create($input);

			return Redirect::route('fichas.curso', $id);

		}
		return Redirect::route('fichas.curso', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	public function destroyCursos($id) {
		$curso    = FichaCurso::find($id);
		$ficha_id = $curso->ficha_id;

		$curso->delete();

		return Redirect::route('fichas.curso', $ficha_id);
	}

	public function getEmpregos($id) {
		$ficha = $this->ficha->find($id);

		return View::make('fichas.empregos.index', compact('ficha'));
	}

	public function setEmpregos($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(
			'empresa' => 'required',
		);

		$validation = Validator::make($input, $rules);

		if ($validation->passes()) {
			$emprego = new FichaEmprego();
			$emprego->create($input);

			return Redirect::route('fichas.emprego', $id);

		}
		return Redirect::route('fichas.emprego', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	public function destroyEmpregos($id) {
		$emprego  = FichaEmprego::find($id);
		$ficha_id = $emprego->ficha_id;

		$emprego->delete();

		return Redirect::route('fichas.emprego', $ficha_id);
	}

	public function getParentes($id) {
		$ficha = $this->ficha->find($id);

		return View::make('fichas.parentes.index', compact('ficha'));
	}

	public function setParentes($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(

		);

		$validation = Validator::make($input, $rules);

		if ($validation->passes()) {
			$parente = new FichaParente();
			$parente->create($input);

			return Redirect::route('fichas.parente', $id);

		}
		return Redirect::route('fichas.parente', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	public function destroyParentes($id) {
		$parente  = FichaParente::find($id);
		$ficha_id = $parente->ficha_id;

		$parente->delete();

		return Redirect::route('fichas.parente', $ficha_id);
	}

	public function getSetors($id) {
		$ficha = $this->ficha->find($id);

		return View::make('fichas.setors.index', compact('ficha'));
	}

	public function setSetors($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(

		);

		$validation = Validator::make($input, $rules);

		if ($validation->passes()) {
			$setor = new FichaSetor();
			$setor->create($input);

			return Redirect::route('fichas.setor', $id);

		}
		return Redirect::route('fichas.setor', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Houve erros na validação dos dados.');
	}

	public function destroySetors($id) {
		$setor    = FichaSetor::find($id);
		$ficha_id = $setor->ficha_id;

		$setor->delete();

		return Redirect::route('fichas.setor', $ficha_id);
	}

	public function getInformacao($id) {
		$ficha = Ficha::find($id);
		return View::make('fichas.informacao', compact('ficha'));
	}

	public function buscaRg() {

		$ficha = Ficha::where('rg', '=', Input::get('rg'))->get();

		if (!$ficha) {
			return '';

		} else {
			return Response::json($ficha);
		}

	}

}
