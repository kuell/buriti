<?php

class ColaboradorPosto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'colaborador_posto';

	public function posto() {
		return $this->belongsTo('SetorPosto', 'posto_id');

	}

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

}