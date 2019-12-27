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

Route::get('/values', 'ApiController@index');
Route::post('/values', 'ApiController@store'); 
Route::patch('/values', 'ApiController@update'); 

// Route::get('/values', function (Request $request) {
    
//     $redis = app()->make('redis'); 
//     $list = $redis->keys('*');

//     print_r($list);   
// });
