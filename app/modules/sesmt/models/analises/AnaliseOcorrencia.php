<?php

class AnaliseOcorrencia extends Ocorrencia {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencias';

	public static function tiposOcorrencia($excluir = []) {
		return TipoOcorrencia::where('pai_id', '0')->whereNotIn('descricao', $excluir)->lists('descricao', 'id');

	}

	public function tipo() {
		return $this->belongsTo('TipoOcorrencia', 'tipo_id', 'id');
	}

	public function investigacao() {
		return $this->hasOne('Investigacao', 'ocorrencia_id');
	}

	public function getTipoOcorrenciaAttribute() {
		return $this->tipo->descricao;
	}

}