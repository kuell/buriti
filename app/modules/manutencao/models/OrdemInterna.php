<?php

Class OrdemInterna extends Eloquent{
	protected $guarded = array();

	public function getDataAttribute(){
		$d = date('d/m/Y', strtotime($this->attributes['data']));
		return $d;
	}

	public function setorResponsavel(){
		return $this->belongsTo('Setor', 'setor_responsavel_id');
	}

	public function setorRequisitante(){
		return $this->belongsTo('Setor', 'setor_requisitante_id');
	}

	public function equipamento(){
		return $this->belongsTo('Equipamento', 'equipamento_id');
	}

	public function getEquipamentoIdAttribute(){
		$equipamento= Equipamento::find($this->attributes['equipamento_id']);
		return $equipamento->descricao;
	}

	public function servicos(){
		return $this->hasMany('OrdemInternaServico', 'ordem_interna_id');
	}
}
