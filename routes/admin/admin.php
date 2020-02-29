<?php

use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');


    Route::get('index', 'IndexController@index')->name('admin.index');
    Route::get('welcome', 'IndexController@welcome')->name('admin.welcome');


    Route::get('user/index', 'UserController@index')->name('admin.user.index'); 
    Route::get('user/create', 'UserController@create')->name('admin.user.create');
    Route::post('user/store', 'UserController@store')->name('admin.user.store');

    Route::delete('user/delete/{target}', 'UserController@delete') -> name('admin.user.delete');
    Route::get('user/trashed', 'UserController@trashed') -> name('admin.user.trashed');
    Route::post('user/restore/{target}', 'UserController@restore') -> name('admin.user.restore');

    Route::delete('user/delete_all', 'UserController@delete_all') -> name('admin.user.delete_all');
    Route::delete('user/restore_all', 'UserController@restore_all') -> name('admin.user.restore_all');

    Route::get('user/profile', 'UserController@profile') -> name('admin.user.profile');
    Route::patch('user/update', 'UserController@update') -> name('admin.user.update');

    Route::get('user/change_password', 'UserController@change_password') -> name('admin.user.change_password');
    Route::patch('user/store_password', 'UserController@store_password') -> name('admin.user.store_password');

    
});
