<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth|permissao', 'prefix' => 'farmacia'), function () {
	Route::resource('ocorrencias', 'OcorrenciasController');
	Route::resource('atestados', 'AtestadoController');
});