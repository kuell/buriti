<?php

Route::group(array('before' => 'auth|permissao', 'prefix' => 'reports'), function () {
	Route::get('atestados', '');
	Route::resource('atestados', 'AtestadoController');
});