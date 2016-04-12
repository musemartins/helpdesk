<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();
    
    /*Route::get('/login', function() {
        return view('welcome');
    });

    Route::get('/bjeras', 'AuthController@fds');

    Route::get('/cmd', function () {
        chdir('../');
        $dir =  getcwd();
        print_r($dir);
        $cmd = shell_exec ('php artisan view:clear');
        return $cmd;
    });
    */
    Route::get('/bjeras', 'AuthController@fds');
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/', 'Admin\DashboardController@index');

        Route::resource('users', 'Admin\UsersController', ['except' => ['destroy', 'store', 'update']]);
        Route::get('/users/{id}/delete', 'Admin\UsersController@destroy');
        Route::post('/users/create', 'Admin\UsersController@store');
        Route::post('/users/{id}/edit', 'Admin\UsersController@update');
        Route::get('/users/{id}/activate', 'Admin\UsersController@activate');
        Route::get('/users/{id}/deactivate', 'Admin\UsersController@deactivate');

        Route::resource('projects', 'Admin\ProjectsController', ['except' => ['destroy', 'store', 'update', 'show']]);
        Route::get('/projects/{id}/delete', 'Admin\ProjectsController@destroy');
        Route::post('/projects/create', 'Admin\ProjectsController@store');
        Route::post('/projects/{id}/edit', 'Admin\ProjectsController@update');

        Route::get('/projects/{slug}', 'Admin\IssuesController@index');
        Route::get('/projects/{slug}/issue/{id}/show', 'Admin\IssuesController@show');
        Route::get('/projects/{slug}/issue/{id}/download/{file}', 'Admin\IssuesController@download');
        Route::get('/projects/{slug}/issue/create', 'Admin\IssuesController@create');
        Route::post('/projects/{slug}/issue/create', 'Admin\IssuesController@store');
        Route::get('/projects/{slug}/issue/create/{id}/upload', 'Admin\IssuesController@getUpload');
        Route::post('/projects/{slug}/issue/create/{id}/upload', 'Admin\IssuesController@upload');
        Route::get('/projects/{slug}/issue/{id}/edit', 'Admin\IssuesController@edit');
        Route::post('/projects/{slug}/issue/{id}/edit', 'Admin\IssuesController@update');
        Route::get('/projects/{slug}/issue/{id}/edit/upload', 'Admin\IssuesController@getUpdateUpload');
        Route::post('/projects/{slug}/issue/{id}/edit/upload', 'Admin\IssuesController@updateUpload');
        Route::get('/projects/{slug}/issue/{id}/edit/upload/{fileID}/delete', 'Admin\IssuesController@deleteImage');
        Route::get('/projects/{slug}/issue/{id}/delete', 'Admin\IssuesController@destroy');

        Route::get('/projects/{slug}/issue/{issue}/create', 'Admin\CommentsController@create');
        Route::post('/projects/{slug}/issue/{issue}/create', 'Admin\CommentsController@store');
        Route::get('/projects/{slug}/issue/{issue}/answer/{id}/edit', 'Admin\CommentsController@edit');
        Route::post('/projects/{slug}/issue/{issue}/answer/{id}/edit', 'Admin\CommentsController@update');
    });

});

Route::post('/projects/{slug}/issue/{id}/priority', 'Admin\IssuesController@changePriority');
Route::post('/projects/{slug}/issue/{id}/status', 'Admin\IssuesController@changeStatus');
Route::post('/projects/{slug}/issue/{id}/assigned', 'Admin\IssuesController@changeAssignedTo');
