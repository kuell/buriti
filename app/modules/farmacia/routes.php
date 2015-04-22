<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth|permissao', 'prefix' => 'farmacia'), function () {
		Route::get('/', 'FarmaciaController@index');

		Route::get('atestados/rel_operacoes', 'AtestadoController@relatorioOperacoes');
		Route::get('atestados/rel_rh', 'AtestadoController@relatorioRh');
		Route::get('ocorrencias/relatorioOcorrencias', 'OcorrenciasController@getRelatorio');
		Route::get('ocorrencias/elemento/{id}', array('as' => 'farmacia.ocorrencias.elemento', 'uses' => 'OcorrenciasController@getElemento'));

		Route::get('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@getElementos']);

		Route::post('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@postElementos']);

		Route::resource('ocorrencias', 'OcorrenciasController');
		Route::resource('atestados', 'AtestadoController');
	});