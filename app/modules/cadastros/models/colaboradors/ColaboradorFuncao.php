<?php

class ColaboradorFuncao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];

	public function setorFuncao() {
		return $this->belongsTo('SetorFuncao');
	}

	public function funcao() {
		return $this->belongsTo('SetorFuncao', 'funcao_id');
	}

}