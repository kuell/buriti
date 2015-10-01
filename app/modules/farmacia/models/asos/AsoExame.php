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

	public function getDataValidadeAttribute() {
		if (!empty($this->attributes['validade'])) {
			return date('d/m/Y', strtotime("+".$this->attributes['validade']." month", strtotime($this->attributes['data'])));
		}
	}

}