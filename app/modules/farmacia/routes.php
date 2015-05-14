<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth|permissao', 'prefix' => 'farmacia'), function () {
		Route::get('/', 'FarmaciaController@index');
		// ----Ocorrencias
		Route::get('ocorrencias/relatorioOcorrencias', 'OcorrenciasController@getRelatorio');
		Route::get('ocorrencias/elemento/{id}', array('as' => 'farmacia.ocorrencias.elemento', 'uses' => 'OcorrenciasController@getElemento'));

		Route::get('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@getElementos']);

		Route::post('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@postElementos']);

		Route::get('ocorrencias/{id}/medicamentos', ['as' => 'farmacia.ocorrencias.medicamentos', 'uses' => 'OcorrenciasController@getMedicamentos']);

		// --- Atestados
		Route::get('atestados/rel_operacoes', 'AtestadoController@relatorioOperacoes');
		Route::get('atestados/rel_rh', 'AtestadoController@relatorioRh');

		// --- Aso
		Route::get('aso/postos/{setor_id}', function ($setor_id) {
				$setor = Setor::find($setor_id);
				return Response::json($setor->postoTrabalhos);

			});
		Route::post('aso/risco/{tipo}', 'AsoController@setRisco');
		Route::get('aso/{aso_id}/exames', ['as'          => 'farmacia.aso.exames', 'uses'          => 'AsoController@getExames']);
		Route::post('aso/{aso_id}/exames', ['as'         => 'farmacia.aso.exames', 'uses'         => 'AsoController@setExames']);
		Route::get('aso/{exame_id}/exames/delete', ['as' => 'farmacia.aso.exames.delete', 'uses' => 'AsoController@destroyExame']);

		Route::resource('medicamentos', 'MedicamentoController');
		Route::resource('ocorrencias', 'OcorrenciasController');
		Route::resource('atestados', 'AtestadoController');
		Route::resource('aso', 'AsoController');

	});