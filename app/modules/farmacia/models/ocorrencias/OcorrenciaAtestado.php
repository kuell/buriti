<?php

class OcorrenciaAtestado extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia.ocorrencia_atestados';

	public function getPeriodoAfastamentoAttribute() {
		if (empty($this->attributes['inicio_afastamento']) or empty($this->attributes['fim_afastamento'])) {
			return null;
		} else {
			$inicio = implode('/', array_reverse(explode('-', $this->attributes['inicio_afastamento'])));
			$fim    = implode('/', array_reverse(explode('-', $this->attributes['fim_afastamento'])));

			return $inicio.' - '.$fim;
		}

	}

	public function getDiasAfastamentoAttribute() {
		$data1 = new DateTime($this->attributes['inicio_afastamento']);
		$data2 = new DateTime($this->attributes['fim_afastamento']);

		$interval = $data1->diff($data2);

		return $interval->d;
	}

	public function getCidDescricaoAttribute() {
		if (empty($this->attributes['cid'])) {
			return 'CID nao encontrado!';
		} else {
			$cid = FarmaciaCid::where('cod_cid', '=', $this->attributes['cid'])->first();

			return $cid->descricao;
		}

	}
}