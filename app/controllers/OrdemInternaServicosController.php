<?php

class OrdemInternaServicosController extends \BaseController {

	private $rules = [];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
				$prazo = $input['prazo'];
				unset($input['prazo']);

			$servico = New OrdemInternaServico();
			$serv = $servico->create($input);

			if(!empty($prazo)){
				$p = new OrdemInternaPrazo();
					$p->servico_id = $serv->id;
					$p->prazo = $prazo;
					$p->justificativa = "Primeiro Prazo";
				$p->save();
			}

			return Redirect::route('osi.osi.servicos.show', $input['ordem_interna_id']);
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
		$ordem_interna = OrdemInterna::find($id);

		return View::make('ordem_interna.servicos.servico', compact('ordem_interna'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$servico = OrdemInternaServico::find($id);

		return View::make('ordem_interna.servicos.prazo', compact('servico'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$input['servico_id'] = $id;

		$validator = Validator::make($input, $this->rules);

		if($validator->passes()){
			$prazo = new OrdemInternaPrazo();
				$prazo->create($input);
			return Redirect::route('osi.osi.servicos.edit', $id);
		}

		//print_r($id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$servico = OrdemInternaServico::find($id);
		$prazos = OrdemInternaPrazo::where('servico_id', $id)->delete();
		$osi = $servico->ordem_interna_id;

		$servico->delete();

		return Redirect::route('osi.osi.servicos.show', $osi);
	}


}
