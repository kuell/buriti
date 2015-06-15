<?php

class Medicamento extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = "farmacia_medicamentos";

	public $rules = [
		'descricao' => 'required|unique:farmacia_medicamentos,descricao'
	];
}