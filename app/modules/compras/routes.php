<?php

Route::group(array('before' => 'auth', 'prefix' => 'compras'), function () {
	Route::any('/', function(){
							echo "Ola";
						});

});