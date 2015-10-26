<?php

class TaxaItem extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'taxa.taxa_itens';

	public $rules = [
		'item_id' => 'required',
		'qtd'     => 'required',
		'peso'    => 'required',
		'tipo'    => 'required'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($item) {
				$item->user_created = Auth::user()->user;
				$item->user_updated = Auth::user()->user;
			});

		static ::updating(function ($taxa) {
				$item->user_updated = Auth::user()->user;
			});
	}

	public function item() {
		return $this->belongsTo('Item');
	}
	public function taxa() {
		return $this->belongsTo('Taxa');
	}

	public function getDescricaoAttribute() {
		return $this->item->descricao;
	}

	public function getTipoDescricaoAttribute() {
		switch ($this->attributes['tipo']) {
			case 0:
				return 'INFORMATIVO';
				break;
			case 1:
				return 'A PAGAR';
				break;
			case 2:
				return 'A RECEBER';
				break;
		}
	}

	public function setQtdAttribute($qtd) {
		return $this->attributes['qtd'] = Format::valorDb($qtd);
	}
	public function setPesoAttribute($peso) {
		return $this->attributes['peso'] = Format::valorDb($peso);
	}
	public function setValorAttribute($valor) {
		return $this->attributes['valor'] = Format::valorDb($valor);
	}
}