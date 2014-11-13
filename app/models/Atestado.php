<?php

class Atestado extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia_atestados";

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}
}