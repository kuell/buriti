<?php

Route::group(array('before' => 'auth', 'prefix' => 'manutencao'), function () {
		Route::get('/', 'ManutencaoController@index');
		Route::resource('osi', 'OrdemInternaController');
	});