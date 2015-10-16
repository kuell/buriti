<?php

class Aso extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $prefix   = 'asd';
	protected $table    = 'farmacia.asos';

	public $rules = [
		'outros'          => [
			'colaborador_id' => 'required',
			'medico'         => 'required'
		],
		'mudanca de funcao'       => [
			'create'                 => [
				'colaborador_id'        => 'required',
				'colaborador_funcao_id' => 'required',
				'colaborador_setor_id'  => 'required',
				'posto_id'              => 'required',
				'medico'                => 'required'
			],
			'update'                 => [
				'colaborador_funcao_id' => 'required',
				'colaborador_setor_id'  => 'required',
				'posto_id'              => 'required',
				'medico'                => 'required'
			],

		],
		'admissional'       => [
			'colaborador_nome' => 'required'
		]
	];

	public static function tipo($delete = null) {
		$tipos = ['admissional' => 'Admissional', 'periodico' => 'Periodico', 'demissional' => 'Demissional', 'mudanca de funcao' => 'Mudança de Função', 'retorno ao trabalho' => 'Retorno ao Trabalho'];

		if (!empty($delete)) {
			unset($tipos[$delete]);
		}

		return $tipos;
	}

	public function scopeAjustes($query) {
		return $query->where('ajuste', true);
	}

	public function scopeAbertos($query) {
		return $query->whereNotIn('situacao', ['fechado', 'deletada']);
	}

	public function newColaborador() {

		$colaborador                  = new Colaborador();
		$colaborador->nome            = $this->attributes['colaborador_nome'];
		$colaborador->sexo            = $this->attributes['colaborador_sexo'];
		$colaborador->data_nascimento = $this->getColaboradorDataNascimentoAttribute();
		$colaborador->data_admissao   = $this->getColaboradorDataAdmissaoAttribute();
		$colaborador->setor_id        = $this->attributes['colaborador_setor_id'];
		$colaborador->endereco        = $this->getEnderecoAttribute();
		$colaborador->codigo_interno  = $this->getColaboradorMatriculaAttribute();
		$colaborador->situacao        = 'ativo';
		$colaborador->rg              = $this->attributes['colaborador_rg'];
		$colaborador->emissor         = $this->attributes['colaborador_orgao_emissor'];
		$colaborador->posto_id        = $this->attributes['posto_id'];

		return $colaborador;

	}

	public function ficha() {
		return $this->belongsTo('Ficha', 'ficha_id');
	}

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

	public function getSetor() {
		return $this->belongsTo('Setor', 'colaborador_setor_id');
	}

	public function postoTrabalho() {
		return $this->belongsTo('SetorPosto', 'posto_id');
	}
	public function exames() {
		return $this->hasMany('AsoExame', 'relacao_id');
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

	public function getColaboradorFuncaoIdAttribute() {
		if (!empty($this->colaborador)) {
			return $this->colaborador->funcao_id;
		} else {
			return $this->attributes['colaborador_funcao_id'];
		}
	}

	public function getPostoIdAttribute() {
		if (!empty($this->colaborador)) {
			return $this->colaborador->posto_id;
		} else {
			return $this->attributes['posto_id'];
		}
	}

	public function getDataAttribute() {
		if (empty($this->attributes['data'])) {
			return date('d/m/Y H:i', strtotime($this->attributes['created_at']));
		} else {
			return $this->attributes['data'];
		}

	}

	public function getColaboradorNomeAttribute() {
		if (!empty($this->attributes['colaborador_id'])) {
			return $this->colaborador->nome;
		} else {
			return $this->attributes['colaborador_nome'];
		}

	}

	public function getEnderecoAttribute() {
		if (empty($this->ficha)) {
			return null;
		} else {
			return $this->ficha->endereco;
		}

	}

	public function getColaboradorDataNascimentoAttribute() {
		if (empty($this->colaborador)) {
			return implode('/', array_reverse(explode('-', $this->attributes['colaborador_data_nascimento'])));
		} else {
			return $this->colaborador->data_nascimento;
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
			$sexo = $this->attributes['colaborador_sexo'];
		}

		if ($sexo != false) {
			return 'MASCULINO';
		} else {
			return 'FEMININO';
		}

	}

	public function getColaboradorMatriculaAttribute() {
		if (empty($this->attributes['colaborador_id'])) {
			return empty($this->attributes['colaborador_matricula'])?null:$this->attributes['colaborador_matricula'];
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

		if (!empty($this->attributes['colaborador_id'])) {
			return date('Y-m-d')-Format::dbDate($this->colaborador->data_nascimento);
		} else {
			if (!empty($this->attributes['colaborador_data_nascimento'])) {
				return date('Y-m-d')-$this->attributes['colaborador_data_nascimento'];
			} else {
				return null;
			}
		}

	}

}