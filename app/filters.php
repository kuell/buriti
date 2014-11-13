<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
 */

App::before(function ($request) {
		//
	});

App::after(function ($request, $response) {
		//
	});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
 */

Route::filter('auth', function () {
		if (Auth::guest()) {
			if (Request::ajax()) {
				return Response::make('Unauthorized', 401);
			} else {
				return Redirect::guest('login');
			}
		}
	});

Route::filter('auth.basic', function () {
		return Auth::basic();
	});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
 */

Route::filter('guest', function () {
		if (Auth::check()) {return Redirect::to('/');
		}
	}
);

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
 */

Route::filter('csrf', function () {
		if (Session::token() != Input::get('_token')) {
			throw new Illuminate\Session\TokenMismatchException;
		}
	});

Route::filter('permissao', function ($route, $request) {
		$url = '/'.$request->segment(1).'/'.$request->segment(2).'/';
		$idUrl = Menu::where('url', $url)->get();

		if (empty($idUrl[0]) || $idUrl[0]->id == 0 || $idUrl[0]->id == '') {
			return Response::make('Página não encontrada!', 401);
		} else {
			$permissao = UsuarioPermissao::where('usuario_id', Auth::user()->id)
			->where('menu_id', $idUrl[0]->id)->count();
		}

		if (isset($permissao) && $permissao == 0) {
			return Response::make('Usuario não tem permissao para realizar este procedimento!', 401);
		}

	});