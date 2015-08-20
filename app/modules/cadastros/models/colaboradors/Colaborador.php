<?php

class Colaborador extends Eloquent {

	protected $guarded = array();
	public $rules      = array(
		'nome'           => 'required|min:5|unique:colaboradors,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		'setor_id'       => 'required',
	);

	public function scopeAtivos($query) {
		return colaborador::whereRaw("situacao = 'ativo' or situacao is null");
	}

	public function funcaos() {
		return $this->hasMany('ColaboradorFuncao', 'colaborador_id');
	}

	public function getFuncaoIdAttribute() {

		if ($this->funcaos->count() != 0) {
			return $this->funcaos->last()->funcao_id;
		} else {
			return null;
		}
	}

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

	public function asos() {
		return $this->hasMany('Aso', 'colaborador_id');
	}

	public function atestados($datai = null, $dataf = null) {
		$return = $this->hasMany('Atestado', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('inicio_afastamento', array($datai, $dataf))->get();
		}

	}

	public function ocorrencias($datai = null, $dataf = null) {
		$return = $this->hasMany('Ocorrencia', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('data_hora', array($datai, $dataf))->get();
		}

	}

	public function postoTrabalho() {
		return $this->hasMany('ColaboradorPosto', 'colaborador_id');

	}

	public function getMonitoramentoAttribute() {
		if (!empty($this->attributes['monitoramento']) && $this->attributes['monitoramento'] == true) {
			return 'Sim';
		} else {
			return 'Não';
		}

	}

	public function getPostoIdAttribute() {
		$posto = ColaboradorPosto::where('colaborador_id', $this->attributes['id'])->orderBy('id', 'desc')->first();
		if (empty($posto)) {
			return 0;
		} else {
			return $posto->posto_id;
		}

	}

	public function getPostoDescricaoAttribute() {
		$posto = new SetorPosto();

		if (!empty($this->getPostoIdAttribute())) {
			$posto = SetorPosto::find($this->getPostoIdAttribute());
		}

		return $posto;
	}

	public function getDataAdmissaoAttribute() {
		if ($this->attributes['data_admissao']) {
			$d = explode('-', $this->attributes['data_admissao']);
			return $d[2].'/'.$d[1].'/'.$d[0];
		} else {
			return '';
		}
	}

	public function getDataNascimentoAttribute() {
		if ($this->attributes['data_nascimento']) {
			$d = explode('-', $this->attributes['data_nascimento']);

			return $d[2].'/'.$d[1].'/'.$d[0];
		} else {
			return null;
		}

	}

	public function getSexoDescricaoAttribute() {
		if ($this->attributes['sexo']) {
			return "Masculino";
		} else {
			return 'Feminino';
		}
	}

	public function getSexoAttribute() {
		if ($this->attributes['sexo']) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getInternoAttribute() {
		if ($this->attributes['interno']) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}

	public function setDataNascimentoAttribute($data_nascimento) {

		if (empty($data_nascimento) or $data_nascimento == '__/__/____') {
			return '9999-99-99';
		} else {
			$d                                          = explode('/', $data_nascimento);
			return $this->attributes['data_nascimento'] = $d[2].'-'.$d[1].'-'.$d[0];
		}

	}

	public function setDataAdmissaoAttribute($data_admissao) {

		if (empty($data_admissao) or $data_admissao == '__/__/____') {
			return '9999-99-99';
		} else {
			$d                                        = explode('/', $data_admissao);
			return $this->attributes['data_admissao'] = $d[2].'-'.$d[1].'-'.$d[0];
		}
	}

	public function getFuncaoAttribute() {
		$funcao = ColaboradorFuncao::where('colaborador_id', $this->attributes['id'])->orderBy('created_at', 'desc')->first();

		if (count($funcao) == 0) {
			return 'NÃO INFORMADO';
		} else {
			return SetorFuncao::find($funcao['funcao_id'])['descricao'];
		}
	}

	public function getIdadeAttribute() {
		return date('Y-m-d')-$this->attributes['data_nascimento'];

	}

	public function getTempoEmpresaAttribute() {
		if (empty($this->attributes['data_admissao'])) {
			return '_____ anos';

		} else {
			return date('Y-m-d')-$this->attributes['data_admissao'].' anos';
		}
	}

	public function getSituacaoAttribute() {
		if (empty($this->attributes['situacao'])) {
			return 'Ativo';
		} else {
			return $this->attributes['situacao'];
		}

	}

}