<?php

/*
 * Cadastros
 *
 */

Route::group(array('before' => 'auth|permissao', 'prefix' => 'cadastro'), function () {
	Route::resource('setors', 'SetorsController');
	Route::resource('colaborador', 'ColaboradorController');
});
