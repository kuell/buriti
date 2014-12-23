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

}
