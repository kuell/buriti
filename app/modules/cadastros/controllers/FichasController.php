<?php
class FichasController extends BaseController {

	/**
	 * Ficha Repository
	 *
	 * @var Ficha
	 */
	protected $fichas;

	public function __construct(Ficha $ficha) {
		$this->fichas = $ficha;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$fichas = $this->fichas->normais()->get();

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
		$validation = Validator::make($input, $this->fichas->rules);

		if ($validation->passes()) {
			$input['usuario_add'] = Auth::user()->user;

			$id = $this->fichas->create($input);

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
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.show', compact('ficha'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$ficha = $this->fichas->find($id);

		//if (is_null($ficha)) {
		//	return Redirect::route('fichas.index');
		//}

		return View::make('cadastros::fichas.edit', compact('ficha'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = array_except(Input::all(), '_method');

		$this->rules['nome'] = 'required|unique:cadastros.fichas,nome,'.$id;

		$validation = Validator::make($input, $this->rules);

		if ($validation->passes()) {
			$ficha = $this->fichas->find($id);
			$ficha->update($input);
			return Redirect::route('fichas.edit', $id)
				->with('message', 'Registro gravado com sucesso!');
		} else {

			return Redirect::route('fichas.edit', $id)
				->withInput()
				->withErrors($validation)
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
		$this->fichas->find($id)->delete();

		return Redirect::route('fichas.index');
	}

	/**
	 * Busca as informações sobre o RG digitado
	 *
	 */

	public function getInstrucao($id) {
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.partials.instrucao', compact('ficha'));
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
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.partials.cursos', compact('ficha'));
	}

	public function setCurso($id) {
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

	public function destroyCurso($id) {
		$curso    = FichaCurso::find($id);
		$ficha_id = $curso->ficha_id;

		$curso->delete();

		return Redirect::route('fichas.curso', $ficha_id);
	}

	public function getEmpregos($id) {
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.partials.empregos', compact('ficha'));
	}

	public function setEmprego($id) {
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

	public function destroyEmprego($id) {
		$emprego  = FichaEmprego::find($id);
		$ficha_id = $emprego->ficha_id;

		$emprego->delete();

		return Redirect::route('fichas.emprego', $ficha_id);
	}

	public function getParentes($id) {
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.partials.parentes', compact('ficha'));
	}

	public function setParente($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(
			'nome' => 'required',
			'grau' => 'required',
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

	public function destroyParente($id) {
		$parente  = FichaParente::find($id);
		$ficha_id = $parente->ficha_id;

		$parente->delete();

		return Redirect::route('fichas.parente', $ficha_id);
	}

	public function getSetors($id) {
		$ficha = $this->fichas->find($id);

		return View::make('cadastros::fichas.partials.setors', compact('ficha'));
	}

	public function setSetor($id) {
		$input = Input::all()+array('ficha_id' => $id);
		$rules = array(
			'setor_id' => 'required',
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

	public function destroySetor($id) {
		$setor    = FichaSetor::find($id);
		$ficha_id = $setor->ficha_id;

		$setor->delete();

		return Redirect::route('fichas.setor', $ficha_id);
	}

	public function getInformacao($id) {
		$ficha = Ficha::find($id);
		return View::make('fichas.informacao', compact('ficha'));
	}

	public function getSelecionar($id) {
		$ficha = $this->fichas->find($id);
		return View::make('cadastros::fichas.selecionar', compact('ficha'));
	}
	public function setSelecionar($id) {
		$input = Input::all();
		$ficha = $this->fichas->find($id);

		$aso                              = new Aso();
		$aso->tipo                        = 'admissional';
		$aso->posto_id                    = $input['posto_id'];
		$aso->colaborador_setor_id        = $input['setor_id'];
		$aso->colaborador_nome            = utf8_encode($ficha->nome);
		$aso->colaborador_data_nascimento = $ficha->data_nascimento;
		$aso->colaborador_sexo            = $ficha->sexo;
		$aso->colaborador_rg              = $ficha->rg;
		$aso->colaborador_orgao_emissor   = $ficha->emissao;
		$aso->medico                      = "DR PEDRO LUIZ GOMES";
		$aso->ficha_id                    = $id;
		$aso->colaborador_funcao_id       = $input['funcao_id'];

		$aso->save();
		$ficha->update(['situacao' => 0]);

		return Redirect::route('fichas.index');

	}

}
