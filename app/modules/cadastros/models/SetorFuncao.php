<?php

class SetorFuncao extends Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_trabalhos';

	public function setor() {
		return $this->hasMany('Setor', 'setor_id');
	}

}