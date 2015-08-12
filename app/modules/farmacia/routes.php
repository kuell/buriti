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
		Route::post('aso/risco/{tipo}', 'AsoController@setRisco');
		Route::get('aso/{aso_id}/exames', ['as'          => 'farmacia.aso.exames', 'uses'          => 'AsoController@getExames']);
		Route::post('aso/{aso_id}/exames', ['as'         => 'farmacia.aso.exames', 'uses'         => 'AsoController@setExames']);
		Route::get('aso/{exame_id}/exames/delete', ['as' => 'farmacia.aso.exames.delete', 'uses' => 'AsoController@destroyExame']);
		Route::post('aso/confirma/{id}', ['as'           => 'farmacia.aso.confirma', 'uses'           => 'AsoController@setConfirma']);

		Route::resource('medicamentos', 'MedicamentoController');
		Route::resource('ocorrencias', 'OcorrenciasController');
		Route::resource('atestados', 'AtestadoController');
		Route::resource('aso', 'AsoController');
		Route::resource('queixas', 'QueixasController');
		Route::resource('tipo_ocorrencia', 'TipoOcorrenciaController');

		Route::group(['prefix' => 'relatorios'], function () {
				Route::get('/', 'FarmaciaController@getRelatorios');
				Route::get('pcmso/{ano}', 'FarmaciaController@viewPCMSO');
				Route::get('exames/{ano}', 'FarmaciaController@getExamesAnual');
			});

	});

Route::group(['before' => 'auth', 'prefix' => 'farmacia'], function () {
		Route::get('ocorrencias/find/{id}', 'OcorrenciasController@show');
		Route::get('tipo_ocorrencia/find/{id}/subtipo', 'TipoOcorrenciaController@getSubTipo');
	});