<?php

class Corretor extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'taxa.corretors';

	public $rules = [
		'nome'           => 'required|unique:taxa.corretors,nome',
		'codigo_interno' => 'required|unique:taxa.v_corretors_ativos,codigo_interno'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($corretor) {
				$corretor->user_created = Auth::user()->user;
				$corretor->user_updated = Auth::user()->user;
			});

		static ::updating(function ($corretor) {
				$corretor->user_updated = Auth::user()->user;
			});
	}

	public function scopeAtivos($query) {
		return $query->where('situacao', 0);
	}

	public function taxas() {
		return $this->hasMany('Taxa');
	}

	public function getSituacaoAttribute() {
		if ($this->attributes['situacao'] == 0) {
			return 'Ativo';
		} else {
			return 'Inativo';
		}
	}

	public function getCodigoInternoAttribute() {
		return 'COR '.$this->attributes['codigo_interno'];
	}

}