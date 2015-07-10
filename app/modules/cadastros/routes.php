<?php

/*
 * Cadastros
 *
 */
Route::group(array('before'                => 'auth|permissao'), function () {
		Route::get('/setors/funcaos/{id}', array('as' => 'setors.funcaos', 'uses' => 'SetorsController@getFuncao'));

		Route::get('setors/posto/{id}', array('as'         => 'setors.posto', 'uses'         => 'SetorsController@getPosto'));
		Route::post('/setors/posto/{id}', array('as'       => 'setors.posto.add', 'uses'       => 'SetorsController@postPosto'));
		Route::get('/setors/posto/{id}/delete', array('as' => 'setors.posto.delete', 'uses' => 'SetorsController@destroyPosto'));

		Route::get('/setors/posto/{id}/atividades', array('as'        => 'setors.posto.atividades', 'uses'        => 'SetorsController@getAtividades'));
		Route::post('/setors/posto/{id}/atividades', array('as'       => 'setors.posto.atividade.add', 'uses'       => 'SetorsController@postAtividades'));
		Route::get('/setors/posto/atividades/{id}/delete', array('as' => 'setors.posto.atividade.delete', 'uses' => 'SetorsController@destroyAtividade'));

		Route::get('colaboradors/{id}/demitir', array('as' => 'colaboradors.demitir', 'uses' => 'ColaboradorController@getDemitir'));
		Route::post('colaboradors/{id}/demitir', array('as' => 'colaboradors.demitir', 'uses' => 'ColaboradorController@setDemitir'));
		
		Route::get('/colaboradors/find/{matricula}', function ($matricula) {
				$colaborador = Colaborador::where('codigo_interno', $matricula)->first();
				if (empty($colaborador)) {
					$colaborador = Colaborador::find($matricula);
				}

				return Response::json($colaborador);
			});

		Route::resource('/setors', 'SetorsController');
		Route::resource('/colaboradors', 'ColaboradorController');
		Route::resource('/fichas', 'FichasController');

	});