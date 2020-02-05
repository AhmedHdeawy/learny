<?php

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| USER 		=>	auth()->user()
|
| ADMIN		=>	auth()->guard('admin')->user()
\
*/


// Front Controller
Route::group([ 'prefix' =>	'/' ], function(){

    // Home
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::get('support', 'HomeController@support')->name('support');

    Route::post('contact-us', 'HomeController@postContactUs')->name('postContactUs');

});


// Dashboard Routes
Route::prefix('admin')
->name('admin.')
->group(function() {

	// Admin Login Routes
	Route::get('login', 'Auth\AdminLoginController@showLogin')->name('getLogin');
    Route::post('login', 'Auth\AdminLoginController@login')->name('postLogin');


	Route::middleware(['admin'])->group(function(){

		// Dashboard Routes
		Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.index');

       	// Categories Routes
        Route::resource('categories', 'Dashboard\CategoriesController');

        // Videos Routes
        // Route::resource('videos', 'Dashboard\VideosController')->except('edit', 'update');
        Route::resource('videos', 'Dashboard\VideosController');
        Route::post('uploadVideo', 'Dashboard\VideosController@uploadVideo')->name('uploadVideo');

        // Infos Routes
    	Route::resource('infos', 'Dashboard\InfosController')->except('create', 'store', 'destroy');

    	// Settings Routes
    	Route::resource('settings', 'Dashboard\SettingsController')->except('create', 'store', 'destroy');

        // ContactUs Routes
        Route::resource('contactus', 'Dashboard\ContactUsController');

    	// Users Routes
    	Route::resource('users', 'Dashboard\UsersController');

        // Admins Routes
        Route::resource('admins', 'Dashboard\AdminsController');

        // Admin Logout Route
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');
		

	});


});


