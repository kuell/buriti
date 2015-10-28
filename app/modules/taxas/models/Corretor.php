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

	public function getTaxas() {

		$periodo = explode(' - ', Input::get('periodo', date('d/m/Y').' - '.date('d/m/Y')));

		if (!empty(Input::get('corretor_id'))) {
			$sql = "select
					c.descricao as item,
					c.grupo,
					b.tipo,
					sum(qtd) as qtd,
					sum(peso) as peso,
					sum(valor) as valor

				from
					taxa.taxas a
					inner join taxa.taxa_itens b on a.id = b.taxa_id
					inner join taxa.itens c on b.item_id = c.id
				where
					a.corretor_id = ? and
					a.data between ? and ?
				group by
					c.id, b.tipo";
			$result = DB::select($sql, [Input::get('corretor_id'), $periodo[0], $periodo[1]]);
		} else {
			$sql = "select
					c.descricao as item,
					c.grupo,
					b.tipo,
					sum(qtd) as qtd,
					sum(peso) as peso,
					sum(valor) as valor

				from
					taxa.taxas a
					inner join taxa.taxa_itens b on a.id = b.taxa_id
					inner join taxa.itens c on b.item_id = c.id
				where
					a.data between ? and ?
				group by
					c.id, b.tipo";
			$result = DB::select($sql, $periodo);
		}

		$return = [];

		foreach ($result as $taxa) {
			if (empty($return[$taxa->grupo][$taxa->item][$taxa->tipo])) {
				$return[$taxa->grupo][$taxa->item][$taxa->tipo] = [
					'qtd'   => $taxa->qtd,
					'peso'  => $taxa->peso,
					'valor' => $taxa->valor

				];
			}
		}

		return $return;

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