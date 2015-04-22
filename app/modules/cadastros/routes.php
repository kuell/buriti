<?php

/*
 * Cadastros
 *
 */
Route::group(array('before' => 'auth|permissao'), function () {

		Route::resource('/setors', 'SetorsController');
		Route::resource('/colaboradors', 'ColaboradorController');

	});