<?php

Route::group(array('before' => 'auth', 'prefix' => 'sesmt'), function () {
    Route::get('/', 'SesmtController@index');
    Route::resource('investigacao', 'InvestigacaoController');

});