<?php

class FarmaciaController extends \BaseController {

	public function index()
	{
		$menus = BaseController::getMenu(3);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}

	public function getPCMSOview(){
		return View::make('farmacia::relatorios.pcmso');
	}
	public function viewPCMSO($ano){
		$colaboradors = Colaborador::all();

		$return = '';

		foreach ($colaboradors as $colaborador) {

			$qtdOcorrencias = $colaborador->ocorrencias()->where('monitoramento', false)->count();

			if(!empty($colaborador->setor->descricao) && !empty($colaborador->posto_descricao->descricao) && $qtdOcorrencias > 0){
				$setor = $colaborador->setor;
				$posto = $colaborador->posto_descricao;

				if(empty($return[$setor->descricao])){
					if(empty($return[$setor->descricao][$posto->descricao])){
						$return[$setor->descricao][$posto->descricao] = $qtdOcorrencias;
					}
				}
				else{
					if(empty($return[$setor->descricao][$posto->descricao])){
						$return[$setor->descricao][$posto->descricao] = $qtdOcorrencias;
					}
					else{
						$return[$setor->descricao][$posto->descricao] = $return[$setor->descricao][$posto->descricao] + $qtdOcorrencias;
					}
				}
			}
		}

		return View::make('farmacia::relatorios.views.pcmso')->with('ocorrencias', $return);
	}
}