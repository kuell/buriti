<?php

class InvestigacaoParteCorpo extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'sesmt.investigacao_partes_corpo';

	public static function boot() {
		parent::boot();

		static ::creating(function ($parte) {
				$parte->user_created = Auth::user()->user;
			});

	}

	public function investigacao() {
		return $this->belongsTo('Investigacao', 'investigacao_id');
	}

	public function parteCorpo() {
		return $this->belongsTo('ParteCorpo', 'parte_corpo_id');
	}
}