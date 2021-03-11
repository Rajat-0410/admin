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

Route::post('/get-categories', 'Api\HomeController@get_categories');
Route::post('/get-related', 'Api\HomeController@get_related_type');
Route::post('/get-zones', 'Api\HomeController@get_zones');
Route::post('/get-states', 'Api\HomeController@get_states');
Route::post('/get-districts', 'Api\HomeController@get_districts');
Route::post('/get-locations', 'Api\HomeController@get_locations');
Route::post('/get-all-states', 'Api\HomeController@get_all_states');
Route::post('/get-dealer', 'Api\HomeController@get_dealer');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
