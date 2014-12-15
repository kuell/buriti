<?php

class Atestado extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia_atestados";

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

	public function getInicioAfastamentoAttribute() {
		$d = explode('-', $this->attributes['inicio_afastamento']);

		return $d[2].'/'.$d[1].'/'.$d[0];
	}

	public function getFimAfastamentoAttribute() {
		$d = explode('-', $this->attributes['fim_afastamento']);

		return $d[2].'/'.$d[1].'/'.$d[0];
	}
}