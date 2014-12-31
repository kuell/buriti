<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth|permissao', 'prefix' => 'farmacia'), function () {
	Route::get('atestados/rel_operacoes', 'AtestadoController@relatorioOperacoes');
	Route::get('atestados/rel_rh', 'AtestadoController@relatorioRh');

	Route::resource('ocorrencias', 'OcorrenciasController');
	Route::resource('atestados', 'AtestadoController');
});