<?php

class SesmtPostoRisco extends \Eloquent {
	protected $guarded  = [];
	protected $fillable = [];
	protected $table    = 'posto_riscos';

	public function postoTrabalho() {
		return $this->belongsTo('SetorPosto', 'posto_id');
	}
}