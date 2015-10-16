<?php

class PlanoAcao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'sesmt.plano_acaos';

	public static function boot() {
		parent::boot();

		static ::creating(function ($natureza) {
				$natureza->usuario_created = Auth::user()->user;
				$natureza->usuario_updated = Auth::user()->user;
				$natureza->situacao = 'Em Aberto';
			});

		static ::updating(function ($natureza) {
				$natureza->usuario_updated = Auth::user()->user;
			});

	}

	public function ocorrencia() {
		return $this->belongsTo('Ocorrencia', 'ocorrencia_id');
	}

	public function getDataCriacaoAttribute() {
		return date('d/m/Y', strtotime($this->attributes['created_at']));
	}

	public function getDataFinalizacaoAttribute() {
		if ($this->attributes['situacao'] == 'Finalizado') {
			return date('d/m/Y', strtotime($this->attributes['updated_at']));
		} else {
			return ' - ';
		}

	}
}