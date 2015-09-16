<?php

class AsoExame extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = "farmacia.aso_exames";

	public function exame() {
		return $this->belongsTo('Exame');
	}

	public function getDescricaoAttribute() {
		return $this->exame->descricao;
	}

}