<?php

class Atestado extends Eloquent {

	protected $guarded  = array();
	protected $fillable = [];
	protected $table    = "farmacia_atestados";

	public function getAcidenteTrabalhoAttribute() {

		if ($this->attributes['acidente_trabalho']) {
			return 1;
		} else {
			return 0;
		}
	}

	public function getDoencaAttribute() {
		if ($this->attributes['doenca']) {
			return 1;
		} else {
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

	/**
	 *	Retorna Descrição para Relatorio
	 *
	 **/
	public function descricao($id) {
		$atestado = Atestado::find($id);

		if ($atestado->tipo_atestado == 0) {
			if ($atestado->acidente_trabalho) {
				return "Cat";
			} else {
				return "Consulta";
			}
		} else if ($atestado->tipo_atestado == 1) {
			return "Acompanhamento Familiar";
		} else {
			return 'Erro no processamento!';
		}

	}

	/**
	 *	Retorna Lista de atestados em array
	 *
	 **/

	public function listaAtestados(Atestado $parametros) {
		$atestados = Atestado::whereBetween('inicio_afastamento', array($parametros->inicio_afastamento, $parametros->fim_afastamento))->get();

		$result = [];

		foreach ($atestados as $val) {
			$result[] = [
				'Matricula'     => $val->colaborador->codigo_interno,
				'Nome'          => $val->colaborador->nome,
				'Setor'         => (empty($val->colaborador->setor->descricao))?'null':$val->colaborador->setor->descricao,
				'Data Inicio'   => $val->inicio_afastamento,
				'Data Terminio' => $val->fim_afastamento,
				'Descrição'   => $val->descricao($val->id),
				'Obs'           => $val->obs,
				'Cid'           => $val->cid,
				'Medico'        => $val->profissional,
				'Total Dias'    => ""];
		}

		return $result;
	}

	public function atestadoTipo(Atestado $parametros) {

		$result = [];

		foreach (Colaborador::all() as $val) {
			if ($val->atestados()->whereBetween('inicio_afastamento', [$parametros->inicio_afastamento, $parametros->fim_afastamento])->count()) {
				$result[] =
				['matricula' => $val->codigo_interno,
					'nome'      => $val->nome,
					'setor'     => (empty($val->colaborador->setor->descricao))?'null':$val->colaborador->setor->descricao,
					'atestados' => [$val->atestados()->get()]
				]
				;
			}
		}
		return $result;
	}

}