<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth', 'prefix' => 'farmacia'), function () {
		Route::get('/', 'FarmaciaController@index');

		Route::get('atestados/rel_operacoes', 'AtestadoController@relatorioOperacoes');
		Route::get('atestados/rel_rh', 'AtestadoController@relatorioRh');
		Route::get('ocorrencias/relatorioOcorrencias', 'OcorrenciasController@getRelatorio');

		Route::resource('ocorrencias', 'OcorrenciasController');
		Route::resource('atestados', 'AtestadoController');
	});