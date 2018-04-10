<?php

Route::group(['middleware' => ['web', 'lookup:user', 'auth:user'], 'namespace' => 'Modules\Manufacturer\Http\Controllers'], function()
{
    Route::resource('manufacturer', 'ManufacturerController');
    Route::post('manufacturer/bulk', 'ManufacturerController@bulk');
    Route::get('api/manufacturer', 'ManufacturerController@datatable');
});

Route::group(['middleware' => 'api', 'namespace' => 'Modules\Manufacturer\Http\ApiControllers', 'prefix' => 'api/v1'], function()
{
    Route::resource('manufacturer', 'ManufacturerApiController');
});
