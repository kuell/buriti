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

	public function colaborador() {
		return $this->belongsTo('Colaborador', 'colaborador_id');
	}

}