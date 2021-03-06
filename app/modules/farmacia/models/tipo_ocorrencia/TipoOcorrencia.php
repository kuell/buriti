<?php

class TipoOcorrencia extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = "farmacia.ocorrencia_tipos";
	public $rules       =
	['descricao' => 'required|unique:farmacia.ocorrencia_tipos,descricao'];

	public function scopeTipoAcidente($query) {
		return $query->where('pai_id', 1);
	}

	public function pai() {
		return $this->belongsTo('TipoOcorrencia');
	}

	public function getAgrupamentoAttribute() {
		if (empty($this->pai->descricao)) {
			return 'Nenhum';
		} else {
			return $this->pai->descricao;
		}
	}
}