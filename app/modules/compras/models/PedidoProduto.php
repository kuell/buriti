<?php

class PedidoProduto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'compras.pedido_produtos';

	public $rules = [
		'produto_id' => 'required',
		'qtd'        => 'required',
		'estoque'    => 'required'
	];

	public static function boot() {
		parent::boot();
		static ::creating(function ($produto) {
				$produto->user_created = Auth::user()->user;
				$produto->user_updated = Auth::user()->user;
				$produto->situacao = 'requisitado';
			});

		static ::updating(function ($produto) {
				if (Input::get('situacao') == 'comprado') {
					$produto->user_compra = Auth::user()->user;
					$produto->data_compra = date('Y-m-d');

				} else if (Input::get('situacao') == 'reprovado') {
					$produto->user_reprovacao = Auth::user()->user;
					$produto->data_reprovacao = date('Y-m-d');

				} else if (Input::get('situacao') == 'recebido') {
					$produto->user_recebimento = Auth::user()->user;
					$produto->data_recebimento = date('Y-m-d');

				} else if (Input::get('situacao') == 'devolvido') {
					$produto->user_devolucao = Auth::user()->user;
					$produto->data_devolucao = date('Y-m-d');

				}

				$produto->user_updated = Auth::user()->user;
			});
	}

	public function scopeRequisitados($query) {
		return $query->whereIn('situacao', ['requisitado', 'devolvido']);
	}

	public function pedido() {
		return $this->belongsTo('Pedido');
	}
	public function produto() {
		return $this->belongsTo('Produto');
	}

	public function getDescricaoAttribute() {
		return $this->produto->descricao;
	}
	public function getFotoAttribute() {
		return $this->produto->img;
	}
	public function getPrioridadeAttribute() {
		switch ($this->attributes['prioridade']) {
			case 0:
				return 'BAIXA';
				break;
			case 1:
				return 'MÉDIA';
				break;
			case 2:
				return 'ALTA';
				break;
		}
	}

	public function setQtdAttribute($qtd) {
		return $this->attributes['qtd'] = Format::valorDb($qtd);
	}
	public function setEstoqueAttribute($estoque) {
		return $this->attributes['estoque'] = Format::valorDb($estoque);
	}

}