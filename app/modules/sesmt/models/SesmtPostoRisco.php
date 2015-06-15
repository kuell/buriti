<?php

class SesmtPostoRisco extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_riscos';
	public $rules       = [
		'posto_id'  => 'required',
		'descricao' => 'required',
		'tipo'      => 'required'
	];

	public function postoTrabalho() {
		return $this->belongsTo('SetorPosto', 'posto_id');
	}
}