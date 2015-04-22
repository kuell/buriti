<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/10/14
 * Time: 10:26
 */

class Ocorrencia extends Eloquent {
	protected $guarded = array();
	protected $table   = "farmacia_ocorrencias";

	public function getDataHoraAttribute() {
		return date('d/m/Y H:i', strtotime($this->attributes['data_hora']));
	}

	public function getCodigoInternoAttribute() {
		$this->attributes['codigo_interno'] = Colaborador::find($this->attributes['colaborador_id'])->codigo_interno;
	}

	public function getElementoAttribute() {
		return FarmaciaElemento::find($this->attributes['elemento_id']);
	}

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

	public function investigacao() {
		return $this->hasOne('Investigacao');
	}

	public static function getRelatorioOperacoes($datai, $dataf) {
		$result = [];

		foreach (Ocorrencia::whereBetween('data_hora', [$datai, $dataf])->get() as $val) {
			$result[] = ['Nome'     => $val->colaborador->nome,
				'Setor'                => !empty($val->colaborador->setor->descricao)?$val->colaborador->setor->descricao:null,
				'Data'                 => $val->data_hora,
				'Descrição / Motivo' => $val->relato.' - '.$val->diagnostico,
				'Conduta / Destino'    => $val->conduta.' - '.$val->destino];
		}

		return $result;
	}

}