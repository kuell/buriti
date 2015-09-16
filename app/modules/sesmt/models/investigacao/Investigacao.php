<?php

class Investigacao extends Eloquent {
	protected $guarded   = [];
	protected $filllabel = [];
	protected $table     = 'sesmt.investigacaos';

	public function ocorrencia() {
		return $this->belongsTo('Ocorrencia');
	}

	public function colaborador(){
		return $this->ocorrencia->colaborador();
	}

	public function epis() {
		return $this->hasMany('InvesticacaoEpi', 'investigacao_id');
	}

	public function informacao() {
		return $this->hasMany('InvestigacaoElementoInformacao', 'investigacao_id');
	}

	public function tiposOcorrencia(){
		return ['Acidente', 'Doença Ocupacional', 'Doença do Trabalho', 'Incidente', 'Tipico', 'Trajeto', 'Atipico', 'Fatal'];
	}

	public function classificacaoAcidente(){
		return ['ASA', 'ACA', 'R.I.'];
	}

	public function getDataHoraOcorrenciaAttribute(){
		return Format::viewDateTime($this->ocorrencia->created_at);
	}

	
}