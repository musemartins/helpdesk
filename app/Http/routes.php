<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/', 'HomeController@index');
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
