<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::get('login', 'LoginController@index') -> name('admin.login');
    Route::post('login', 'LoginController@login') -> name('admin.login');
    Route::get('logout', 'LoginController@logout') -> name('admin.logout');

    Route::get('index', 'IndexController@index') -> name('admin.index');
    Route::get('welcome', 'IndexController@welcome') -> name('admin.welcome');
});