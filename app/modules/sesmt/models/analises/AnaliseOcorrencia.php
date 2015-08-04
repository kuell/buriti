<?php

class AnaliseOcorrencia extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencias';

	public static function tiposOcorrencia() {
		return ['Doença Ocupacional', 'Incidente', 'Típico', 'Átipico', 'Trajeto', 'Fatal', 'Doença do Trabalho', 'Acidente', 'Queixas Gerais'];
	}

	public function investigacao() {
		return $this->hasOne('Investigacao', 'ocorrencia_id');
	}

}