<?php

class OcorrenciaMedicacao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia_ocorrencia_medicacaos';

	public function medicacao() {
		return $this->belongsTo('Medicamento');
	}

	public function ocorrencias() {
		return $this->hasMany('Ocorrencia', 'ocorrencia_id');
	}
}