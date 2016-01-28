<?php

class Item extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'taxa.itens';

	public $rules = [
		'descricao' => 'required|unique:taxa.itens,descricao'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($item) {
				$item->user_created = Auth::user()->user;
				$item->user_updated = Auth::user()->user;
			});

		static ::updating(function ($item) {
				$item->user_updated = Auth::user()->user;
			});
	}

	public function scropeAtivos($query) {
		return $query->where('situacao', 0);
	}

	public function getGrupoAttribute() {
		switch ($this->attributes['grupo']) {
			case 0:
				return 'TAXA';
				break;
			case 1:
				return 'ITEM';
				break;
			case 2:
				return 'ROMANEIO';
				break;
		}
	}

	public function getFiscalDescricaoAttribute() {
		if (!$this->attributes['fiscal']) {
			return "SIM";
		} else {
			return "NÃO";
		}
	}

	public function getGeneroDescricaoAttribute() {
		switch ($this->attributes['genero']) {
			case 0:
				return "FEMEA";
				break;
			case 1:
				return "MACHO";
				break;
			case 2:
				return "AMBOS";
				break;
		}
	}

	public function getSituacaoDescricaoAttribute() {
		if (!$this->attributes['situacao']) {
			return "ATIVO";
		} else {
			return "INATIVO";
		}
	}

}