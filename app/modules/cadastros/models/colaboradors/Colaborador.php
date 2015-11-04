<?php

class Colaborador extends Eloquent {

	protected $guarded = array();
	public $rules      = array(
		'nome'           => 'required|min:5|unique:v_colaboradors_ativos,nome',
		'codigo_interno' => 'required|unique:colaboradors,codigo_interno',
		'setor_id'       => 'required',
		'data_admissao'  => 'required',
	);

	public static function boot() {
		parent::boot();

		static ::updating(function ($colaborador) {

				$col = Colaborador::find($colaborador->id);
				$colaborador->user_updated = Auth::user()->user;

				if ($colaborador->posto_id != $col->posto_id) {
					$info = [
						'posto_id'     => $colaborador->posto_id,
						'user_created' => Auth::user()->user
					];

					$colaborador->postosTrabalho()->create($info);
				}
				if ($colaborador->funcao_id != $col->funcao_id) {
					$info = [
						'funcao_id'    => $colaborador->funcao_id,
						'data_mudanca' => date('Y-m-d'),
						'user_created' => Auth::user()->user
					];

					$colaborador->funcaos()->create($info);
				}
				if ($colaborador->setor_id != $col->setor_id) {
					$info = [
						'setor_id'     => $colaborador->setor_id,
						'aso_id'       => Input::get('id'),
						'posto_id'     => $colaborador->posto_id,
						'user_created' => Auth::user()->user
					];

					$colaborador->setors()->create($info);
				}
			});

		static ::creating(function ($colaborador) {
				$colaborador->user_created = Auth::user()->user;
			});
	}

	public function scopeAtivos($query) {
		return colaborador::whereRaw("(situacao = 'ativo' or situacao is null)")->orderBy('nome');
	}

	public function funcaos() {
		return $this->hasMany('ColaboradorFuncao', 'colaborador_id');
	}

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

	public function setors() {
		return $this->hasMany('ColaboradorSetor');
	}

	public function atestados($datai = null, $dataf = null) {
		$return = $this->hasMany('Atestado', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('inicio_afastamento', array($datai, $dataf))->get();
		}

	}

	public function monitoramentos($datai = null, $dataf = null) {
		$return = $this->hasMany('Ocorrencia', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('data_hora', array($datai, $dataf))->where('monitoramento', 'true')->orderBy('created_at')->get();
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
		return $this->belongsTo('SetorPosto', 'posto_id');
	}
	public function postosTrabalho() {
		return $this->hasMany('ColaboradorPosto');
	}

	public function funcao() {
		return $this->belongsTo('SetorFuncao', 'funcao_id');
	}

	public function getFuncaoDescricaoAttribute() {
		if ($this->funcao) {
			return $this->funcao->descricao;
		} else {
			return 'NENHUM INFORMADO';
		}
	}

	public function getPostoTrabalhoDescricaoAttribute() {
		if ($this->postoTrabalho) {
			return $this->postoTrabalho->descricao;
		} else {
			return 'NENHUM INFORMADO';
		}
	}

	public function getSetorDescricaoAttribute() {

		if (count($this->setor)) {
			return $this->setor->descricao;
		} else {
			return 'NENHUM INFORMADO';
		}

	}

	public function asos() {
		return $this->hasMany('Aso', 'colaborador_id');
	}

	public function getDataAdmissaoAttribute() {
		if ($this->attributes['data_admissao']) {
			return Format::viewDate($this->attributes['data_admissao']);
		} else {
			return '';
		}
	}

	public function getDataDemissaoAttribute() {
		if ($this->attributes['data_demissao']) {
			return Format::viewDate($this->attributes['data_demissao']);
		} else {
			return '';
		}
	}

	public function getDataNascimentoAttribute() {
		if ($this->attributes['data_nascimento']) {
			return Format::viewDate($this->attributes['data_nascimento']);
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

	public function getRemuneracaoAttribute() {
		return Format::valorView($this->attributes['remuneracao']);
	}

	public function setRemuneracaoAttribute($remuneracao) {
		return $this->attributes['remuneracao'] = Format::valorDB($remuneracao);
	}

}