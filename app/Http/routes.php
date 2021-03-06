<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ 'uses' => '\Lotto\Controllers\PageController@homepage' ]);

    Route::get('/export-csv', [ 'uses' => '\Lotto\Controllers\ExportController@csv' ]);
});

Route::group(['prefix' => 'api'], function () {

    Route::get('/play-main', '\Lotto\Controllers\LottoController@playMain');

    Route::get('/play-powerball', '\Lotto\Controllers\LottoController@playPowerball');

});
