<?php

class OrdemInternaController extends \BaseController {

	private $ordem_internas;
	private $rules = [];

	public function __construct(OrdemInterna $ordem_interna){
		$this->ordem_internas = $ordem_interna;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$ordem_internas = $this->ordem_internas->all();

		return View::make('ordem_interna.index', compact('ordem_internas'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ordem_interna.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);

		if($validator->passes()){
			//Inclusão na tabela equipamentos se não existir
			
				$equipamento = Equipamento::where('descricao', '=', $input['equipamento_id'])->get();

					if(!$equipamento->count()){
						$equip = new Equipamento();
						
						$equip->descricao = $input['equipamento_id'];
						$equip->setor_id = $input['setor_requisitante_id'];
						$equip->save();
					}
					else{
						$equip = Equipamento::where('descricao', '=', $input['equipamento_id'])->first();
					}
				$input['equipamento_id'] = $equip->id;

			//Fim da inclusão de equipamentos


			$osi = $this->ordem_internas->create($input);

			return Redirect::route('osi.osi.edit', $osi->id );
		}
		else{
			echo "Erro na inclusão dos dados!";
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$ordem_interna = $this->ordem_internas->find($id);

		return View::make('ordem_interna.show', compact('ordem_interna'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$ordem_interna = $this->ordem_internas->find($id);

		return View::make('ordem_interna.edit', compact('ordem_interna'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();

		$validator = Validator::make($input, $this->rules);

		if($validator->passes()){

			//Inclusão na tabela equipamentos se não existir
			
				$equipamento = Equipamento::where('descricao', '=', $input['equipamento_id'])->get();

					if(!$equipamento->count()){
						$equip = new Equipamento();
						
						$equip->descricao = $input['equipamento_id'];
						$equip->setor_id = $input['setor_requisitante_id'];
						$equip->save();
					}
					else{
						$equip = Equipamento::where('descricao', '=', $input['equipamento_id'])->first();
					}
				$input['equipamento_id'] = $equip->id;

			//Fim da inclusão de equipamentos


			$ordem_interna = $this->ordem_internas->find($id);

			$ordem_interna->update($input);

			return Redirect::route('osi.osi.edit', $ordem_interna->id);
		}
		else{
			echo "Erro na Alteração dos dados!";
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
