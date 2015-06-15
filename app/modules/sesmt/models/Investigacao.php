<?php

class Investigacao extends Eloquent {
	protected $guarded   = [];
	protected $filllabel = [];
	protected $table     = 'sesmt_investigacaos';

	public function ocorrencia() {
		return $this->hasOne('Ocorrencia', 'id');
	}

	public function epis() {
		return $this->hasMany('InvesticacaoEpi', 'investigacao_id');
	}

	public function informacao() {
		return $this->hasMany('InvestigacaoElementoInformacao', 'investigacao_id');
	}
}