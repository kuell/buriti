<?php

Route::group(array('before' => 'auth', 'prefix' => 'manutencao'), function () {
		Route::get('/', 'ManutencaoController@index');

		Route::get('osi/servicos/{id}', ['as' => 'manutencao.osi.servicos', 'uses' => 'OrdemInternaController@getServicos']);

		Route::resource('osi', 'OrdemInternaController');
	});