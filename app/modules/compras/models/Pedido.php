<?php

class Pedido extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'compras.pedidos';

	public $rules = [
		'setor_id' => 'required'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($pedido) {
				$pedido->user_created = Auth::user()->user;
				$pedido->user_updated = Auth::user()->user;
				$pedido->situacao = 'ativo';
			});

		static ::updating(function ($pedido) {
				$pedido->user_updated = Auth::user()->user;
			});
	}

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

	public function produtos() {
		return $this->hasMany('PedidoProduto', 'pedido_id');
	}

	public function setOsiIdAttribute($osi) {
		if (empty($osi)) {
			return $this->attributes['osi_id'] = 0;
		} else {
			return $this->attributes['osi_id'] = $osi;
		}
	}
}