<?php

class Investigacao extends Ocorrencia {
	protected $guarded   = [];
	protected $filllabel = [];
	protected $table     = 'sesmt.investigacaos';
	public $rules        = [
		'tipo_ocorrencia'   => 'required',
		'classificacao'     => 'required',
		'potencial_risco'   => 'required',
		'probabilidade'     => 'required',
		'data_acidente'     => 'required',
		'horas_trabalhadas' => 'required',
		'local_acidente'    => 'required',
		'tipo_lesao'        => 'required',
		'dias_afastamento'  => 'required',
		'fator_potencial'   => 'required'
	];

	public function scopeAbertas($query) {
		return $query->where('situacao', '<>', 'fechado');
	}

	public function ocorrencia() {
		return $this->belongsTo('Ocorrencia');
	}

	public function colaborador() {
		return $this->ocorrencia->colaborador();
	}

	public function tipoAcidente() {
		return $this->belongsTo('TipoOcorrencia', 'tipo_ocorrhencia');
	}

	public function naturezaLesaos() {
		return $this->hasMany('InvestigacaoNaturezaLesao', 'investigacao_id');
	}

	public function partesCorpo() {
		return $this->hasMany('InvestigacaoParteCorpo', 'investigacao_id');
	}

	public function tiposOcorrencia() {
		return ['Acidente', 'Doença Ocupacional', 'Doença do Trabalho', 'Incidente', 'Tipico', 'Trajeto', 'Atipico', 'Fatal'];
	}

	public function classificacaoAcidente() {
		return ['ASA', 'ACA', 'R.I.'];
	}

	public function getDataHoraOcorrenciaAttribute() {
		return Format::viewDateTime($this->ocorrencia->created_at);
	}

	public function getDataAcidenteAttribute() {
		return Format::viewDate($this->attributes['data_acidente']);
	}

	public function getTipoOcorrenciaDescricaoAttribute() {
		if ($this->tipoAcidente()->count() != 0) {
			return $this->tipoAcidente->descricao;
		} else {
			return 'Não Informado';
		}
	}

	public function getComAfastamentoAttribute() {
		if ($this->attributes['houve_afastamento']) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}

	public function setLocalAssistenciaMedicaAttribute($local = null) {
		if (empty($local)) {
			return $this->attributes['local_assistencia_medica'] = "NENHUM";
		} else {
			return $this->attributes['local_assistencia_medica'] = $local;
		}
	}

	public function setDescricaoAcidenteAttribute($descricao) {
		if (empty($descricao)) {
			return $this->attributes['descricao_acidente'] = "NENHUM";
		} else {
			return $this->attributes['descricao_acidente'] = $descricao;
		}
	}

	public function setTestemunhasAttribute($testemunhas) {
		if (empty($testemunhas)) {
			return $this->attributes['testemunhas'] = "NENHUM";
		} else {
			return $this->attributes['testemunhas'] = $testemunhas;
		}
	}

	public function setCidAttribute($cid) {
		if (empty($cid)) {
			return $this->attributes['cid'] = "0";
		} else {
			return $this->attributes['cid'] = $cid;
		}

	}

	public function setQtdeDiasAttribute($qtde_dias) {
		if (empty($qtde_dias)) {
			return $this->attributes['qtde_dias'] = 0;
		} else {
			return $this->attributes['qtde_dias'] = $qtde_dias;
		}

	}

	public function setHorarioAtendimentoAttribute($horario) {
		if (empty($horario)) {
			return $this->attributes['horario_atendimento'] = "00:00";
		} else {
			return $this->attributes['horario_atendimento'] = $horario;
		}
	}

}