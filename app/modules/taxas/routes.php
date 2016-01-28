<?php

Route::group(array('before' => 'auth|permissao', 'prefix' => 'taxa'), function () {
		Route::get('/', 'TaxaController@index');

		Route::group(array('prefix'              => 'taxas'), function () {
				Route::get('itens/{id}', ['as'         => 'taxa.taxas.itens', 'uses'         => 'TaxasController@getItens']);
				Route::post('itens/{id}', ['as'        => 'taxa.taxas.itens', 'uses'        => 'TaxasController@setItem']);
				Route::post('itens/{id}/delete', ['as' => 'taxa.taxas.itens.delete', 'uses' => 'TaxasController@destroyItem']);
			});
		Route::group(array('prefix' => 'relatorios'), function () {
				Route::get('/', 'TaxaController@getRelatorios');
				Route::get('/taxa', 'TaxaController@getRelatorioTaxas');
				Route::get('/balanco_fiscal', 'TaxaController@getBalancoFiscal');

			});

		Route::resource('corretors', 'CorretorsController');
		Route::resource('itens', 'ItensController');
		Route::resource('taxas', 'TaxasController');
	});