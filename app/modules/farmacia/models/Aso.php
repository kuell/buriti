<?php

class Aso extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $prefix   = 'asd';
	protected $table    = 'farmacia_asos';

	public $rules = [
		'admissional'                   => [
			'create'                       => [
				'colaborador_nome'            => 'required',
				'colaborador_sexo'            => 'required',
				'colaborador_data_nascimento' => 'required',
				'colaborador_setor_id'        => 'required',
				'medico'                      => 'required'],

			'update'                       => [
				'colaborador_nome'            => 'required',
				'colaborador_sexo'            => 'required',
				'colaborador_data_nascimento' => 'required',
				'colaborador_setor_id'        => 'required',
				'colaborador_matricula'       => 'required|unique:colaboradors,codigo_interno',
			]
		],
		'periodico'       => [
			'medico'         => 'required',
			'colaborador_id' => 'required'
		]
	];

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}
	public function postoTrabalho() {
		return $this->belongsTo('SetorPosto', 'posto_id');
	}
	public function exames() {
		return $this->hasMany('Exame', 'relacao_id');
	}

	public function getDataAttribute() {
		return date('d/m/Y H:i', strtotime($this->attributes['created_at']));
	}

	public function getNomeAttribute() {
		return $this->colaborador->nome;
	}

	public function getColaboradorDataNascimentoAttribute() {
		return implode('/', array_reverse(explode('-', $this->attributes['colaborador_data_nascimento'])));
	}

	public function getSexoAttribute() {
		if ($this->colaborador->sexo) {
			return 1;
		} else {
			return 0;
		}

	}

	public function getMatriculaAttribute() {
		if (empty($this->attributes['colaborador_id'])) {
			return "________";
		} else {
			return $this->colaborador->codigo_interno;
		}

	}

	public function getDataAdmissaoAttribute() {
		if (empty($this->attributes['colaborador_id'])) {
			return "____/____/________";
		} else {
			return $this->colaborador->data_admissao;
		}
	}
	public function getSetorAttribute() {
		if (empty($this->attributes['colaborador_id'])) {
			return Setor::find($this->attributes['colaborador_setor_id'])->descricao;
		} else {
			return $this->colaborador->setor->descricao;
		}
	}

}