<?php

Route::group(['middleware' => 'web'], function () {

    Route::auth();

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

        Route::get('/projects/{project}', 'Admin\IssuesController@index');
        Route::get('/projects/{project}/issue/{id}/show', 'Admin\IssuesController@show');
        Route::get('/projects/{project}/issue/create', 'Admin\IssuesController@create');
        Route::post('/projects/{project}/issue/create', 'Admin\IssuesController@store');
        Route::get('/projects/{project}/issue/{id}/edit', 'Admin\IssuesController@edit');
        Route::post('/projects/{project}/issue/{id}/edit', 'Admin\IssuesController@update');
        Route::get('/projects/{project}/issue/{id}/delete', 'Admin\IssuesController@destroy');

        Route::get('/projects/{project}/issue/{issue}/create', 'Admin\CommentsController@create');
        Route::post('/projects/{project}/issue/{issue}/create', 'Admin\CommentsController@store');
        Route::get('/projects/{project}/issue/{issue}/answer/{id}/edit', 'Admin\CommentsController@edit');
        Route::post('/projects/{project}/issue/{issue}/answer/{id}/edit', 'Admin\CommentsController@update');
    });

});

Route::post('/projects/{project}/issue/{id}/priority', 'Admin\IssuesController@changePriority');
Route::post('/projects/{project}/issue/{id}/status', 'Admin\IssuesController@changeStatus');
