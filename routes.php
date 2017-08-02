<?php


if (Config::get('ksoft.links::apiEnabled', true)) {
    Route::group(['prefix' => Config::get('ksoft.links::apiRoutePrefix', 'api/v1')], function () {
        Route::get('links', 'Ksoft\Links\Controllers\Items@links');
    });
}
