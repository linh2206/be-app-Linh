<?php
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');header('Access-Control-Allow-Headers:X-CSRF-TOKEN, Origin, X-Requested-With, Content-Type,Accept, Authortization');
// header('Access-Control-Allow-Origin: *');
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::group(['prefix' => 'auth', 'middleware' => 'jwt.auth'], function () {
    Route::post('logout', 'AuthController@logout');

    Route::get('getList', 'DemoController@getList');
    Route::post('createA', 'DemoController@createA');
    Route::post('createB', 'DemoController@createB');
    Route::get('/{id}','DemoController@getbyId');
    Route::post('/{id}','DemoController@delete');
    Route::put('update/{id}', 'DemoController@update');

    //
});
