<?php
/**
 *	Farmacia
 *
 **/

Route::group(array('before' => 'auth|permissao', 'prefix' => 'farmacia'), function () {
		Route::get('/', 'FarmaciaController@index');
		// ----Ocorrencias
		Route::get('ocorrencias/elemento/{id}', array('as' => 'farmacia.ocorrencias.elemento', 'uses' => 'OcorrenciasController@getElemento'));

		Route::get('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@getElementos']);

		Route::post('ocorrencias/elementos', ['as' => 'farmacia.ocorrencias.elementos', 'uses' => 'OcorrenciasController@postElementos']);

		Route::get('ocorrencias/{id}/medicamentos', ['as'        => 'farmacia.ocorrencias.medicamentos', 'uses'        => 'OcorrenciasController@getMedicamentos']);
		Route::get('ocorrencias/{id}/medicamentos/delete', ['as' => 'farmacia.ocorrencias.medicamentos.delete', 'uses' => 'OcorrenciasController@destroyMedicamento']);
		Route::post('ocorrencias/{id}/medicamentos', ['as'       => 'farmacia.ocorrencias.medicamentos', 'uses'       => 'OcorrenciasController@addMedicamento']);

		Route::get('ocorrencias/{id}/atestados', ['as'        => 'farmacia.ocorrencias.atestados', 'uses'        => 'OcorrenciasController@getAtestados']);
		Route::get('ocorrencias/{id}/atestados/delete', ['as' => 'farmacia.ocorrencias.atestados.delete', 'uses' => 'OcorrenciasController@destroyAtestados']);
		Route::post('ocorrencias/{id}/atestados', ['as'       => 'farmacia.ocorrencias.atestados', 'uses'       => 'OcorrenciasController@addAtestados']);

		Route::get('ocorrencias/relatorioOcorrencias', 'OcorrenciasController@getRelatorio');
		Route::get('ocorrencias/report', ['as' => 'farmacia.ocorrencias.report', 'uses' => 'OcorrenciasController@getReport']);

		// --- Atestados
		Route::get('atestados/rel_operacoes', 'AtestadoController@relatorioOperacoes');
		Route::get('atestados/rel_rh', 'AtestadoController@relatorioRh');

		// --- Aso
		Route::group(['prefix' => 'aso'], function () {
				Route::post('risco/{tipo}', 'AsoController@setRisco');
				Route::get('{aso_id}/exames', ['as'          => 'farmacia.aso.exames', 'uses'          => 'AsoController@getExames']);
				Route::post('{aso_id}/exames', ['as'         => 'farmacia.aso.exames', 'uses'         => 'AsoController@setExames']);
				Route::get('{exame_id}/exames/delete', ['as' => 'farmacia.aso.exames.delete', 'uses' => 'AsoController@destroyExame']);
				Route::get('finalizar/{id}', ['as'           => 'farmacia.aso.finalizar', 'uses'           => 'AsoController@getFinalizar']);
				Route::post('finalizar/{id}', ['as'          => 'farmacia.aso.finalizar', 'uses'          => 'AsoController@setFinalizar']);
			});

		Route::resource('medicamentos', 'MedicamentoController');
		Route::resource('ocorrencias', 'OcorrenciasController');
		Route::resource('atestados', 'AtestadoController');
		Route::resource('aso', 'AsoController');
		Route::resource('aso_ajustes', 'AsoAjustesController');
		Route::resource('queixas', 'QueixasController');
		Route::resource('tipo_ocorrencia', 'TipoOcorrenciaController');

		Route::group(['prefix' => 'relatorios'], function () {
				Route::get('/', 'FarmaciaController@getRelatorios');
				Route::get('pcmso/{ano}', 'FarmaciaController@viewPCMSO');
				Route::get('exames/{ano}', 'FarmaciaController@getExamesAnual');
				Route::get('colaborador_exames', 'FarmaciaController@getColaboradorExames');
				Route::get('ocorrencia/queixa/{ano}', 'FarmaciaController@getOcorrenciaQueixa');

			});

	});

Route::group(['before' => 'auth', 'prefix' => 'farmacia'], function () {
		Route::get('ocorrencias/find/{id}', 'OcorrenciasController@show');
		Route::get('tipo_ocorrencia/find/{id}/subtipo', 'TipoOcorrenciaController@getSubTipo');
		Route::get('aso/find/{id}/{tipo}', 'ColaboradorController@getAso');
	});