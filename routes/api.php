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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/user', [
    'uses' => 'UserController@signup'
]);

Route::post('/user/signin', [
    'uses' => 'UserController@signin'
]);

Route::middleware(['auth.jwt'])->group(function(){
    Route::post('/quote', [
        'uses' => 'QuoteController@postQuote'
    ]);

    Route::get('/quotes', [
        'uses' => 'QuoteController@getQuote'
    ]);

    Route::put('/quote/{id}', [
        'uses' => 'QuoteController@putQuote'
    ]);

    Route::delete('/quote/{id}', [
        'uses' => 'QuoteController@deleteQuote'
    ]);
});