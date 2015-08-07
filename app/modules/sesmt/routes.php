<?php

Route::group(array('before' => 'auth|permissao', 'prefix' => 'sesmt'), function () {
		Route::get('/', 'SesmtController@index');

		Route::get('investigacao/{investigacao}/epi', array('as'  => 'sesmt.investigacao.epi', 'uses'  => 'InvestigacaoController@getEpi'));
		Route::post('investigacao/{investigacao}/epi', array('as' => 'sesmt.investigacao.epi.add', 'uses' => 'InvestigacaoController@postEpi'));

		Route::get('investigacao/{investigacao}/epi/delete', array('as' => 'sesmt.investigacao.epi.delete', 'uses' => 'InvestigacaoController@destroyEpi'));

		Route::post('analise/{id}/finalizar', ['as' => 'sesmt.analise.finalizar', 'uses' => 'AnaliseController@setFinalizar']);

		Route::get('investigacao/{id}/redirecionar', ['as'  => 'sesmt.investigacao.redirecionar', 'uses'  => 'InvestigacaoController@getRedirecionar']);
		Route::post('investigacao/{id}/redirecionar', ['as' => 'sesmt.investigacao.redirecionar', 'uses' => 'InvestigacaoController@setRedirecionar']);

		Route::resource('investigacao', 'InvestigacaoController');
		Route::resource('risco', 'RiscoController');
		Route::resource('analise', 'AnaliseController');

	});