<?php

class OcorrenciaMedicacao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencia_medicacaos';

	public $rules = [
		'medicacao_id' => 'required',
		'qtd'          => 'required',
		'medida'       => 'required'

	];

	public function medicacao() {
		return $this->belongsTo('Medicamento');
	}

	public function ocorrencias() {
		return $this->hasMany('Ocorrencia', 'ocorrencia_id');
	}
}