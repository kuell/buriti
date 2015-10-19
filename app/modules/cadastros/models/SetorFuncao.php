<?php

class SetorFuncao extends Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'setor_funcaos';

	public function setor() {
		return $this->hasMany('Setor', 'setor_id');
	}

}