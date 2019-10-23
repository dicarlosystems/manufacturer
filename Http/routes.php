<?php

Route::group(['middleware' => ['web', 'lookup:user', 'auth:user'], 'namespace' => 'Modules\Manufacturer\Http\Controllers'], function () {
    Route::get('manufacturer', function () {
        return redirect('manufacturers');
    });

    Route::resource('manufacturers', 'ManufacturerController');
    Route::post('manufacturers/bulk', 'ManufacturerController@bulk');
    Route::get('api/manufacturers', 'ManufacturerController@datatable');
    
    Route::get('settings/manufacturer', 'ManufacturerController@settings');
    Route::post('settings/manufacturer', 'ManufacturerController@saveSettings');
});

Route::group(['middleware' => 'api', 'namespace' => 'Modules\Manufacturer\Http\ApiControllers', 'prefix' => 'api/v1'], function () {
    Route::resource('manufacturers', 'ManufacturerApiController');
});
