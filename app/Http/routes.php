<?php

Route::group(['middleware' => ['web']], function () {

	/**
	 * Route for Login & Logout
	 */
	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
	Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login']);
	
	/**
	 * Route for Registration
	 */
	Route::get('/', ['as' => 'register.index', 'uses' => 'Auth\AuthController@showRegistrationForm']);
	Route::post('register', ['as' => 'register.store', 'uses' => 'Auth\AuthController@register']);

	/**
	 * Route for Password Reset
	 */
	Route::group(['prefix' => 'password', 'as' => 'password.'], function() {
		Route::get('reset/{token?}', ['as' => 'reset.token', 'uses' => 'Auth\PasswordController@showResetForm']);
	    Route::post('email', ['as' => 'email', 'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
	    Route::post('reset', ['as' => 'reset', 'uses' => 'Auth\PasswordController@reset']);
	});

	/**
	 * Route for Complete Account
	 */
	Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
	    Route::get('verify/{token}', ['as' => 'verify', 'uses' => 'Auth\AccountController@verify']);
	    Route::get('resend', ['as' => 'resend', 'uses' => 'Auth\AccountController@resend']);
	    Route::post('complete', ['as' => 'complete', 'uses' => 'Auth\AccountController@complete']);
	});

	/**
	 * Route for use Auth, Roles
	 */
	Route::group(['middleware' => ['auth']], function() {
		
	   /**
	    * Route for Administration
	    */
	   Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'roles', 'roles' => ['administrator']], function() {
	        Route::get('/', ['as' => 'dashboard', function() { return view('admin.index'); }]);
			Route::resource('status', 'Admin\StatusController');
			Route::resource('types', 'Admin\TypeController');
			Route::resource('roles', 'Admin\RolesController');
	    }); 

	   /**
	    * Route for Moderator
	    */
	   	Route::group(['prefix' => 'moderator', 'as' => 'moderator.', 'middleware' => 'roles', 'roles' => ['moderator']], function() {
	        Route::get('/', ['as' => 'dashboard', 'uses' => 'ModeratorController@index']);
	        Route::get('tasks', ['as' => 'tasks', 'uses' => 'ModeratorController@tasks']);
	        Route::put('publish/{task_id}', ['as' => 'publish', 'uses' => 'ModeratorController@publishTask']);
	        Route::put('joiner/{user_id}/task/{task_id}', ['as' => 'joiner', 'uses' => 'ModeratorController@joiner']);
	        Route::put('status/{task_id}', ['as' => 'status', 'uses' => 'ModeratorController@changeStatusTask']);
	   	});

	   /**
	    * Route for Client
	    */
	   	Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'roles', 'roles' => ['client']], function() {
	        Route::get('/', ['as' => 'dashboard', 'uses' => 'ClientController@index']);
	        Route::get('create', ['as' => 'create', 'uses' => 'ClientController@create']);
	        Route::post('store', ['as' => 'store', 'uses' => 'ClientController@store']);
	        Route::put('joiner/{user_id}/task/{task_id}', ['as' => 'joiner', 'uses' => 'ClientController@joiner']);
	        Route::put('status/{task_id}', ['as' => 'status', 'uses' => 'ClientController@changeStatusTask']);
	   	});

	   	/**
	   	 * Route for User
	   	 */
	   	Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'roles', 'roles' => ['user']], function() {
	        Route::get('/', ['as' => 'dashboard', 'uses' => 'UserController@index']);
	        Route::put('join/{task_id}', ['as' => 'join', 'uses' => 'UserController@join']);
	        Route::post('tasks', ['as' => 'tasks', 'uses' => 'UserController@tasks']);
	        Route::get('profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
	        Route::post('profile', ['as' => 'pages.save', 'uses' => 'UserController@postPages']);
	   	});
	        // Route::post('profile', ['as' => 'pages', 'uses' => 'UserController@postPages']);
	});

	// Route::group(['middleware' => ['api-json']], function() {
		// Route::auth();
	// });
	
	// Route::group(['middleware' => ['activation']], function() {

	// 	Route::controller('client', 'ClientController');
	// 	Route::controller('moderator', 'ModeratorController');
	// 	Route::controller('user', 'UserController');

	// 	Route::put('task/join/{id}', 'TaskController@join');
	// 	Route::put('task/{task_id}/user/{user_id}', 'TaskController@accept');
	// 	Route::get('task/{user}/change-status/{id}', 'TaskController@getTaskStatus');
	// 	Route::put('task/{user}/change-status/{id}', 'TaskController@putTaskStatus');

	// 	Route::group(['prefix' => 'admin'], function() {
	// 		Route::get('/', function(){ return view('admin.index');});
	// 	});
	// });

 //    Route::get('/', 'Auth\AuthController@showRegistrationForm');

});

