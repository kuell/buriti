<?php

class PlanoAcao extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'sesmt.plano_acaos';

	public static function boot() {
		parent::boot();

		static ::creating(function ($plano) {
				$plano->usuario_created = Auth::user()->user;
				$plano->usuario_updated = Auth::user()->user;
				$plano->situacao = 'Em Aberto';
			});

		static ::updating(function ($plano) {
				$plano->usuario_updated = Auth::user()->user;
			});
		static ::deleted(function ($plano) {
				$plano->filhos()->delete();
			});

	}

	public function pai() {
		return $this->belongsTo('PlanoAcao', 'pai_id');
	}

	public function filhos() {
		return $this->hasMany('PlanoAcao', 'pai_id');
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