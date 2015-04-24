<?php

/*
 * Cadastros
 *
 */
Route::group(array('before'                => 'auth|permissao'), function () {
		Route::get('/setors/funcaos/{id}', ['as' => 'setors.funcaos', 'uses' => 'SetorsController@getFuncao']);

		Route::get('setors/posto/{id}', ['as'         => 'setors.posto', 'uses'         => 'SetorsController@getPosto']);
		Route::post('/setors/posto/{id}', ['as'       => 'setors.posto.add', 'uses'       => 'SetorsController@postPosto']);
		Route::get('/setors/posto/{id}/delete', ['as' => 'setors.posto.delete', 'uses' => 'SetorsController@destroyPosto']);

		Route::get('/setors/posto/{id}/atividades', ['as'        => 'setors.posto.atividades', 'uses'        => 'SetorsController@getAtividades']);
		Route::post('/setors/posto/{id}/atividades', ['as'       => 'setors.posto.atividade.add', 'uses'       => 'SetorsController@postAtividades']);
		Route::get('/setors/posto/atividades/{id}/delete', ['as' => 'setors.posto.atividade.delete', 'uses' => 'SetorsController@destroyAtividade']);

		Route::resource('/setors', 'SetorsController');
		Route::resource('/colaboradors', 'ColaboradorController');

	});