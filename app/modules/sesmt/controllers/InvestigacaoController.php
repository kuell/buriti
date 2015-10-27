<?php

class InvestigacaoController extends \BaseController {
	public $investigacaos;

	public function __construct(Investigacao $investigacao, Ocorrencia $ocorrencia) {
		$this->investigacaos = $investigacao;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$investigacaos = $this->investigacaos->abertas()->get();

		return View::make('sesmt::investigacao.index', compact('investigacaos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		$ocorrencia = Ocorrencia::find(Input::get('ocorrencia'));

		return View::make('sesmt::investigacao.create', compact('ocorrencia'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::all();

		$investigacao = Investigacao::where('ocorrencia_id', $input['ocorrencia_id'])->first();

		/*
		 * Verifica se ja começou a fazer a investigação
		 * 	Não -> Cria nova investigação
		 */
		if (!count($investigacao)) {
			$input['situacao'] = 'Em investigacao';
			$investigacao      = $this->investigacaos->create($input);
		}

		return Redirect::route('sesmt.investigacao.edit', $investigacao->id);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.show', compact('investigacao'));
		//$pdf = DPDF::loadView('sesmt::investigacao.show', compact('investigacao'));
		//$pdf->download();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.edit', compact('investigacao'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = new Investigacao(Input::all());

		$validate = Validator::make($input->toArray(), $this->investigacaos->rules);

		if ($validate->passes()) {
			$investigacao = $this->investigacaos->find($id);

			$investigacao->update($input->toArray());

			return Redirect::route('sesmt.investigacao.edit', $id);
		} else {
			return Redirect::route('sesmt.investigacao.edit', $id)
				->withInput()
				->withErrors($validate)
				->with('message', 'Erro na inclusão das informações!');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$investigacao = $this->investigacaos->find($id);

		$investigacao->delete();

	}

	public function getRedirecionar($id) {
		$ocorrencia = Ocorrencia::find($id);

		return View::make('sesmt::investigacao.redirecionar', compact('ocorrencia'));
	}

	public function setRedirecionar($id) {
		$input      = Input::all();
		$ocorrencia = Ocorrencia::find($id);

		if ($ocorrencia->update($input)) {
			$ocorrencia->investigacao->delete();
		}

		return Redirect::route('sesmt.investigacao.index');
	}

	public function getFinalizar($id) {
		$investigacao = $this->investigacaos->find($id);
		$ocorrencia   = $investigacao->ocorrencia;

		return View::make('sesmt::investigacao.finalizar', compact('investigacao'), compact('ocorrencia'));
	}

	public function postFinalizar($id) {
		$input = $this->investigacaos->find($id)->toArray();

		$validate = Validator::make($input, $this->investigacaos->rules);

		if ($validate->passes()) {
			$investigacao = $this->investigacaos->find($id);
			$investigacao->update(['situacao'               => 'fechado']);
			$investigacao->ocorrencia()->update(['situacao' => 'finalizada']);
			return 0;
		} else {
			return "Houve erro na finalização da ocorencia!\n\n".implode("\n", $validate->errors()->all());
		}

	}

	public function getPrint($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.print', compact('investigacao'));
	}

	public function getNaturezaLesao($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.natureza_lesao', compact('investigacao'));
	}

	public function setNaturezaLesao($id) {
		$input        = Input::all();
		$investigacao = $this->investigacaos->find($id);

		if (!$investigacao->naturezaLesaos()->where('natureza_lesao_id', $input['natureza_lesao_id'])->count()) {
			$investigacao->naturezaLesaos()->create($input);
		}

		return View::make('sesmt::investigacao.natureza_lesao', compact('investigacao'));
	}

	public function destroyNaturezaLesao($id) {
		$natureza     = InvestigacaoNaturezaLesao::find($id);
		$investigacao = $natureza->investigacao;

		$natureza->delete();

		return View::make('sesmt::investigacao.natureza_lesao', compact('investigacao'));
	}

	public function getParteCorpo($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.parte_corpo', compact('investigacao'));
	}

	public function setParteCorpo($id) {
		$input        = Input::all();
		$investigacao = $this->investigacaos->find($id);

		if (!$investigacao->partesCorpo()->where('parte_corpo_id', $input['parte_corpo_id'])->count()) {
			$investigacao->partesCorpo()->create($input);
		}

		return View::make('sesmt::investigacao.parte_corpo', compact('investigacao'));
	}

	public function destroyParteCorpo($id) {
		$parte_corpo  = InvestigacaoParteCorpo::find($id);
		$investigacao = $parte_corpo->investigacao;

		$parte_corpo->delete();

		return View::make('sesmt::investigacao.parte_corpo', compact('investigacao'));
	}

	public function getCat($id) {
		$investigacao = $this->investigacaos->find($id);

		return View::make('sesmt::investigacao.cat', compact('investigacao'));
	}
	public function setCat($id) {
		$input        = Input::all();
		$investigacao = $this->investigacaos->find($id);

		if (!$investigacao->ocorrencia->colaborador->grau_instrucao) {
			$investigacao->ocorrencia->colaborador->grau_instrucao = $input['grau_instrucao'];
		}
		if (!$investigacao->ocorrencia->colaborador->cbo) {
			$investigacao->ocorrencia->colaborador->cbo = $input['cbo'];
		}

		if ($investigacao->ocorrencia->colaborador->remuneracao == '0,00') {
			$investigacao->ocorrencia->colaborador->remuneracao = $input['remuneracao'];
		}
		$investigacao->ocorrencia->colaborador->save();

		if (!empty($input['cat'])) {
			unset($input['cat']);
			$input['remuneracao'] = Format::valorDb($input['remuneracao']);
			$investigacao->cat()->update(array_except($input, '_token'));
		} else {
			$cat      = new InvestigacaoCat();
			$validate = Validator::make($input, $cat->rules);

			if ($validate->passes()) {
				$investigacao->cat()->create($input);
				return Redirect::route('sesmt.investigacao.cat', $id);
			} else {
				return Redirect::route('sesmt.investigacao.cat', $id)
					->withInput()
					->withErrors($validate)
					->with('message', 'Erro na inclusão das informações!');
			}

		}

	}
}
