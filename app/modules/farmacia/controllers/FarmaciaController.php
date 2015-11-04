<?php

class FarmaciaController extends \BaseController {

	public function index() {
		$menus = BaseController::getMenu(3);
		Session::put('menus', $menus);
		return View::make('layouts.modulo', compact('menus'));
	}

	public function getRelatorios() {
		return View::make('farmacia::relatorios.form');
	}
	public function viewPCMSO($ano) {
		$colaboradors = Colaborador::all();

		$return = '';

		foreach ($colaboradors as $colaborador) {

			$qtdOcorrencias = $colaborador->ocorrencias()->where('monitoramento', false)->count();

			if (!empty($colaborador->setor->descricao) && !empty($colaborador->posto_descricao->descricao) && $qtdOcorrencias > 0) {
				$setor = $colaborador->setor;
				$posto = $colaborador->posto_descricao;

				if (empty($return[$setor->descricao])) {
					if (empty($return[$setor->descricao][$posto->descricao])) {
						$return[$setor->descricao][$posto->descricao] = $qtdOcorrencias;
					}
				} else {
					if (empty($return[$setor->descricao][$posto->descricao])) {
						$return[$setor->descricao][$posto->descricao] = $qtdOcorrencias;
					} else {
						$return[$setor->descricao][$posto->descricao] = $return[$setor->descricao][$posto->descricao]+$qtdOcorrencias;
					}
				}
			}
		}

		return View::make('farmacia::relatorios.views.pcmso')->with('ocorrencias', $return);
	}

	public function getExamesAnual($ano) {

		$rs = DB::select("	SELECT
								d.id,
								d.descricao as setor,
								c.descricao as posto,
								e.descricao as natureza_exame,
								(
								select
									count(*)
								from
									farmacia.aso_exames
									inner join farmacia.asos on farmacia.aso_exames.relacao_id = farmacia.asos.id
								WHERE
									farmacia.asos.colaborador_setor_id = d.id and
									farmacia.asos.posto_id = c.id and
									farmacia.aso_exames.id = e.id) as total,
								(
								select
									count(*)
								from
									farmacia.aso_exames
									inner join farmacia.asos on farmacia.aso_exames.relacao_id = farmacia.asos.id
								WHERE
									farmacia.asos.colaborador_setor_id = d.id and
									farmacia.asos.posto_id = c.id and
									farmacia.aso_exames.descricao = e.descricao and
									farmacia.aso_exames.resultado not in ('normal', 'NÃO REAGENTE', 'NORMAL', 'norm', 'NORMA')) as alterados

							FROM
								farmacia.asos a
								inner join farmacia.aso_exames b on a.id = b.relacao_id
								inner join posto_trabalhos c on a.posto_id = c.id
								inner join setors d on a.colaborador_setor_id = d.id
								inner join farmacia.exames e on b.exame_id = e.id
							WHERE
								extract(year from a.created_at) = ? and
								a.posto_id <> 0
							GROUP BY
								d.id, d.descricao, c.id, e.id
							ORDER BY
								total desc", [$ano]);

		$exames = null;

		foreach ($rs as $val) {
			$exames[$val->setor][$val->posto][$val->natureza_exame] = ['total' => $val->total, 'alterado' => $val->alterados];
		}

		return View::make('farmacia::relatorios.views.exames', compact('exames'));
	}

	public function getColaboradorExames() {
		$setors = Setor::all();

		return View::make('farmacia::relatorios.views.colaborador_exames', compact('setors'));
	}

	public function getOcorrenciaQueixa($ano) {
		$queixas = Queixa::listaPcmso();

		$pdf = DPDF::loadView('farmacia::relatorios.views.ocorrencias', compact('queixas'));

		//		$html = App::make('farmacia::relatorios.views.ocorrencias', compact('queixas'));
		//return View::make('farmacia::relatorios.views.ocorrencias', compact('queixas'));
		return $pdf->setOrientation('landscape')->stream();
	}
}