<?php

class Setor extends Eloquent {
	protected $guarded = array();

	public function scopeAtivos($query) {
		return $query->where('situacao', true);
	}

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

	public function getAgrupamentoAttribute() {
		$agrupamentos = [0=> 'Administração', 1=> 'Produção', 2=> 'Manutenção', 3=> 'Controle de Qualidade', 4=> 'Saúde e Segurança', 4=> 'S.I.F.', 5=> 'Aux. de Produção', 6=> 'Transporte'];

		if (!empty($agrupamentos[$this->attributes['agrupamento']])) {
			return $agrupamentos[$this->attributes['agrupamento']];
		}

	}

}
