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

// Students API Routes
Route::group(['namespace' => 'Api'], function () {
    
    // Auth Routes
    Route::group(['prefix' => 'auth'], function () {

        Route::post('login', 'AuthController@login');

    });

    // App Routes
    Route::group(['middleware' => 'auth:users'], function () {
        
        // Home Routes
        Route::get('/home', 'HomeController@index');

        Route::get('/search', 'HomeController@search');

        Route::get('/category', 'HomeController@category');

        Route::get('/likeVideo', 'HomeController@likeVideo');
        
        Route::get('/dislikeVideo', 'HomeController@dislikeVideo');

        Route::get('logout', 'AuthController@logout');

    });


});
