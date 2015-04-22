<?php

class SetorFuncao extends Eloquent {
	protected $guarded  = [];
	protected $fillable = [];

	public function setor() {
		return $this->hasMany('Setor', 'setor_id');
	}

}