<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('measurement', 'MeasurementController')->except([
    'create', 'edit', 'update', 'destroy'
]);

// GE: /api/device/list/a4cf1224530

Route::get('device/list/{uuid?}','MeasurementController@device', );