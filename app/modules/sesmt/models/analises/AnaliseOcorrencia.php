<?php

class AnaliseOcorrencia extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencias';

	public static function tiposOcorrencia() {
		return ['Doença Ocupacional', 'Incidente', 'Típico', 'Átipico', 'Trajeto', 'Fatal'];
	}
}