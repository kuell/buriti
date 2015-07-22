<?php

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public $rules = array(
		'nome' => 'required|unique:usuarios,nome',
		'user' => 'required|unique:usuarios,user',
	);

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table   = 'usuarios';
	protected $guarded = array();
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function menus() {
		return $this->hasMany('UsuarioPermissao', 'usuario_id');
	}

	public function setAvatarAttribute($avatar) {
		if (!empty($avatar)) {
			$file            = $avatar;
			$destinationPath = 'img/users';
			$extension       = $file->getClientOriginalExtension();

			$filename = $this->attributes['nome'].'.'.$extension;
			$avatar->move($destinationPath, $filename);

			return $this->attributes['avatar'] = $filename;

		}
	}

	public function setPasswordAttribute($pass) {
		return $this->attributes['password'] = Hash::make($pass);
	}

}