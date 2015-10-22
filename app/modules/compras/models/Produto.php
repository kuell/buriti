<?php

class Produto extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = "compras.produtos";
	public $rules       = [
		'descricao' => 'required'
	];

	public static function boot() {
		parent::boot();

		static ::creating(function ($produto) {
				$produto->user_created = Auth::user()->user;
				$produto->user_updated = Auth::user()->user;
				$produto->situacao = 'ativo';
			});

		static ::updating(function ($produto) {
				$produto->user_updated = Auth::user()->user;
			});
	}

	public function scopeAtivos($query) {
		return $query->where('situacao', 'ativo');
	}

	public function setImgAttribute($img) {

		if (!empty($img)) {
			$file            = $img;
			$destinationPath = 'img/compras/produtos';
			$extension       = $file->getClientOriginalExtension();

			$filename = str_replace(' ', '_', $this->attributes['descricao'].'.'.$extension);
			$img->move($destinationPath, $filename);

			return $this->attributes['img'] = $destinationPath.'/'.$filename;
		}
	}

	public function getImgAttribute() {
		if (empty($this->attributes['img'])) {
			return 'img/no_image.jpg';
		} else {
			return $this->attributes['img'];
		}
	}

	public function pedidos() {
		return $this->hasMany('PedidoProduto');
	}

}