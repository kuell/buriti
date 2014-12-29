<?php

class Atestado extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia_atestados";

	public function getAcidenteTrabalhoAttribute(){

		if($this->attributes['acidente_trabalho']){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function getDoencaAttribute(){
		if($this->attributes['doenca']){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

	public function getInicioAfastamentoAttribute() {
		$d = explode('-', $this->attributes['inicio_afastamento']);

		return $d[2].'/'.$d[1].'/'.$d[0];
	}

	public function getFimAfastamentoAttribute() {
		$d = explode('-', $this->attributes['fim_afastamento']);

		return $d[2].'/'.$d[1].'/'.$d[0];
	}

	public function descricao($id){
		$atestado = Atestado::find($id);

		if($atestado->tipo_atestado == 0){
			if($atestado->cat != null){
				return "Cat";
			}
			else{
				return "Consulta";
			}
		}
		else if($atestado->tipo_atestado == 1){
			return "Acompanhamento Familiar";
		}


	}

	public static function listaAtestados(){
		$atestados = Atestado::all();

		$result = [];

		foreach ($atestados as $val) {
			$result[] = [
			'codigo_funcionario'=>	$val->colaborador->codigo_interno,
			'nome'				=>	$val->colaborador->nome,
			'setor'				=>	(empty($val->colaborador->setor->descricao))? 'null' : $val->colaborador->setor->descricao,
			'data_inicio'		=>	$val->inicio_afastamento,
			'data_terminio'		=>	$val->fim_afastamento,
			'descricao'			=> 	$val->descricao($val->id),
			'obs'				=>	$val->obs,
			'cid'				=>	$val->cid,
			'medico'			=>	$val->profissional,
			'total_dias'		=> 	""];
		}

		return $result;
	}
}