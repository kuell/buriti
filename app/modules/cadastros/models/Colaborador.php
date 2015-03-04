<?php

class Colaborador extends Eloquent {

	protected $guarded = array();

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

	public function atestados(){
		return $this->hasMany('Atestado', 'colaborador_id');
	}

	public function getDataAdmissaoAttribute(){
		if($this->attributes['data_admissao']){
			$d = explode('-', $this->attributes['data_admissao']);
			return  $d[2].'-'.$d[1].'-'.$d[0];
		}
		else{
			return false;
		}
	}

	public function setDataNascimentoAttribute($data_nascimento) {

		if(empty($data_nascimento) or $data_nascimento == '__/__/____'){
			return '9999-99-99';
		}
		else{
			print_r($data_nascimento);
			die;
			$d = explode('/', $data_nascimento);
			return $this->attributes['data_nascimento'] = $d[2].'-'.$d[1].'-'.$d[0];
		}

	}

	public function getDataNascimentoAttribute(){
		if($this->attributes['data_nascimento']){
			$d = explode('-', $this->attributes['data_nascimento']);

			return $d[2].'/'.$d[1].'/'.$d[0];
		}
		else{
			return false;
		}

	}

	public function getSexoDescricaoAttribute(){
		if($this->attributes['sexo']){
			return "Masculino";
		}
		else{
			return 'Feminino';
		}
	}

	public function getInternoAttribute() {
		if ($this->attributes['interno']) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}
}