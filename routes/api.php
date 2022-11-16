<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('/v1/client')->namespace('App\Http\Controllers')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@authenticate');
});


Route::prefix('/v1/client')->middleware('jwt.verify')->namespace('App\Http\Controllers')->group(function () {
    Route::get('user', 'AuthController@getDataUser');
    Route::post('logout', 'AuthController@logout');
});
