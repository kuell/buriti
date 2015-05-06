<?php

class ColaboradorController extends \BaseController {

	private $colaboradors;
	private $reendenize;
	private $rules = array(
		'nome'           => 'required|min:5|unique:colaboradors,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		'setor_id'       => 'required',
	);

	public function __construct(Colaborador $colaborador) {
		$this->beforeFilter('auth');
		$this->colaboradors = $colaborador;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$colaboradores = $this->colaboradors->all();

		return View::make('cadastros::colaboradores.index', compact('colaboradores'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make($this->reendenize."create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->create($input);
			return Redirect::route('cadastros::colaborador.index');
		} else {
			return Redirect::route('cadastros::colaboradors.create')
				->withInput()
				->withErrors($validate)
				->with('message', 'Houve erros na validação dos dados.');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$colaborador = $this->colaboradors->find($id);

		return View::make('cadastros::colaboradores.edit', compact('colaborador'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::all();

		// Verifica se a função existe no setor //
		$funcao = SetorFuncao::where('descricao', $input['funcao'])->where('setor_id', $input['setor_id'])->get();

		if (!count($funcao)) {
			$f    = ['setor_id' => $input['setor_id'], 'descricao' => $input['funcao']];
			$func = SetorFuncao::create($f);
		} else {
			$func = $funcao->first();
		}

		// Fim verifica setor funcao

		// Atualiza função do colaborador
		$colaboradorFuncao = ['colaborador_id' => $id, 'funcao_id' => $func->id, 'data_mudanca' => date('Y-m-d H:i:s')];
		ColaboradorFuncao::create($colaboradorFuncao);
		// Fim verifica funcao colaborador

		unset($input['funcao']);

		$this->rules['nome']           = $this->rules['nome'].', '.$id;
		$this->rules['codigo_interno'] = $this->rules['codigo_interno'].', '.$id;

		$validate = Validator::make($input, $this->rules);

		if ($validate->passes()) {
			$colaborador = $this->colaboradors->find($id);
			$colaborador->update($input);

			return Redirect::route('colaboradors.index');
		} else {
			return Redirect::route('colaboradors.edit', $id)->withInput()
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

	public function show($id) {
		$colaborador = $this->colaboradors->find($id);

		return View::make('cadastros::colaboradores.show', compact('colaborador'));
	}

}
