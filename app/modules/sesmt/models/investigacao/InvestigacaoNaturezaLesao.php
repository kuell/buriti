<?php

class InvestigacaoNaturezaLesao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'sesmt.investigacao_natureza_lesaos';

	public static function boot() {
		parent::boot();

		static ::creating(function ($natureza) {
				$natureza->user_created = Auth::user()->user;
			});

	}

	public function investigacao() {
		return $this->belongsTo('investigacao');
	}

	public function natureza() {
		return $this->belongsTo('NaturezaLesao', 'natureza_lesao_id');
	}
}