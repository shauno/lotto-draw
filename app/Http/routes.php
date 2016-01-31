<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ 'uses' => '\Lotto\Controllers\PageController@homepage' ]);
});
