<?php

class Aso extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $prefix   = 'asd';
	protected $table    = 'farmacia.asos';

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
				'colaborador_data_admissao'   => 'required',
				'status'                      => 'required'
			]
		],
		'periodico' => [

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

	public function funcao() {
		return $this->belongsTo('SetorFuncao', 'colaborador_funcao_id');
	}

	public function getFuncaoDescricaoAttribute() {
		if (!empty($this->funcao->id)) {
			return $this->funcao->descricao;
		} else {
			return null;
		}
	}

	public function getDataAttribute() {
		return date('d/m/Y H:i', strtotime($this->attributes['created_at']));
	}

	public function getNomeAttribute() {
		return $this->colaborador->nome;
	}

	public function getColaboradorDataNascimentoAttribute() {
		if (!empty($this->attributes['colaborador_data_nascimento'])) {
			return implode('/', array_reverse(explode('-', $this->attributes['colaborador_data_nascimento'])));
		}
	}

	public function getColaboradorSexoAttribute() {
		if (!empty($this->attributes['colaborador_id'])) {
			$sexo = $this->colaborador->sexo;
		} else {
			if (!empty($this->attributes['colaborador_sexo'])) {
				$sexo = $this->attributes['colaborador_sexo'];
			} else {
				$sexo = true;
			}

		}

		if ($sexo) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getColaboradorSexoDescricaoAttribute() {
		if (!empty($this->attributes['colaborador_id'])) {
			$sexo = $this->colaborador->sexo;
		} else {
			$sexo = $this->colaborador_sexo;
		}

		if ($sexo) {
			return 'MASCULINO';
		} else {
			return 'FEMININO';
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

	public function getColaboradorDataAdmissaoAttribute() {
		if (empty($this->attributes['colaborador_id'])) {
			return implode('/', array_reverse(explode('-', $this->attributes['colaborador_data_admissao'])));
		} else {
			return $this->colaborador->data_admissao;
		}
	}

	public function getMedicoAttribute() {
		if (empty($this->attributes['medico'])) {
			return "DR PEDRO LUIZ GOMES";
		} else {
			return $this->attributes['medico'];
		}

	}

	public function setColaboradorNomeAttribute($nome) {
		return $this->attributes['colaborador_nome'] = strtoupper(utf8_decode($nome));
	}

	public function getColaboradorIdadeAttribute() {

		return date('Y-m-d')-$this->attributes['colaborador_data_nascimento'];

	}

}