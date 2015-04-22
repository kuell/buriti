<?php

/*
 * Cadastros
 *
 */
Route::group(array('before'                => 'auth|permissao'), function () {
		Route::get('/setors/funcaos/{id}', ['as' => 'setors.funcaos', 'uses' => 'SetorsController@getFuncao']);
		Route::resource('/setors', 'SetorsController');
		Route::resource('/colaboradors', 'ColaboradorController');

	});