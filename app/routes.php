<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::get('/', 'UserController@getLogin');

Route::get('dashboard', array('before' => 'auth', 'as' => 'dashboard', 'uses' => 'UserController@index'));

Route::post('login', 'UserController@postLogin');

Route::get('login', array('as' => 'users.login', 'uses' => 'UserController@postLogin'));

Route::get('logout', array('as' => 'users.logout', function () {
			Auth::logout();
			return Redirect::to('/');
		}));

/*
 *  Usuario
 */

Route::group(array('before' => 'auth|permissao'), function () {
		Route::resource('users', 'UserController');
		Route::get('users/permissao/{id}', 'PermissaoController@getSistema');
		Route::post('users/permissao', 'PermissaoController@postMenu');
	});

/**
 *
 *	Ordem Interna
 *
 **/

Route::group(array('before' => 'auth', 'prefix' => 'restfull'), function () {
		Route::get('cid/{cod}', function ($cod) {
				$cid = FarmaciaCid::where('cod_cid', '=', $cod)->get();
				if ($cid->count() == 0) {
					return 0;
				} else {
					return $cid;
				}
			});
	});

Route::post('suporte', function () {
		$input = array_except(Input::all(), '_token');
		$input['usuario'] = Auth::user()->user;

		Mail::send('dashboard.email_suporte', $input, function ($message) {
				$message->to('suporte@frizelo.com.br')->subject('['.Input::get('tipo').'] - '.Auth::user()->nome);
			});
		return Redirect::to('/');
	});