<?php

class Queixa extends \Eloquent {
	protected $guarded = [];
	protected $table   = 'farmacia.ocorrencia_queixas';

	public function scopeListaPcmso($query) {
		return $query->where('pcmso', true);
	}

	public function ocorrencias() {
		return $this->hasMany('Ocorrencia', 'queixa_id');
	}

	public function getPcmsoAttribute() {
		if ($this->attributes['pcmso']) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}

}