<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    //登录退出
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');



    Route::group(['middleware' => ['checkadminlogin', 'grantusernode']], function() {

        Route::get('index', 'IndexController@index')->name('index');
        Route::get('welcome', 'IndexController@welcome')->name('welcome');

        //用户相关
        Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
            Route::get('index', 'UserController@index')->name('index'); 
            Route::get('create', 'UserController@create')->name('create');
            Route::post('create', 'UserController@create')->name('create');
        
            Route::delete('delete/{target}', 'UserController@delete') -> name('delete');
            Route::get('trashed', 'UserController@trashed') -> name('trashed');
            Route::post('restore/{target}', 'UserController@restore') -> name('restore');
        
            Route::delete('delete_all', 'UserController@delete_all') -> name('delete_all');
            Route::delete('restore_all', 'UserController@restore_all') -> name('restore_all');
        
            Route::get('update', 'UserController@update') -> name('update');
            Route::post('update', 'UserController@update') -> name('update');
        
            Route::get('change_password', 'UserController@change_password') -> name('change_password');
            Route::post('change_password', 'UserController@change_password') -> name('change_password');
        

            Route::match(['get', 'post'], 'role/{user}', 'UserController@role')->name('role');
        
        });


        //角色管理
        //资源路由
        // Route::resource('role', 'RoleController', ['as' => 'admin']);
        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('index', 'RoleController@index') -> name('index');
            
            Route::get('create', 'RoleController@create') -> name('create');
            Route::post('create', 'RoleController@create') -> name('create');

            Route::get('update/{role}', 'RoleController@update') -> name('update');
            Route::post('update/{role}', 'RoleController@update') -> name('update');
            Route::DELETE('delete', 'RoleController@delete') -> name('delete');

            Route::get('node/{role}', 'RoleController@node')->name('node');
            Route::post('node/{role}', 'RoleController@node')->name('node');
    
        });


        //节点管理        
        Route::group(['prefix' => 'node', 'as' => 'node.'], function () {
            Route::get('index', 'NodeController@index') -> name('index');
            
            Route::get('create', 'NodeController@create') -> name('create');
            Route::post('create', 'NodeController@create') -> name('create');

            Route::get('update/{node}', 'NodeController@update') -> name('update');
            Route::post('update/{node}', 'NodeController@update') -> name('update');
            Route::DELETE('delete', 'NodeController@delete') -> name('delete');
        });


        //文章相关
        Route::group(['prefix' => 'article', 'as' => 'article.'], function () {

            Route::get('index', 'ArticleController@index') -> name('index');
            Route::get('create', 'ArticleController@create') -> name('create');
            Route::post('create', 'ArticleController@create') -> name('create');    
            Route::get('update/{target}', 'ArticleController@update') -> name('update');
            Route::post('update/{target}', 'ArticleController@update') -> name('update');
            Route::delete('delete/{target}', 'ArticleController@delete') -> name('delete');

            Route::post('article_cover', 'ArticleController@article_cover')->name('article_cover');
            Route::post('article_img', 'ArticleController@article_img')->name('article_img');
        });



    });







});


