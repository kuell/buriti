<?php

class InvestigacaoCat extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = "sesmt.investigacao_cats";

	public $rules = [
		'numero_cat' => 'required|unique:sesmt.investigacao_cats,numero_cat'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($cat) {
				$cat->user_created = Auth::user()->user;
				$cat->user_updated = Auth::user()->user;
			});

		static ::updating(function ($cat) {
				$cat->user_updated = Auth::user()->user;
			});
	}

	public function setRemuneracaoAttribute($remuneracao) {
		return $this->attributes['remuneracao'] = Format::valorDb($remuneracao);
	}

}