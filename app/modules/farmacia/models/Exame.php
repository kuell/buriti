<?php

class Exame extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'farmacia_exames';

	public function getDataAttribute() {
		return implode('/', array_reverse(explode('-', $this->attributes['data'])));
	}

}