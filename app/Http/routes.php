<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ 'uses' => '\Lotto\Controllers\PageController@homepage' ]);
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/play-main', '\Lotto\Controllers\LottoController@playMain');
});
