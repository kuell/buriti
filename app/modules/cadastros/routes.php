<?php

/*
 * Cadastros
 *
 */
Route::group(array('before' => 'auth|permissao'), function () {

		Route::group(['prefix' => 'setors'], function () {

				Route::get('posto/{id}', array('as'        => 'setors.posto', 'uses'        => 'SetorsController@getPosto'));
				Route::post('posto/{id}', array('as'       => 'setors.posto.add', 'uses'       => 'SetorsController@postPosto'));
				Route::get('posto/{id}/edit', array('as'   => 'setors.posto.edit', 'uses'   => 'SetorsController@editPosto'));
				Route::get('posto/{id}/delete', array('as' => 'setors.posto.delete', 'uses' => 'SetorsController@destroyPosto'));

				Route::get('/posto/{id}/atividades', array('as'        => 'setors.posto.atividades', 'uses'        => 'SetorsController@getAtividades'));
				Route::post('/posto/{id}/atividades', array('as'       => 'setors.posto.atividade.add', 'uses'       => 'SetorsController@postAtividades'));
				Route::get('/posto/atividades/{id}/delete', array('as' => 'setors.posto.atividade.delete', 'uses' => 'SetorsController@destroyAtividade'));

				Route::get('/funcao/{id}', array('as'        => 'setors.funcao', 'uses'        => 'SetorsController@getFuncao'));
				Route::post('/funcao/{id}', array('as'       => 'setors.funcao.add', 'uses'       => 'SetorsController@setFuncao'));
				Route::get('/funcao/{id}/delete', array('as' => 'setors.funcao.delete', 'uses' => 'SetorsController@destroyFuncao'));
			});

		Route::get('colaboradors/{id}/demitir', array('as'  => 'colaboradors.demitir', 'uses'  => 'ColaboradorController@getDemitir'));
		Route::post('colaboradors/{id}/demitir', array('as' => 'colaboradors.demitir', 'uses' => 'ColaboradorController@setDemitir'));

		Route::get('/fichas/{id}/selecionar', ['as'  => 'fichas.selecionar', 'uses'  => 'FichasController@getSelecionar']);
		Route::post('/fichas/{id}/selecionar', ['as' => 'fichas.selecionar', 'uses' => 'FichasController@setSelecionar']);

		Route::get('fichas/instrucao/{id}', ['as'        => 'fichas.instrucao', 'uses'        => 'FichasController@getInstrucao']);
		Route::post('fichas/instrucao/{id}', ['as'       => 'fichas.instrucao', 'uses'       => 'FichasController@setInstrucao']);
		Route::get('fichas/instrucao/{id}/delete', ['as' => 'fichas.instrucao.delete', 'uses' => 'FichasController@destroyInstrucao']);

		Route::get('fichas/cursos/{id}', ['as'        => 'fichas.curso', 'uses'        => 'FichasController@getCursos']);
		Route::post('fichas/cursos/{id}', ['as'       => 'fichas.curso', 'uses'       => 'FichasController@setCurso']);
		Route::get('fichas/cursos/{id}/delete', ['as' => 'fichas.curso.delete', 'uses' => 'FichasController@destroyCurso']);

		Route::get('fichas/empregos/{id}', ['as'        => 'fichas.emprego', 'uses'        => 'FichasController@getEmpregos']);
		Route::post('fichas/empregos/{id}', ['as'       => 'fichas.emprego', 'uses'       => 'FichasController@setEmprego']);
		Route::get('fichas/empregos/{id}/delete', ['as' => 'fichas.emprego.delete', 'uses' => 'FichasController@destroyEmprego']);

		Route::get('fichas/parentes/{id}', ['as'        => 'fichas.parente', 'uses'        => 'FichasController@getParentes']);
		Route::post('fichas/parentes/{id}', ['as'       => 'fichas.parente', 'uses'       => 'FichasController@setParente']);
		Route::get('fichas/parentes/{id}/delete', ['as' => 'fichas.parente.delete', 'uses' => 'FichasController@destroyParente']);

		Route::get('fichas/setors/{id}', ['as'        => 'fichas.setor', 'uses'        => 'FichasController@getSetors']);
		Route::post('fichas/setors/{id}', ['as'       => 'fichas.setor', 'uses'       => 'FichasController@setSetor']);
		Route::get('fichas/setors/{id}/delete', ['as' => 'fichas.setor.delete', 'uses' => 'FichasController@destroySetor']);

		Route::resource('/setors', 'SetorsController');
		Route::resource('/colaboradors', 'ColaboradorController');
		Route::resource('/fichas', 'FichasController');

	});

Route::group(['before'               => 'auth', 'prefix'               => 'colaboradors/reports'], function () {
		Route::get('por_posto', array('as' => 'colaboradors.report.por_posto', 'uses' => 'ColaboradorController@colaboradorPorPosto'));
	});