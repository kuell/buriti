<?php

class Colaborador extends Eloquent {

	protected $guarded = array();

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

	public function atestados($datai = null, $dataf = null) {
		$return = $this->hasMany('Atestado', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('inicio_afastamento', [$datai, $dataf])->get();
		}

	}

	public function ocorrencias($datai = null, $dataf = null) {
		$return = $this->hasMany('Ocorrencia', 'colaborador_id');

		if (empty($datai) or empty($dataf)) {
			return $return;
		} else {
			return $return->whereBetween('data_hora', [$datai, $dataf])->get();
		}

	}

	public function postoTrabalho() {
		return $this->belongsTo('ColaboradorPosto', 'colaborador_id');

	}

	public function getDataAdmissaoAttribute() {
		if ($this->attributes['data_admissao']) {
			$d = explode('-', $this->attributes['data_admissao']);
			return $d[2].'/'.$d[1].'/'.$d[0];
		} else {
			return null;
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

		return SetorFuncao::find($funcao['funcao_id'])['descricao'];
	}

}