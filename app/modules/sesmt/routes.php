<?php

Route::group(array('before' => 'auth|permissao', 'prefix' => 'sesmt'), function () {
		Route::get('/', 'SesmtController@index');

		Route::get('investigacao/{investigacao}/epi', array('as'  => 'sesmt.investigacao.epi', 'uses'  => 'InvestigacaoController@getEpi'));
		Route::post('investigacao/{investigacao}/epi', array('as' => 'sesmt.investigacao.epi.add', 'uses' => 'InvestigacaoController@postEpi'));

		Route::get('investigacao/{investigacao}/epi/delete', array('as' => 'sesmt.investigacao.epi.delete', 'uses' => 'InvestigacaoController@destroyEpi'));

		Route::resource('investigacao', 'InvestigacaoController');

	});