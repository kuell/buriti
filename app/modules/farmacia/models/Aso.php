<?php

class Aso extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia_asos';

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}
	public function postoTrabalho() {
		return $this->belongsTo('SetorPosto', 'posto_id');
	}

	public function getDataAttribute() {
		return implode('/', array_reverse(explode('-', $this->attributes['data'])));
	}

	public function getCodigoInternoAttribute() {
		return $this->colaborador->codigo_interno;
	}
	public function getNomeAttribute() {
		return $this->colaborador->nome;
	}

	public function getDataNascimentoAttribute() {
		return $this->colaborador->data_nascimento;
	}

	public function getSexoAttribute() {
		if ($this->colaborador->sexo) {
			return 1;
		} else {
			return 0;
		}

	}

	public function getSetorIdAttribute() {
		return $this->colaborador->setor_id;
	}

}