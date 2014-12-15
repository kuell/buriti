<?php

class Colaborador extends Eloquent {

	protected $guarded = array();

	public function setDataNascimentoAttribute($data_nascimento) {
		$d = explode('/', $data_nascimento);

		return $this->attributes['data_nascimento'] = $d[2].'-'.$d[1].'-'.$d[0];
	}

	public function getDataNascimentoAttribute() {
		if (!$this->attributes['data_nascimento']) {
			return null;
		} else {
			$d = explode('-', $this->attributes['data_nascimento']);

			return $d[2].'/'.$d[1].'/'.$d[0];
		}
	}

	public function getInternoAttribute() {
		if ($this->attributes['interno']) {
			return 'SIM';
		} else {
			return 'NÃO';
		}
	}

	public function setor() {
		return $this->belongsTo('Setor', 'setor_id');
	}

}