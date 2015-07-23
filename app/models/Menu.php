<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 08/10/14
 * Time: 10:26
 */

class Menu extends Eloquent {

	public function subMenus() {
		return $this->hasMany('Menu', 'menu_pai');
	}
	public function sistema() {
		return $this->belongsTo('Menu', 'id');
	}
	public function permite($usuario) {
		$permite = UsuarioPermissao::where('menu_id', $this->attributes['id'])
		                                                   ->where('usuario_id', $usuario->id)->count();
		return $permite;

		//print_r($this->attributes['id']);
	}
}