<?php

class ColaboradorSetor extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'colaborador_setors';

	public function aso() {
		return $this->belongsTo('Aso');
	}

	public function colaborador() {
		return $this->belongsTo('Colaborador');
	}

	public function setor() {
		return $this->belongsTo('Setor');
	}
}