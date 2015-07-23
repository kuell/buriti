<?php

class UsuarioPermissao extends Eloquent {
	protected $table   = "usuario_permissao";
	protected $guarded = array();

	public function usuario() {
		return $this->belongsTo('User', 'id');
	}
	public function menu() {
		return $this->belongsTo('Menu', 'menu_id');
	}

	public function premite($menu_id) {
		return true;
	}
}