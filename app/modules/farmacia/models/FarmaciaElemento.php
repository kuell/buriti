<?php

class FarmaciaElemento extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia_elementos";

	public function elementos_filho() {
		return $this->hasMany('FarmaciaElemento', 'elemento_pai');
	}

	public function pai() {
		return $this->hasMany('FarmaciaElemento', 'id', 'elemento_pai');
	}

}