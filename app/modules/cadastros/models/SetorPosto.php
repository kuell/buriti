<?php

class SetorPosto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_trabalhos';

	public function atividades() {
		return $this->hasMany('SetorPostoAtividade', 'posto_id');
	}

}