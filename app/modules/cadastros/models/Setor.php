<?php

class Setor extends Eloquent {
	protected $guarded = array();

	public function internos() {
		return $this->hasMany('Interno', 'setor_id');
	}

	public function getSituacaoAttribute() {
		if ($this->attributes['situacao']) {
			return 1;
		} else {
			return 0;
		}
	}

	public function colaboradores() {
		return $this->hasMany('Colaborador', 'setor_id');

	}

	public function funcaos() {
		return $this->hasMany('SetorFuncao', 'setor_id');
	}

	public function postoTrabalhos() {
		return $this->hasMany('SetorPosto', 'setor_id');
	}

	public static function agrupamentos() {
		$agrupamentos = ['Administração', 'Produção', 'Manutenção', 'Controle de Qualidade', 'Saúde e Segurança', 'S.I.F.', 'Aux. de Produção', 'Transporte'];

		return $agrupamentos;
	}

	public function getAgrupamntoAttribute($agrupamento) {
		$agrupamentos = ['Administração', 'Produção', 'Manutenção', 'Controle de Qualidade', 'Saúde e Segurança', 'S.I.F.', 'Aux. de Produção', 'Transporte'];

		return $this->attributes['agrupamento'] = $agrupamentos[$agrupamento];
	}

}
