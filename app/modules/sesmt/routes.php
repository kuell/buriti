<?php

Route::group(array('before' => 'auth|permissao', 'prefix' => 'sesmt'), function () {
		Route::get('/', 'SesmtController@index');

		Route::post('analise/{id}/finalizar', ['as' => 'sesmt.analise.finalizar', 'uses' => 'AnaliseController@setFinalizar']);

		Route::group(['prefix' => 'investigacao'], function () {

				Route::get('{id}/redirecionar', ['as'  => 'sesmt.investigacao.redirecionar', 'uses'  => 'InvestigacaoController@getRedirecionar']);
				Route::post('{id}/redirecionar', ['as' => 'sesmt.investigacao.redirecionar', 'uses' => 'InvestigacaoController@setRedirecionar']);

				Route::get('{id}/finalizar', ['as'  => 'semst.investigacao.finalizar', 'uses'  => 'InvestigacaoController@getFinalizar']);
				Route::post('{id}/finalizar', ['as' => 'semst.investigacao.finalizar', 'uses' => 'InvestigacaoController@postFinalizar']);

				Route::get('{id}/print', ['as' => 'sesmt.investigacao.print', 'uses' => 'InvestigacaoController@getPrint']);

				Route::get('lesao/{id}', ['as'  => 'sesmt.investigacao.lesao', 'uses'  => 'InvestigacaoController@getNaturezaLesao']);
				Route::post('lesao/{id}', ['as' => 'sesmt.investigacao.lesao', 'uses' => 'InvestigacaoController@setNaturezaLesao']);
				Route::get('lesao/{id}/delete', ['as' => 'sesmt.investigacao.lesao.destroy', 'uses' => 'InvestigacaoController@destroyNaturezaLesao']);

				Route::get('corpo/{id}', ['as'  => 'sesmt.investigacao.corpo', 'uses'  => 'InvestigacaoController@getParteCorpo']);
				Route::post('corpo/{id}', ['as' => 'sesmt.investigacao.corpo', 'uses' => 'InvestigacaoController@setParteCorpo']);
				Route::get('corpo/{id}/delete', ['as' => 'sesmt.investigacao.corpo.destroy', 'uses' => 'InvestigacaoController@destroyParteCorpo']);

			});

		Route::resource('investigacao', 'InvestigacaoController');
		Route::resource('risco', 'RiscoController');
		Route::resource('analise', 'AnaliseController');

	});