<?php

use App\Http\Controllers\Admin\UserController;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', 'LoginController@index')->name('admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');


    Route::get('index', 'IndexController@index')->name('admin.index');
    Route::get('welcome', 'IndexController@welcome')->name('admin.welcome');

    Route::group(['prefix' => 'user', 'as' => 'admin.user.'], function() {
        Route::get('index', 'UserController@index')->name('index'); 
        Route::get('create', 'UserController@create')->name('create');
        Route::post('store', 'UserController@store')->name('store');
    
        Route::delete('delete/{target}', 'UserController@delete') -> name('delete');
        Route::get('trashed', 'UserController@trashed') -> name('trashed');
        Route::post('restore/{target}', 'UserController@restore') -> name('restore');
    
        Route::delete('delete_all', 'UserController@delete_all') -> name('delete_all');
        Route::delete('restore_all', 'UserController@restore_all') -> name('restore_all');
    
        Route::get('profile', 'UserController@profile') -> name('profile');
        Route::patch('update', 'UserController@update') -> name('update');
    
        Route::get('change_password', 'UserController@change_password') -> name('change_password');
        Route::patch('store_password', 'UserController@store_password') -> name('store_password');
    

        Route::match(['get', 'patch'], 'role/{user}', 'UserController@role')->name('role');
    
    });


    //角色管理
    //资源路由
    Route::resource('role', 'RoleController', ['as' => 'admin']);
    Route::get('role/node/{role}', 'RoleController@node')->name('admin.role.node');
    Route::patch('role/node/{role}', 'RoleController@change_node')->name('admin.role.change_node');


    //节点管理
    Route::resource('node', 'NodeController', ['as' => 'admin']);

});
