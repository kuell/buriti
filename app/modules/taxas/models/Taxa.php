<?php

class Taxa extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'taxa.taxas';

	public $rules = [
		'data' => 'required'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($taxa) {
				$taxa->user_created = Auth::user()->user;
				$taxa->user_updated = Auth::user()->user;
			});

		static ::updating(function ($taxa) {
				$taxa->user_updated = Auth::user()->user;
			});
	}

	public function scopePeriodo($query) {
		$periodo = Format::dbPeriodo(Input::get('periodo', date('d/m/Y').' - '.date('d/m/Y')));

		return $query->whereBetween('data', $periodo);
	}

	public function scopeCorretor($query) {
		return $query->where('corretor_id', Input::get('corretor_id'));
	}

	public function corretor() {
		return $this->belongsTo('Corretor');
	}

	public function getCorretorDescricaoAttribute() {
		return $this->corretor->codigo_interno.' - '.$this->corretor->nome;
	}

	public function itens() {
		return $this->hasMany('TaxaItem');
	}

}