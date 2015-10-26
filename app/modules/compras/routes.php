<?php

Route::group(array('before' => 'auth', 'prefix' => 'compras'), function () {
		Route::any('/', 'ComprasController@index');

		Route::group(['prefix'                      => 'pedidos'], function () {
				Route::get('{id}/produtos', ['as'         => 'compras.pedidos.produtos', 'uses'         => 'PedidosController@getProdutos']);
				Route::post('{id}/produtos', ['as'        => 'compras.pedidos.produtos', 'uses'        => 'PedidosController@setProdutos']);
				Route::post('{id}/produtos/delete', ['as' => 'compras.pedidos.produtos.delete', 'uses' => 'PedidosController@destroyProdutos']);

			});

		Route::get('comprar/produtos', ['as' => 'compras.pedidos.comprar.produtos', 'uses' => 'PedidosController@getComprarProdutos']);

		Route::group(['prefix' => 'produtos'], function () {
				Route::get('find/{id}/pedidos', function ($id) {
						$produto = Produto::find($id);

						if ($produto->pedidos()->requisitados()->count() == 0) {
							return 0;
						} else {
							foreach ($produto->pedidos()->requisitados()->get() as $pedido) {

								$return[] =
								"Pedido = ".$pedido->pedido->id.
								"\n Data = ".date('d/m/Y', strtotime($pedido->pedido->created_at)).
								"\n Setor = ".$pedido->pedido->setor->descricao.
								"\n Solicitante = ".$pedido->pedido->solicitante.
								"\n Usuario = ".strtoupper($pedido->pedido->user_created).
								"\n Observação = ".$pedido->pedido->obs."\n\n"
								;

							}
							return $return;

						}
					});
			});

		Route::resource('produtos', 'ProdutosController');
		Route::resource('pedidos', 'PedidosController');

	});