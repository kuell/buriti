<?php

class FichaSetor extends \Eloquent {
	protected $fillable = [];
	protected $table    = 'cadastros.ficha_setors';

	public function setor() {
		return $this->belongsTo('Setor');
	}
}